<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
public function index(Request $request)
{
    $query = Order::query();

    if ($request->status) {
        $query->where('status', $request->status); // εδώ παίρνει το request('status')
    }

    if ($request->customer_id) {
        $query->where('customer_id', $request->customer_id);
    }

    $orders = $query->latest()->paginate(10);

    return view('orders.index', compact('orders'));
}

    
    public function demo() {
        return Order::with('customer')->take(5)->get();
    }


public function update(Request $request, Order $order)
{
    // Debugging: δες τι έρχεται
   dd($request->all());

    $request->validate([
        'status' => 'required|in:pending,completed,cancelled',
        'total' => 'required|numeric|min:0'
    ]);

    $order->status = $request->status;
    $order->total = $request->total;
    $order->save(); // save() αντί για mass-assignment για debugging

    return redirect()->route('orders.show', $order)->with('success', 'Order updated successfully.');
}



}
