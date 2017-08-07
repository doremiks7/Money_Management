<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Wallet;
use App\Transfer;
use App\Transaction;
use App\Http\Requests;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function WalletList($id){
        /*$data = Wallet::find($id)->transaction()->get()->toArray();*/
        $data = DB::table('transactions')->where('id_wallet', $id)->where('user_id', Auth::user()->id)->get();
        return view('wallet.transaction.list', compact('data'));
    }

    public function index()
    {
        
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
    public function store(Request $request)
    {
        $transac = new Transaction;
        $transac->id_wallet = $request->sltWallet;
        $transac->id_category = $request->sltCate;
        $transac->amount = str_replace(',', '', $request->txtAmount);
        $transac->user_id = Auth::user()->id;
        $transac->description = $request->txtDescription;
        $transac->with_who = $request->txtWithWho;
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
