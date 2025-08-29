<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
    </x-slot>

    <div class="p-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

        {{-- Summary cards --}}
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

    {{-- Charts --}}
    <div class="mt-6 bg-white p-4 shadow rounded">
        <h3 class="font-bold text-gray-700 mb-4">Orders & Revenue (Last 30 Days)</h3>
        <canvas id="ordersRevenueChart" class="w-full h-64"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('ordersRevenueChart').getContext('2d');

        const labels = @json($ordersTrend->pluck('date'));
        const ordersData = @json($ordersTrend->pluck('total'));
        const revenueData = @json($revenueTrend->pluck('total'));

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Orders',
                        data: ordersData,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        yAxisID: 'y-orders',
                        tension: 0.3
                    },
                    {
                        label: 'Revenue',
                        data: revenueData,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        yAxisID: 'y-revenue',
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: { mode: 'index', intersect: false },
                scales: {
                    'y-orders': {
                        type: 'linear',
                        position: 'left',
                        beginAtZero: true,
                        title: { display: true, text: 'Orders' }
                    },
                    'y-revenue': {
                        type: 'linear',
                        position: 'right',
                        beginAtZero: true,
                        title: { display: true, text: 'Revenue ($)' },
                        grid: { drawOnChartArea: false }
                    }
                }
            }
        });
    </script>
</x-app-layout>
