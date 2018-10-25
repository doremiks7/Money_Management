<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Wallet;
use App\Transfer;
use App\Transaction;
use App\Http\Requests;
use App\Http\Requests\TransactionRequest;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function Wallet_Be_List($id_wallet){
        $data = DB::table('transactions')->where('id_wallet', $id_wallet)->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $this->id_wallet = $id_wallet;
        return view('wallet.transaction.list', compact('data', 'id_wallet'));
    }

    public function Wallet_Be_Create($id_wallet)
    {
        $this->id_wallet = $id_wallet;
        $cate = DB::table('categories')->where('user_id', Auth::user()->id)->get();
        $wallet = Wallet::find($id_wallet);
        return view('wallet.transaction.add_specific_wallet', compact('cate', 'wallet', 'id_wallet'));
    }

    public function Wallet_Be_Store(TransactionRequest $request, $id_wallet)
    {
        // save transaction
        $transaction = new Transaction;
        $transaction->id_category = $request->sltCate;
        $transaction->id_wallet = $id_wallet;
        $transaction->amount = str_replace(',', '', $request->txtAmount);
        $transaction->user_id = Auth::user()->id;
        $transaction->description = $request->txtDescription;
        $transaction->with_who = $request->txtWithWho;
        $transaction->save();
        // end save transaction
        
        // save wallet
        $wallet = Wallet::find($id_wallet);
        if($request->sltKindCate == 1)
        {
            $wallet->amount = $wallet->amount + str_replace(',', '', $request->txtAmount);
        }
        else{
            $wallet->amount = $wallet->amount - str_replace(',', '', $request->txtAmount);
        }
        $wallet->save();
        // end save wallet

        return redirect()->route('wallet_be_list', $id_wallet);
        
    }

    public function Transaction_Be_Delete($id_transaction, $id_wallet)
    {
        $transaction = Transaction::findOrFail($id_transaction);
        $this->id_wallet = $id_wallet;

        $category_of_transaction = DB::table('categories')->where('id', $transaction->id_category)->first();
        $wallet = Wallet::find($id_wallet);
        if($category_of_transaction->kind == 1)
        {
            $wallet->amount = $wallet->amount - $transaction->amount; 
        }
        else{
            $wallet->amount = $wallet->amount + $transaction->amount; 
        }
        $wallet->save();

        $transaction->delete();
        return redirect()->route('wallet_be_list', $id_wallet);
    }



    public function index()
    {
       /* $data = DB::table('transactions')->where('user_id', Auth::user()->id)->selectRaw("month(timestamp) as month")->get();
*/
        $data = DB::table('transactions')->where('user_id', Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('wallet.transaction.list_all', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = DB::table('categories')->where('user_id', Auth::user()->id)->get();
        $wallet = DB::table('wallets')->where('user_id', Auth::user()->id)->get();
        return view('wallet.transaction.add', compact('cate', 'wallet'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $transac = new Transaction;
        $transac->id_wallet = $request->sltWallet;
        $transac->id_category = $request->sltCate;
        $transac->amount = str_replace(',', '', $request->txtAmount);
        $transac->user_id = Auth::user()->id;
        $transac->description = $request->txtDescription;
        $transac->with_who = $request->txtWithWho;

        $wallet = Wallet::find($transac->id_wallet);
        if($request->sltKindCate == 1){
            $wallet->amount = $wallet->amount +  $transac->amount;
        }
        else{
            $wallet->amount = $wallet->amount -  $transac->amount;
        }
        $wallet->save();
        $transac->save();
        return redirect()->route('transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_transaction, $id_wallet)
    {
        $transaction = DB::table('transactions')->where('id', $id_transaction)->first();
        return view('wallet.transaction.edit', compact('transaction', 'id_wallet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, $id_transaction, $id_wallet)
    {
        $transaction = Transaction::find($id_transaction);
        $amount_temp = $transaction->amount;
        $transaction->id_category = $request->sltCate;
        $transaction->id_wallet = $id_wallet;
        $transaction->amount = str_replace(',', '', $request->txtAmount);
        $transaction->description = $request->txtDescription;
        $transaction->with_who = $request->txtWithWho;
        $transaction->save();

        // save wallet
        $wallet = Wallet::find($id_wallet);
        if($request->sltKindCate == 1)
        {
            $wallet->amount = $wallet->amount + str_replace(',', '', $request->txtAmount) - $amount_temp;
        }
        else{
            $wallet->amount = $wallet->amount - str_replace(',', '', $request->txtAmount) + $amount_temp;
        }
        $wallet->save();
        // end save wallet

        return redirect()->route('wallet_be_list', $id_wallet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
