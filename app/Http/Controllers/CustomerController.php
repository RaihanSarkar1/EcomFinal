<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Order;
use App\OrderProduct;
use App\Http\Requests\OrderRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class CustomerController extends Controller
{
    function viewProducts() {
        $products = Product::join('product_category', 'products.id', '=', 'product_category.product_id')
        ->join('categories', 'product_category.category_id', '=', 'categories.id')
        ->select('products.*', 'categories.name as category_name')
        ->orderBy('categories.name')
        ->orderBy('products.name')
        ->get();

        $categories = Category::pluck('name');
 
        return view('customer_product.view_product', compact('products','categories'));
    }

    function cart() {
        return view('customer_product.cart');
    }

    function addToCart($id) {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart',[]);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "image" => $product->photo,
                "price" => $product->price,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product add to cart sucessfully');
    }

    function remove($id) {
        if($id) {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Product sucessfully removed!');
        }
    }

    function placeOrder(OrderRequest $request) {
        if(Session::has('cart')){
            $order = Order::create([
                'user_id' => Auth::id(),
                'address' => $request->address,
            ]);
    
            foreach(session('cart') as $id => $details) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'status' => "pending",
    
                ]);
            }
            
                    Session::forget('cart');
                    return redirect('home')->with('success', 'Order placed sucessfully!');

        } else {
            return redirect()->back()->with('notice', 'Your cart is empty!');
        }

    }
}
