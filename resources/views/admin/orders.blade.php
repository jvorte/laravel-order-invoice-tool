<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Orders</h2>
</x-slot>

<div class="p-4">
    <!-- Filters -->
    <form method="GET" class="mb-4 flex space-x-2">
 <select name="status" class="border rounded px-2 py-1">
    <option value="">All Status</option>
    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
</select>


        <input type="text" name="customer_id" placeholder="Customer ID" value="{{ request('customer_id') }}" class="border rounded px-2 py-1">
        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Filter</button>
    </form>

    <table class="min-w-full bg-white shadow rounded">
        <thead>
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Customer</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Total</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td class="p-2 border">{{ $order->id }}</td>
                <td class="p-2 border">{{ $order->customer->name }}</td>
                <td class="p-2 border capitalize">{{ $order->status }}</td>
                <td class="p-2 border">${{ $order->total }}</td>
                <td class="p-2 border space-x-2">
                    <!-- View -->
                    <a href="{{ route('orders.show', $order) }}" class="text-blue-500">View</a>

                    <!-- Edit -->
                    <a href="{{ route('orders.edit', $order) }}" class="text-green-500">Edit</a>

                    <!-- Delete -->
                    <form action="{{ route('orders.destroy', $order) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="text-red-500">Delete</button>
                    </form>

                    <!-- Change Status Dropdown -->
 <form action="{{ route('orders.update', $order) }}" method="POST" class="inline">
    @csrf
    @method('PATCH')
    
    <select name="status" onchange="this.form.submit()" 
        class="border rounded px-2 py-1 font-semibold
            @if($order->status == 'pending') bg-yellow-100 text-yellow-800 border-yellow-300 
            @elseif($order->status == 'completed') bg-green-100 text-green-800 border-green-300 
            @elseif($order->status == 'canceled') bg-red-100 text-red-800 border-red-300 
            @endif">
        
        <option value="pending" {{ $order->status=='pending'?'selected':'' }}>Pending</option>
        <option value="completed" {{ $order->status=='completed'?'selected':'' }}>Completed</option>
        <option value="canceled" {{ $order->status=='canceled'?'selected':'' }}>Canceled</option>
    </select>
</form>


                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
</x-app-layout>
