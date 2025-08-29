<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
</x-slot>

<div class="p-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

    <div class="bg-white p-4 shadow rounded">
        <h3 class="font-bold text-gray-700">Total Orders</h3>
        <p class="text-2xl font-semibold text-gray-900">{{ $totalOrders }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <h3 class="font-bold text-gray-700">Pending Orders</h3>
        <p class="text-2xl font-semibold text-yellow-600">{{ $pendingOrders }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <h3 class="font-bold text-gray-700">Completed Orders</h3>
        <p class="text-2xl font-semibold text-green-600">{{ $completedOrders }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <h3 class="font-bold text-gray-700">Total Invoices</h3>
        <p class="text-2xl font-semibold text-gray-900">{{ $totalInvoices }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded col-span-1 sm:col-span-2 lg:col-span-3">
        <h3 class="font-bold text-gray-700">Total Revenue</h3>
        <p class="text-2xl font-semibold text-blue-600">${{ number_format($totalRevenue,2) }}</p>
    </div>

</div>
</x-app-layout>
