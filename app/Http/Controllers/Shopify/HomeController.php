<?php

namespace App\Http\Controllers\Shopify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Vexsolutions\Helpers\Dates;
use App\Vexsolutions\Helpers\UStore;
use App\Models\EMMetadata;
use App\Models\Store;
use App\Models\Hour;
use App\Models\Setting;
use App\Models\Language;
use App\Models\Location;
use App\Models\Country;
use App\Models\Holiday;
use App\Models\OrderStatus;
use App\Models\Productmetadata;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Log;

class HomeController extends Controller
{

    public function __construct()
    {
        app('translator')->setLocale('en');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $shop = Auth::user();
        $shopApi = $shop->api()->rest('GET', '/admin/shop.json');
        if( isset ( $shopApi['body']['shop']) ){
            $shopApi = $shopApi['body']['shop'];
            $settings = new Setting();
            $settings = Setting::findByStoreId($shopApi->id);
        }
        else{
            $settings = new Setting();
        }

        if (is_null($settings)) {
            $default_lang = UStore::DefLang($shopApi);
            $settings = new Setting();
            $settings->setLanguage($default_lang);
        }
        app('translator')->setLocale($settings->getLanguage());
        
        return view('shopify.welcome');

    }

}
