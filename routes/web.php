<?php


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


use Illuminate\Routing\Router;


Route::get('/', function () {
    return view('welcome');
});




Route::group([
    // 'namespace'     => 'App\\Http\\Controllers',
//    'middleware'    => ['web'],
], function (Router $router) {


    $router->get('/checkout/pay', ['as' => 'checkout.pay', 'uses' => 'PaymentController@pay']);

    $router->get('/checkout/thanks', ['as' => 'checkout.thanks', 'uses' => 'CheckoutController@thanks']);
    $router->get('/checkout/pending', ['as' => 'checkout.pending', 'uses' => 'CheckoutController@pending']);
    $router->get('/checkout/error', ['as' => 'checkout.error', 'uses' => 'CheckoutController@error']);


    $router->get('/ipn', ['as' => 'ipn', 'uses' => 'PaymentController@ipn']);

});