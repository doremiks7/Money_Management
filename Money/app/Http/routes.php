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

/*information*/
Route::get('information/{id}',['as' => 'getUpdate', 'uses' =>'InfomationController@getUpdate']);
Route::post('information/{id}',['as' => 'postUpdate', 'uses' =>'InfomationController@postUpdate'] )->where(['tuoi' => '[0-9]+']);
/*end information*/

/* change password */
Route::get('changepassword', ['as' => 'getChangePassword', 'uses' =>'InfomationController@getChangePassword']);
Route::post('changepassword', ['as' => 'postChangePassword', 'uses' =>'InfomationController@postChangePassword']);
/*end change password */

/*transfer*/
Route::get('gettransfer',['as' => 'getTransfer', 'uses' => 'TransferController@getTransfer']);
Route::post('posttransfer',['as' => 'postTransfer', 'uses' =>'TransferController@postTransfer']);
Route::get('history_transfer', ['as' => 'historyTransfer', 'uses' => 'TransferController@history_transfer']);
Route::post('delete_history_transfer/{id}', ['as' => 'deleteHistoryTransfer', 'uses' => 'TransferController@delete_history_transfer']);

/*end transfer*/


Route::resource('wallet', 'WalletController');
Route::resource('category', 'CategoryController');

/*transaction*/
Route::resource('transaction', 'TransactionController');
Route::get('Wallet_Be_List/{id}',['as' =>'wallet_be_list', 'uses' => 'TransactionController@Wallet_Be_List']);
Route::get('Wallet_Be_Add/{id}', ['as' =>'wallet_be_add', 'uses' => 'TransactionController@Wallet_Be_Create']);
Route::post('Wallet_Be_Store/{id}', ['as' =>'wallet_be_store', 'uses' => 'TransactionController@Wallet_Be_Store']);
Route::post('Transaction_Be_Delete/{id_transaction}/{id_wallet}', ['as' =>'transaction_be_delete', 'uses' =>'TransactionController@Transaction_Be_Delete']);
Route::get('transaction/{id_transaction}/{id_wallet}',['as' => 'edit','uses' => 'TransactionController@edit']);
Route::put('transaction/{id_transaction}/{id_wallet}',['as' => 'update','uses' => 'TransactionController@update']);
/*end transaction*/

Route::get('transaction_belong_category/{id_category}', function($id_category){
	return view('wallet.transaction.list_transaction_category', compact('id_category'));
});

Route::get('master', function(){
	return view('wallet.master');
});