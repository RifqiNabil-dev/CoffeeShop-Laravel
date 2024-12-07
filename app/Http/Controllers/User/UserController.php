<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;

class UserController extends Controller
{
    public function home(){
        return view('welcome');
    }

    public function addCart($id){
        $product_id = $id;
        $user = Auth::user();

        // Ambil data produk berdasarkan ID
        $product = Product::find($id);

        // Periksa apakah produk ditemukan
        if (!$product) {
            return redirect()->back();
        }

        // Periksa ketersediaan stok
        if ($product->sku <= 0) {
            return redirect()->back()->with('error', 'Stok produk habis.');
        }
        $product->sku -= 1;
        $product->save();

        $user_id = $user->id;
        $data = new Cart;
        $data->user_id = $user_id;
        $data->product_id = $product_id;
        $data->save();
        
        return redirect()->back();
    }

    public function order(){
        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;
    
            // Ambil semua cart milik user
            $cart = Cart::where('user_id', $user_id)->with('product')->get();
    
            // Kelompokkan berdasarkan product_id 
            $groupedCart = $cart->groupBy('product_id')->map(function ($group) {
                $firstItem = $group->first(); // Ambil satu data dari setiap grup
                $firstItem->quantity = $group->count(); // Tambahkan kuantitas
                return $firstItem;
            });
    
            $cart = $groupedCart->values();
        }
    
        return view('order', compact('cart'));
    }

    public function removeCart($id){

        $data = Cart::find($id);
        $data->delete();
        return redirect()->back();

    }
    
}
