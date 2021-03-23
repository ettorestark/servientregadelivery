<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


use Illuminate\Support\Facades\Response;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (){ return view('Layouts.public');})->middleware(['web']);

Route::middleware(['auth.shopify', 'billable'])->group(function () {

    Route::get('home', 'Shopify\HomeController@index')->name('home');

    Route::get('settings', 'Shopify\SettingController@index')->name('settings');
    Route::post('settings/save', 'Shopify\SettingController@save')->name('settings.save');
    

    Route::get('products', 'Shopify\ProductController@index')->name('products');
    Route::post('products/save', 'Shopify\ProductController@save')->name('products.save');
    Route::post('products/delete', 'Shopify\ProductController@delete')->name('products.delete');

    Route::get('orders/{page?}', 'Shopify\OrderController@index')->name('orders');
    Route::get('orderDetails/{id_order}/{id_shipping?}', 'Shopify\OrderController@orderDetail')->name('orderDetail');
    
    Route::get('order/see_pdf_stickers/{guide_number?}', 'Shopify\OrderController@see_pdf_stickers')->name('see_pdf_stickers');
    Route::post('order/cancel/', 'Shopify\OrderController@cancel')->name('orders.cancel');
    Route::post('order/resend/', 'Shopify\OrderController@resendServientrega')->name('orders.resendServientrega');
    Route::post('order/solicitar', 'Shopify\OrderController@servientregarecoleccion')->name('solicitar');

    Route::post('delete_image/', 'Shopify\SettingController@deleteImage')->name('delete_imagen');

});

Route::post('api/productavailability.json'  , 'Shopify\ShopifyApplicationController@getProductAvaliable')->name('shopify.product.availability');

Route::any('api/create/carrierService','Shopify\ShopifyApplicationController@getRate');
Route::any('api/create/webhook/order','Shopify\OrderController@create');
Route::any('api/configureTheme.json', 'Shopify\ShopifyApplicationController@configureTheme');

Route::post('api/workingdays.json', 'Shopify\ShopifyApplicationController@getWorkingDays')->name('shopify.setting.workingdays');
Route::post('api/workingtime.json', 'Shopify\ShopifyApplicationController@getWorkingTimes')->name('shopify.setting.workingtimes');

Route::post('api/sendmail', 'Shopify\EmailController@sendEmail')->name('shopify.email.send');

Route::get('api/testmail', 'Shopify\EmailController@testEmail')->name('shopify.email.test');

Route::get('test/cotizador', 'Servientrega\testController@consultarIde')->name('cotizdor.test');
