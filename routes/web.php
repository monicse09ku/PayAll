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

/*Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/logout', 'HomeController@logout');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/superadmin', function(){
    echo "Hello superadminAdmin";
})->middleware('auth','superadmin');
 
Route::get('/admin', function(){
    echo "Hello Admin";
})->middleware('auth','admin');
 
Route::get('/reseller', function(){
    echo "Hello reseller";
})->middleware('auth','reseller');

Route::apiResources([
    'resellers' => 'ResellerController',
    'payments' => 'PaymentController',
]);
Route::post('create-top-up', 'PaymentController@createTopUp');
Route::post('update-top-up', 'PaymentController@updateTopUp');
Route::post('delete-top-up', 'PaymentController@deleteTopUp');

Route::get('bd-topups', 'PaymentController@bdTopUps');
Route::get('ind-topups', 'PaymentController@indTopUps');
Route::get('pak-topups', 'PaymentController@pakTopUps');