<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
public function dashboard() {
    $totalOrders = Order::count();
    $pendingOrders = Order::where('status','pending')->count();
    $completedOrders = Order::where('status','completed')->count();
    $totalInvoices = Invoice::count();
    $totalRevenue = Order::where('status','completed')->sum('total');

    // Trends for last 30 days
    $ordersTrend = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as total')
        )
        ->where('created_at','>=',now()->subDays(30))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $revenueTrend = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('sum(total) as total')
        )
        ->where('status','completed')
        ->where('created_at','>=',now()->subDays(30))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    return view('admin.dashboard', compact(
        'totalOrders','pendingOrders','completedOrders','totalInvoices','totalRevenue',
        'ordersTrend','revenueTrend'
    ));
}



public function orders(Request $request) {
    $query = Order::with('customer')->latest();

    // Filters
    if ($request->status) {
        $query->where('status', $request->status);
    }

    if ($request->customer_id) {
        $query->where('customer_id', $request->customer_id);
    }

    $orders = $query->paginate(10); // pagination

    return view('admin.orders', compact('orders'));
}

public function show(Order $order) {
    return view('admin.orders.show', compact('order'));
}

public function edit(Order $order) {
    return view('admin.orders.edit', compact('order'));
}

public function update(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:pending,completed,cancelled',
        'total' => 'nullable|numeric|min:0',
    ]);

    $order->update($request->only('status','total'));

    return redirect()->back()->with('success','Order updated!');
}


public function destroy(Order $order) {
    $order->delete();
    return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
}


public function invoices(Request $request) {
    $query = Invoice::with('order.customer')->latest();

    // Search by invoice ID, order ID, customer name/email
    if ($request->search) {
        $query->where('id', $request->search)
              ->orWhereHas('order', function($q) use($request) {
                  $q->where('id', $request->search)
                    ->orWhereHas('customer', function($q2) use($request) {
                        $q2->where('name','like','%'.$request->search.'%')
                           ->orWhere('email','like','%'.$request->search.'%');
                    });
              });
    }

    // Date range filter
    if ($request->from_date && $request->to_date) {
        $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
    }

    $invoices = $query->paginate(10)->withQueryString();

    return view('admin.invoices', compact('invoices'));
}

public function showInvoice(Invoice $invoice) {
    return view('admin.invoice-show', compact('invoice'));
}

public function downloadInvoice(Invoice $invoice) {
    $filePath = storage_path('app/invoices/' . $invoice->file_name);
    return response()->download($filePath);
}


}
