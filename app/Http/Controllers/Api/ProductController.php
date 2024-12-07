<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return response()->json([
            'status' => true,
            'massage' => 'Data berhasil ditemukan',
            'data' => $product
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'sku'=> 'required|numeric',
            'price'=> 'required|numeric',
            'description'=> 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message'=> 'validasi error',
                'errors' => $validator->errors()
            ],422);
        }

        $product = Product::create($request->all());
        return response()->json([
            'status'=> true,
            'message'=> 'data berhasil dimasukkan',
            'data'=> $product
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return response()->json([
            'status'=> true,
            'message' => 'Data berhasil ditemukan',
            'data'=> $product
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'sku'=> 'numeric',
            'price'=> 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message'=> 'validasi error',
                'errors' => $validator->errors()
            ],422);
        }

        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json([
            'status'=> true,
            'message'=> 'Data berhasil diupdate',
            'data'=> $product
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json([
            'status'=> true,
            'message'=> 'Data berhasil dihapus'
        ],204) ;
    }
}
