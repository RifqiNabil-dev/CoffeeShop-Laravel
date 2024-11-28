<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy("created_at","desc")->get();

        return view('admin.product',[
            'products'=>$products
        ]);
    }

    public function store(Request $request){
        $rules = [
            'name'=> 'required|min:5',
            'sku'=> 'required|numeric',
            'price'=> 'required|numeric',
        ];

        if ($request->image !=""){
            $rules['image'] = 'image';
        }
    
        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->route('admin.create')->withInput()->withErrors($validator);
        }

        //insert product in db
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image !=""){

            //insert image in db
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;
    
            $image->move(public_path('uploads/product'),$imageName);
    
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('admin.product')->with('success','Product added successfully.');
    }

    public function create(){
        return view('admin.create');
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        return view('admin.edit',[
            'product'=> $product
        ]);
        
    }

    public function update($id, Request $request){
        $product = Product::findOrFail($id);

        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|numeric',
            'price' => 'required|numeric'            
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return redirect()->route('admin.edit',$product->id)->withInput()->withErrors($validator);
        }

        // here we will update product
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != "") {

            // delete old image
            File::delete(public_path('uploads/product/'.$product->image));

            // here we will store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;


            $image->move(public_path('uploads/product'),$imageName);

            // Save image name in database
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('admin.product')->with('success','Product updated successfully.');
    }

    public function destroy($id){
        $product = Product::findOrFail($id);

        // delete image
       File::delete(public_path('uploads/product/'.$product->image));

       // delete product from database
       $product->delete();

       return redirect()->route('admin.product')->with('success','Product deleted successfully.');
    }
}
