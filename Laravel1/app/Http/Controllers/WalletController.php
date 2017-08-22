<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WalletRequest;
use App\Http\Requests;
use App\Wallet;
use Auth;
use Illuminate\Validation\Rule;
use DB;

class WalletController extends Controller
{

    public function index()
    {
        $wl = DB::table('wallets')->where('user_id', Auth::user()->id)->get();
        return view('wallet.list', compact('wl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wl = DB::table('wallets')->where('user_id', Auth::user()->id)->get();
        return view('wallet.add', compact('wl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WalletRequest $request)
    {
        $amount = $request->txtAmountWallet;
        $wl = new Wallet;
        $wl->name = $request->txtNameWallet;
        $wl->amount = str_replace(",","",$amount);
        $wl->user_id = Auth::user()->id;
        $wl->save();
        return redirect()->route('wallet.index')->with(['flash-level' => 'success', 'flash-message' => 'You have added Wallet successfuly']);
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
        $wl = DB::table('wallets')->where('user_id', Auth::user()->id)->get();
        $data = Wallet::find($id);
        $name_wallet_edit = $data->name;
        return view('wallet.edit', compact('data', 'wl', 'name_wallet_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\WalletRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WalletRequest $request, $id)
    {

        $wallet = Wallet::find($id)->where('user_id', Auth::user()->id)->first();    
        $wallet->name = $request->txtNameWallet;  
        $wallet->amount = str_replace(',', '', $request->txtAmountWallet);   

        $wallet->save();

        return redirect()->route('wallet.index')->with(['flash-level' => 'success', 'flash-message' => 'You have been updated successful']);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wallet = Wallet::findOrFail($id);
        $wallet->delete();
        return redirect()->route('wallet.index')->with(['flash-level' => 'success', 'flash-message' => 'You have been deleted successful']);
    }

    
}
