<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Category;
use App\Order;
use App\OrderProduct;
use App\User;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    function manageOrders() {
        $orders = Order::get();

        return view('admin.manage', compact('orders'));
    }
    
    function approve($id) {
        $order = Order::find($id)->update([
            'status' => 'Approved'
        ]);
        
        return redirect('manage_orders');
    }
    
    function deliver($id) {
        $order = Order::find($id)->update([
            'status' => 'Delivered'
        ]);
        
        return redirect('manage_orders');
    }
    
    function cancel($id) {
        $order = Order::find($id)->update([
            'status' => 'Cancelled'
        ]);
        
        return redirect('manage_orders');
    }
    
    function myOrders() {
        $user_id = Auth::id();
        
        $user = User::find($user_id);
        
        $orders = $user->orders;

        
        return view('order.my_order', compact('orders'));
        

    }

    function viewOrder($id) {

        $order = Order::find($id);
        $user = $order->user;
        $products = $order->products;

        return view('admin.order', compact('order','user','products'));
    }

}
