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

class CustomersDataRequestJob implements ShouldQueue
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
 
            //store
            $store = Store::where('STORE_DOMAIN', $this->shopDomain )->first();
           
            //orders 
            $orders = Order::find( $this->data->orders_to_redact );

            if( empty($emsettings) && empty($store) && empty($orders) ){
                $response=[
                    'success'=>true, 
                    'store information'=> ['not information saved for this store'] 
                ];
            }
            else{
                $response=[
                    'success'=>true, 
                    'store information'=> [
                        'settings'=>json_encode($emsettings), 
                        'store'=>json_encode($store),  
                        'orders'=>json_encode($orders)
                    ] 
                ];
            }

        } catch(\Exception $e) {
            Log::error($e->getMessage());
            $response=['success'=>false, 'errors'=>['message'=>$e->getMessage()]];
        }

        return  response()->json($response, 200);
    }
}
