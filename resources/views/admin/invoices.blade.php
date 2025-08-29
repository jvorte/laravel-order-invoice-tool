<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Invoices') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- Search and Filter Bar --}}
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6 p-4 bg-gray-50 rounded-lg shadow-inner">
                    <form method="GET" action="{{ route('invoices.index') }}" class="w-full flex flex-col sm:flex-row items-center gap-4">
                        <div class="w-full sm:w-1/2">
                            <label for="order_id" class="sr-only">Search by Order ID</label>
                            <input type="text" name="order_id" id="order_id" placeholder="Search by Order ID" value="{{ request('order_id') }}" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        </div>

                        <div class="w-full sm:w-1/2">
                            <label for="customer" class="sr-only">Search by Customer</label>
                            <input type="text" name="customer" id="customer" placeholder="Search by Customer Name" value="{{ request('customer') }}" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        </div>

                        <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-indigo-600 text-white rounded-md shadow-md hover:bg-indigo-700 transition duration-150">
                            Search
                        </button>
                    </form>
                </div>
                
                {{-- Invoices Table --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow-md">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($invoices as $invoice)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">{{ $invoice->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600 font-medium">{{ $invoice->order_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $invoice->order->customer->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ asset($invoice->file_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 transition duration-150">
                                            <i class="fas fa-download mr-1"></i> Download
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links --}}
                <div class="mt-6">
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
/* Basic Font Awesome icons */
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
</style>