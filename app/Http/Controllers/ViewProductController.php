<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ViewProductController extends Controller
{
    public function index(){
        $products = Product::orderBy("created_at","desc")->get();
        return view('product', [
            'products'=>$products
        ]);

    }
}
