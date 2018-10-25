<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Category;
use App\Http\Controllers\TransactionController;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cate_thu = DB::table('categories')->where('user_id',Auth::user()->id)->where('kind', 1)->get();
        $cate_chi = DB::table('categories')->where('user_id',Auth::user()->id)->where('kind', 2)->get();
        return view('wallet.category.list', compact('cate_thu', 'cate_chi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $cate = DB::table('categories')->where('user_id', Auth::user()->id)->get();
         return view('wallet.category.add', compact('cate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
       $cate = new Category;
       $cate->name = $request->txtNameCate;
       $cate->user_id = Auth::user()->id;
       $cate->parent_id = $request->sltParentCate;
       $cate->kind = $request->sltKindCate;
       $cate->save();
       return redirect()->route('category.index')->with(['flash-level' => 'success', 'flash-message' => 'You have been added successful']);
   
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
        $cate = DB::table('categories')->where('user_id', Auth::user()->id)->get();
        $data = Category::find($id);
        $parent = Category::select('id', 'name', 'parent_id')->get()->toArray();
        return view('wallet.category.edit', compact('cate', 'data', 'parent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $cate = Category::find($id);
        $cate->name = $request->txtNameCate;
        $cate->parent_id = $request->sltParentCate;
        $cate->kind = $request->sltKindCate;
        $cate->save();
        return redirect()->route('category.index')->with(['flash-level' => 'success', 'flash-message' => 'You have updated successful']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cate = Category::findOrFail($id);
        
        $all_cate = DB::table('categories')->where('user_id', Auth::user()->id)->get();
        foreach ($all_cate as $value) 
        {
            if($value->parent_id == $id)
            {
                return back()->with(['flash-level' => 'danger', 'flash-message' => 'You cant delete this category, please delete the sub of this category']);
            }
        }
        
        $transactionsDelete = DB::table('transactions')->where('id_category', $cate->id)->get();

        foreach ($transactionsDelete as $value) {
             (new TransactionController)->Transaction_Be_Delete($value->id, $value->id_wallet);
        }
       
        $cate->delete();
        return redirect()->route('category.index')->with(['flash-level' => 'success', 'flash-message' => 'You have been deleted successful']);

        
    }
}
