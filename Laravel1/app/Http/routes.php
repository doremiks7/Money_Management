<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');


Route::get('information/{id}',['as' => 'getUpdate', 'uses' =>'InfomationController@getUpdate'] );
Route::post('information/{id}',['as' => 'postUpdate', 'uses' =>'InfomationController@postUpdate'] );
Route::get('changepassword', ['as' => 'getChangePassword', 'uses' =>'InfomationController@getChangePassword']);
Route::post('changepassword', ['as' => 'postChangePassword', 'uses' =>'InfomationController@postChangePassword']);

Route::get('gettransfer',['as' => 'getTransfer', 'uses' => 'TransferController@getTransfer']);
Route::post('posttransfer',['as' => 'postTransfer', 'uses' =>'TransferController@postTransfer']);

Route::resource('wallet', 'WalletController');
Route::resource('category', 'CategoryController');
Route::resource('transaction', 'TransactionController');
Route::get('Wallet_List/{id}',['as' =>'wallet_list', 'uses' => 'TransactionController@WalletList']);

Route::get('master', function(){
	return view('wallet.master');
});