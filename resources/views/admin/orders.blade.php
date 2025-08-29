<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Order Management</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- Filters and Search --}}
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6 p-4 bg-gray-50 rounded-lg shadow-inner">
                    <form method="GET" action="{{ route('orders.index') }}" class="w-full flex flex-col sm:flex-row items-center gap-4">
                        <div class="w-full sm:w-1/3">
                            <label for="status" class="sr-only">Filter by Status</label>
                            <select name="status" id="status" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">All Statuses</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <div class="w-full sm:w-1/3">
                            <label for="customer_id" class="sr-only">Search by Customer ID</label>
                            <input type="text" name="customer_id" id="customer_id" placeholder="Search by Customer ID" value="{{ request('customer_id') }}" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        </div>

                        <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-indigo-600 text-white rounded-md shadow-md hover:bg-indigo-700 transition duration-150">
                            Filter
                        </button>
                    </form>
                </div>

                {{-- Orders Table --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow-md">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($orders as $order)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">{{ $order->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $order->customer->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-medium">${{ number_format($order->total, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @php
                                            $statusClass = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'completed' => 'bg-green-100 text-green-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                            ][$order->status] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }} capitalize">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        {{-- View --}}
                                        <a href="{{ route('orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-900">
                                            <i class="fas fa-eye"></i>
                                            <span class="sr-only">View</span>
                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ route('orders.edit', $order) }}" class="text-green-600 hover:text-green-900">
                                            <i class="fas fa-edit"></i>
                                            <span class="sr-only">Edit</span>
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('orders.destroy', $order) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this order?')" class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash-alt"></i>
                                                <span class="sr-only">Delete</span>
                                            </button>
                                        </form>

                                        {{-- Change Status Dropdown --}}
                                        <form action="{{ route('orders.update', $order) }}" method="POST" class="inline-block ml-4">
                                            @csrf
                                            @method('PATCH')
                                            <label for="status-{{ $order->id }}" class="sr-only">Change Status</label>
                                            <select name="status" id="status-{{ $order->id }}" onchange="this.form.submit()" class="text-xs border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                                @foreach(['pending' => 'Pending', 'completed' => 'Completed', 'cancelled' => 'Cancelled'] as $value => $label)
                                                    <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links --}}
                <div class="mt-6">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
/* Basic Font Awesome icons */
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
</style>