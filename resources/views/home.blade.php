@extends('layouts.master')
@section('title', 'Home')
@section('content')
<?php
    $userCount = App\User::all()->count();
    $merchantCount = App\Merchant::all()->count();
    $productCount = App\Product::all()->count();
?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="panel-title"> Home </p>
                </div>
                <div class="panel-body">
                    <h3>User = {{$userCount}}</h3>
                    <h3>Merchant = {{$merchantCount}}</h3>
                    <h3>Product = {{$productCount}}</h3>
                </div>
            </div>
        </div>
    </div>
@stop
