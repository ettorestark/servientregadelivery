<?php namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Contracts\Objects\Values\ShopDomain;
use stdClass;

use Illuminate\Support\Facades\DB;
use App\Models\Store;
use App\Models\Setting;
use App\Models\Productmetadata;
use App\Models\EMMetadata;
use App\Models\Customer\EMRequestdata;
use App\Models\Order;

class CustomersRedactJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Shop's myshopify domain
     *
     * @var ShopDomain
     */
    public $shopDomain;

    /**
     * The webhook data
     *
     * @var object
     */
    public $data;

    /**
     * Create a new job instance.
     *
     * @param string   $shopDomain The shop's myshopify domain
     * @param stdClass $data    The webhook data (JSON decoded)
     *
     * @return void
     */
    public function __construct($shopDomain, $data)
    {
        $this->shopDomain = $shopDomain;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {

            //settings
            $emsettings = Setting::findByStoreId($this->data->shop_id);

            if ( $emsettings )
            {
                //products metadata
                Productmetadata::where('PROD_SHOP',$this->data->shop_id )->delete();
                
                //store metadata
                EMMetadata::where('META_SETTING', $emsettings->getId())->delete();

                $emsettings->locations()->delete();
                $emsettings->workinghours()->delete();
                $emsettings->hollydays()->delete();
                $emsettings->metadata()->delete();
                $emsettings->delete();
                $emsettings->forceDelete();
            }

            //store
            $store = Store::where('STORE_DOMAIN', $this->shopDomain )->first();
            if ( $store)
            {
                $store->delete();
                $store->forceDelete();
            }

            //orders 
            if( !empty($this->data->orders_to_redact) ){
                Order::destroy( $this->data->orders_to_redact );
            }

            $emrequest = new EMRequestdata();
            $emrequest->date    = DB::raw('now()');
            $emrequest->status  = 0;
            $emrequest->payload = $this->data;
            $emrequest->topic   = 'shop-redact';
            $emrequest->save();

            $response=['success'=>true, 'message'=>"{$data->shop_domain}, Store data will be deleted from the database"];

        } catch(\Exception $e) {
            Log::error($e->getMessage());
            $response=['success'=>false, 'errors'=>['message'=>$e->getMessage()]];
        }

        return  response()->json($response, 200);

    }
}
