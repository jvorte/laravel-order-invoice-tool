<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
        public function index() {
        $orders = Order::with('customer')->latest()->get();
        return view('admin.orders', compact('orders'));
    }
    
    public function demo() {
        return Order::with('customer')->take(5)->get();
    }
}
