<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

//        logger()->channel('telegram')->debug('$message');
    $product = \App\Models\Product::query()
        ->with(['categories', 'brand'])
        ->select('id', 'title', 'brand_id')
                       ->where('id', 1)->get();


    dump($product[0]->title);
    dump($product[0]->categories[0]->title);
    dump($product[0]->brand->title);
    dump($product[0]->brand());
    return view('welcome');
});

Route::get('/t', function () {
});
