<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoices') }}
        </h2>
    </x-slot>

    <div class="p-4">
        <table class="min-w-full bg-white shadow rounded">
            <thead>
                <tr>
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Order ID</th>
                    <th class="p-2 border">Customer</th>
                    <th class="p-2 border">File Path</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                <tr>
                    <td class="p-2 border">{{ $invoice->id }}</td>
                    <td class="p-2 border">{{ $invoice->order_id }}</td>
                    <td class="p-2 border">{{ $invoice->order->customer->name }}</td>
                    <td class="p-2 border">{{ $invoice->file_path }}</td>
                    <td class="p-2 border">
                        <a href="{{ asset($invoice->file_path) }}" class="text-blue-500" target="_blank">Download</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $invoices->links() }}
        </div>
    </div>
</x-app-layout>
