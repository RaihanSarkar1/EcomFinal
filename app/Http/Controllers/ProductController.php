<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductAddRequest;
use App\Http\Requests\ProductEditRequest;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    function addProduct() {

        $categories = Category::all();

        return view('product.add_product', compact('categories'));
    }

    function createProduct(ProductAddRequest $request) {


        // Getting the selected categories
        // $items = $request->get('category');
        // $selected_item = "";
        // foreach($items as $item) {
        //     $selected_item .= $item.',';
        // }
        // dd($selected_item);
        
        $extension = $request->file('image')->getClientOriginalExtension();
        $file_name = random_int(0001, 9999).'.'.$extension;
        $file_path = 'product/'.$file_name;
        
        Storage::disk('public')->put($file_path, file_get_contents($request->file('image')));
        
        // Creating the data in products table
        Product::insert([
            'code' => $request->code,
            'name' => $request->name,
            'price' => $request->price,
            'photo' => $file_path,
            'created_at' => now(),
        ]);
        
        
        // getting the id of the last insert in products table
        $id = DB::getPdo()->lastInsertId();
        
        // Getting all the selected categories
        $items = $request->get('category');
        
        // Creating an empty array
        $data = array();
        // populating the data array
        foreach($items as $item){
            array_push($data, [
                'product_id' => $id,
                'category_id' => $item,
            ]);
        }

        // inserting the corresponding data to the product_category table
        DB::table('product_category')->insert($data);
        
        return redirect('view_products');
    }

    function viewProducts() {
        $products = Product::get();
 
        return view('product.products', compact('products'));
    }

    function deleteProduct($id) {
        $product = Product::find($id);
        $file_path = $product->photo;
        Storage::disk('public')->delete($file_path);
        $product->delete();
        return redirect('view_products');
    }

    function editProduct($id) {
        $product = Product::where('id', $id)->first();
        $categories = Category::all();
        $selected_item = DB::table('product_category')->where('product_id',$id)->select('category_id')->get();
        return view('product.edit_product', compact('product','categories','selected_item'));
    }

    function updateProduct($id, ProductEditRequest $request) {

        $product = Product::find($id);

        if ($request->has('image')) {

            $extension = $request->file('image')->getClientOriginalExtension();
            $file_name = random_int(0001, 9999).'.'.$extension;
            $file_path = 'product/'.$file_name;
            if ($product->photo) {
                Storage::disk('public')->delete('product/'.$product->photo);
            }
            Storage::disk('public')->put($file_path, file_get_contents($request->file('image')));
        } else {
            $file_name = $product->photo;
        }

        Product::find($id)->update([
            'code' => $request->code,
            'name' => $request->name,
            'price' => $request->price,
            'photo' => $file_name,
            'updated_at' => now(),
        ]);

        // Getting all the selected categories
        $items = $request->get('category');
        
        // Creating an empty array
        $data = array();
        // populating the data array
        foreach($items as $item){
            array_push($data, [
                'product_id' => $id,
                'category_id' => $item,
            ]);
        }

        // Deleting the previous categories
        DB::table('product_category')->where('product_id',$id)->delete();
        
        // Replacing with new categories
        DB::table('product_category')->insert($data);


        return redirect('view_products');
    }

    


}