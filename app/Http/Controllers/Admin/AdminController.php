<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $products = Product::orderBy("created_at","desc")->get();
        return view('admin.dashboard', [
            'products'=>$products
        ]);

    }
}
