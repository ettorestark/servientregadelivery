<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use Exception;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Shopify\ShopifyApplicationController; 

use App\User;

class AfterAuthenticateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($shop)
    {
        $this->shop = $shop;
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (is_null($this->shop)){
            return false;
        }
        try
        {
            //for logs
            $carbonNow  = Carbon::now('America/Mexico_City');
            $fileToLog  = storage_path("logs/shopify/{$this->shop->shopify_domain}/app/install-".$carbonNow->format('Y-m-d') .".log");

            $shopifystore = $this->shop->api()->rest('GET', '/admin/shop.json')['body']['shop'];

            $shopify = new ShopifyApplicationController();
            $shopify->onInstall($this->shop, $shopifystore, $shopifystore->id);
            DB::commit();

        }catch (Exception $e)
        {
            Log::critical($e);
        }

    }
}
