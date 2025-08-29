<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Order #{{ $order->id }}</h2>
</x-slot>

<div class="p-4 space-y-4">

    <!-- Order Info -->
    <div class="bg-white p-4 shadow rounded space-y-2">
        <h3 class="font-bold text-gray-700">Customer Info</h3>
        <p><strong>Name:</strong> {{ $order->customer->name }}</p>
        <p><strong>Email:</strong> {{ $order->customer->email }}</p>
        <p><strong>Phone:</strong> {{ $order->customer->phone }}</p>
        <p><strong>Address:</strong> {{ $order->customer->address }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded space-y-2">
        <h3 class="font-bold text-gray-700">Order Details</h3>
        <p><strong>Status:</strong> <span class="capitalize">{{ $order->status }}</span></p>
        <p><strong>Total:</strong> ${{ number_format($order->total,2) }}</p>
        <p><strong>Created At:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
        <p><strong>Updated At:</strong> {{ $order->updated_at->format('Y-m-d H:i') }}</p>
    </div>

    <div class="space-x-2">
        <a href="{{ route('orders.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
        <a href="{{ route('orders.edit', $order) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</a>
    </div>

</div>
</x-app-layout>
