<?php

namespace App\Http\Controllers;

use App\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('merchant.index');
    }

    public function getall()
    {
        $merchant = Merchant::orderBy('id', 'asc');
        return DataTables::of($merchant)
            ->addColumn('action', 'merchant.action')
            ->setRowClass(function ($merchant) {
                return $merchant->status ? '' : '';
            })->make(true);
    }


    /**
     * Show the form for creating aUser::query() new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $view = View::make('merchant.create')->render();
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
            'country_code' => 'required',
            'merchant_name' => 'required'
        ]);
        $merchant = new Merchant;

        $merchant->country_code = $request->country_code;
        $merchant->merchant_name = $request->merchant_name;

        $merchant->save();
        return response()->json(['html' => 'Successfully Inserted']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Merchant $merchant
     * @return \Illuminate\Http\Response
     */
    public function show(Merchant $merchant)
    {
        $view = View::make('merchant.view', compact('merchant'))->render();
        return response()->json(['html' => $view]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Merchant $merchant
     * @return \Illuminate\Http\Response
     */
    public function edit(Merchant $merchant)
    {
        $view = View::make('merchant.edit', compact('merchant'))->render();
        return response()->json(['html' => $view]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Merchant $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merchant $merchant)
    {
        $merchant->country_code = $request->country_code;
        $merchant->merchant_name = $request->merchant_name;

        $merchant->save();
        return response()->json(['html' => 'Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Merchant $merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchant $merchant)
    {
        $merchant->delete();
        return response()->json(['type' => 'success', 'message' => 'Successfully Deleted']);
    }
}
