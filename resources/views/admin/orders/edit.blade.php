<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Order #{{ $order->id }}</h2>
</x-slot>

<div class="p-4 space-y-4">

    <form action="{{ route('orders.update', $order) }}" method="POST" class="bg-white p-4 shadow rounded space-y-4">
        @csrf
        @method('PATCH')

        <div>
            <label for="status" class="block font-bold text-gray-700">Status</label>
            <select name="status" id="status" class="border rounded px-2 py-1 w-full">
                <option value="pending" {{ $order->status=='pending'?'selected':'' }}>Pending</option>
                <option value="completed" {{ $order->status=='completed'?'selected':'' }}>Completed</option>
                <option value="cancelled" {{ $order->status=='cancelled'?'selected':'' }}>Cancelled</option>
            </select>
            @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="total" class="block font-bold text-gray-700">Total</label>
            <input type="number" name="total" id="total" value="{{ old('total',$order->total) }}" step="0.01" class="border rounded px-2 py-1 w-full">
            @error('total') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="space-x-2">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Update</button>
            <a href="{{ route('orders.show', $order) }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
        </div>
    </form>

</div>
</x-app-layout>
