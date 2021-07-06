<?php

namespace App\Http\Controllers;

use App\Merchant;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('product.index');
    }

    public function getall()
    {
        $product = DB::table('merchants')
        ->join('products', 'merchants.id', '=', 'products.merchant_id')
        ->select('merchants.merchant_name', 'products.*')
        ->get();

        return DataTables::of($product)
            ->addColumn('status',
            function ($product) {
                if ($product->status == 0) return 'Tersedia';
                if ($product->status == 1) return 'Habis';
            })
            ->addColumn('action', 'product.action')
            ->setRowClass(function ($product) {
                return $product->status ? '' : '';
            })->make(true);
    }


    /**
     * Show the form for creating aUser::query() new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['merchant'] = Merchant::all();
        $view = View::make('product.create', $data)->render();
        return response()->json(['html' => $view]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'merchant_id' => 'required'
        ]);
        $product = new product;

        $product->name = $request->name;
        $product->merchant_id = $request->merchant_id;
        $product->price = $request->price;
        $product->status = $request->status;

        $product->save();
        return response()->json(['html' => 'Successfully Inserted']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $view = View::make('product.view', compact('product'))->render();
        return response()->json(['html' => $view]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $data['merchant'] = Merchant::all();
        $view = View::make('product.edit', compact('product'), $data)->render();
        return response()->json(['html' => $view]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->name = $request->name;
        $product->merchant_id = $request->merchant_id;
        $product->price = $request->price;
        $product->status = $request->status;

        $product->save();
        return response()->json(['html' => 'Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['type' => 'success', 'message' => 'Successfully Deleted']);
    }
}
