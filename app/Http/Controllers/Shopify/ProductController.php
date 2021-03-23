<?php

namespace App\Http\Controllers\Shopify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Vexsolutions\Helpers\UStore;
use App\Vexsolutions\Helpers\Dates;
use App\Models\Setting;
use App\Models\Productmetadata;
use Log;

class ProductController extends Controller
{
    /**
     *
     * @return View
     */
    public function index() {
        $shop   = Auth::user();
        $domain = $shop->getDomain()->toNative();
        $shopApi = $shop->api()->rest('GET', '/admin/shop.json')['body']['shop'];
        $products = collect($shop->api()->rest('GET', '/admin/products.json')['body']['products']);
        $keys = $products->pluck('id')->toArray();
        $productmeta = collect(Productmetadata::whereIn('PROD_PRODUCT',$keys)->get()->toArray());
        
        $settings = Setting::findByStoreId($shopApi->id);
        if ( is_null($settings) or ( empty($settings->getServientregaApi()) or empty($settings->getServientregaSecret()) ) )
        {
            return redirect()->route('settings');
        }

        app('translator')->setLocale($settings->getLanguage());
        return view('shopify.products',[
            'products' => $products,
            'productmeta' => $productmeta
        ]);

    }

    public function save(Request $request){
        $response = [];
        try
        {
            $shop   = Auth::user();
            $data = $request->all();
            $id_product  = $data["id_producto"];
            $delivery    = isset($data["available_for_servientrega"])? true: false;
            $alto        = $data['alto'];
            $largo       = $data['largo'];
            $ancho       = $data['ancho'];
            $dimensions  = "{$alto}x{$largo}x{$ancho}";
          
            $shopApi = $shop->api()->rest('GET', '/admin/shop.json')['body']['shop'];

            $metafieldArray = array(
                'metafield' => array(
                    "namespace"     => "servientregashipping",
                    "key"           => "dimensions",
                    "value"         => $dimensions,
                    "value_type"    => "string",
                    "description"   => "Servientrega product dimensions"
                )
            );

            $prodmeta   = Productmetadata::where('PROD_PRODUCT',$id_product)->where('PROD_METADATA_KEY','dimensions')->first();
            if ( is_null($prodmeta) )
            {
                $metafield    = $shop->api()->rest('POST', "/admin/products/{$id_product}/metafields.json", $metafieldArray);
                $prodmeta = new Productmetadata();
                $prodmeta->PROD_SHOP            = $shop->id;
                $prodmeta->PROD_PRODUCT         = $id_product;
                $prodmeta->PROD_METADATA_ID     = $metafield['body']['metafield']['id'];
                $prodmeta->PROD_METADATA_KEY    = $metafield['body']['metafield']['key'];
                $prodmeta->PROD_METADATA_VALUE  = $metafield['body']['metafield']['value'];
                $prodmeta->PROD_METADATA_TYPE   = $metafield['body']['metafield']['value_type'];
                $prodmeta->save();
            }else
            {
                //update the data
                $metafield    = $shop->api()->rest('PUT', "/admin/products/$id_product/metafields/{$prodmeta->PROD_METADATA_ID}.json", $metafieldArray);
                $prodmeta->PROD_SHOP            = $shop->id;
                $prodmeta->PROD_PRODUCT         = $id_product;
                $prodmeta->PROD_METADATA_ID     = $metafield['body']['metafield']['id'];
                $prodmeta->PROD_METADATA_KEY    = $metafield['body']['metafield']['key'];
                $prodmeta->PROD_METADATA_VALUE  = $metafield['body']['metafield']['value'];
                $prodmeta->PROD_METADATA_TYPE   = $metafield['body']['metafield']['value_type'];
                $prodmeta->save();

            }

            
            $metafield_afg = array(
                'metafield' => array(
                    "namespace"     => "servientregashipping",
                    "key"           => "available_for_servientrega",
                    "value"         => $delivery,
                    "value_type"    => "string",
                    "description"   => "Available for Servientrega Delivery"
                )
            );

            //if is checked for delivery
            if ( $delivery )
            {
                $meta_available   = Productmetadata::where('PROD_PRODUCT',$id_product)->where('PROD_METADATA_KEY','available_for_servientrega')->first();
                if ( is_null($meta_available) )
                {
                    $metafield    = $shop->api()->rest('POST', "/admin/products/$id_product/metafields.json", $metafield_afg);
                    $prodmeta = new Productmetadata();
                    $prodmeta->PROD_SHOP            = $shop->id;
                    $prodmeta->PROD_PRODUCT         = $id_product;
                    $prodmeta->PROD_METADATA_ID     = $metafield['body']['metafield']['id'];
                    $prodmeta->PROD_METADATA_KEY    = $metafield['body']['metafield']['key'];
                    $prodmeta->PROD_METADATA_VALUE  = $metafield['body']['metafield']['value'];
                    $prodmeta->PROD_METADATA_TYPE   = $metafield['body']['metafield']['value_type'];
                    $prodmeta->save();
                }

            }else
            {
                $prodmeta     = Productmetadata::where('PROD_PRODUCT',$id_product)->where('PROD_METADATA_KEY','available_for_servientrega')->first();
                if ( $prodmeta )
                {
                    $metafield    = $shop->api()->rest('DELETE', "/admin/products/$id_product/metafields/{$prodmeta->PROD_METADATA_ID}.json");
                    $deleted      = $prodmeta->delete();
                }
            }

            // return ['success' => true, 'text'=>$mintext, 'product'=>$id_product, 'message'=> __('servientrega.preparationform.save.success')];
            return redirect()->route('products');

        }
        catch (Exception $e)
        {
            Log::critical($e->getMessage());
            $response = ['success' => false, 'errors'=>['message'=> __('servientrega.preparationform.save.error')] ];
        }

        return redirect()->route('products');
    }


    public function delete(Request $request){
        $response = [];
        try
        {
            $shop   = Auth::user();
            $data = $request->all();
            $metaid = $data['id_meta'];
            $product = $data['product']; //Product id

            $shopApi = $shop->api()->rest('GET', '/admin/shop.json')['body']['shop'];            
            $settings   = setting::findByStoreId($shopApi->id);
            app('translator')->setLocale($settings->getLanguage());


            $prodmeta   = Productmetadata::where('PROD_PRODUCT',$product)->where('PROD_METADATA_ID', $metaid)->first();
            if(!is_null($prodmeta))
            {
                $meta = $shop->api()->rest('DELETE', "/admin/products/$product/metafields/$metaid.json");
                $prodmeta->delete();

            }

            // return ['success' => true, 'metaid'=>$metaid, 'product'=>$product, 'message'=> __('servientrega.preparationform.save.success')];
            return redirect()->route('products');
        }
        catch (Exception $e)
        {
            Log::critical($e->getMessage());
            $response = ['success' => false, 'errors'=>['message'=> __('servientrega.preparationform.save.error')]];
        }

        return redirect()->route('products');
    }

   

}
