<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
    </x-slot>

    <div class="p-4 space-y-6">
        {{-- KPI Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-white p-4 shadow rounded">
                <h3 class="font-bold text-gray-700">Total Orders</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $totalOrders }}</p>
            </div>
            <div class="bg-white p-4 shadow rounded">
                <h3 class="font-bold text-gray-700">Pending</h3>
                <p class="text-2xl font-semibold text-yellow-600">{{ $pendingOrders }}</p>
            </div>
            <div class="bg-white p-4 shadow rounded">
                <h3 class="font-bold text-gray-700">Completed</h3>
                <p class="text-2xl font-semibold text-green-600">{{ $completedOrders }}</p>
            </div>
            <div class="bg-white p-4 shadow rounded">
                <h3 class="font-bold text-gray-700">Total Invoices</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $totalInvoices }}</p>
            </div>
            <div class="bg-white p-4 shadow rounded col-span-1 sm:col-span-2 lg:col-span-3">
                <h3 class="font-bold text-gray-700">Total Revenue</h3>
                <p class="text-2xl font-semibold text-blue-600">${{ number_format($totalRevenue, 2) }}</p>
            </div>
        </div>

        {{-- Charts --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white p-4 shadow rounded">
                <h3 class="font-bold text-gray-700 mb-4">Orders by Status</h3>
                <canvas id="ordersStatusChart" class="w-full h-64"></canvas>
            </div>
            <div class="bg-white p-4 shadow rounded">
                <h3 class="font-bold text-gray-700 mb-4">Monthly Revenue (Last 12 months)</h3>
                <canvas id="monthlyRevenueChart" class="w-full h-64"></canvas>
            </div>
        </div>
    </div>

    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // ---- Pie/Doughnut: Orders by Status ----
        const statusData = @json($ordersByStatus);
        const statusOrder = ['pending', 'completed', 'cancelled']; // κράτα ίδια ονόματα με DB
        const statusLabels = statusOrder.map(s => s.charAt(0).toUpperCase() + s.slice(1));
        const statusCounts = statusOrder.map(s => statusData[s] ?? 0);

        new Chart(document.getElementById('ordersStatusChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: statusLabels,
                datasets: [{
                    data: statusCounts
                }]
            }
        });

        // ---- Line: Monthly Revenue ----
        const monthLabels = @json($monthLabels);
        const monthRevenue = @json($monthlyRevenue);

        new Chart(document.getElementById('monthlyRevenueChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Revenue',
                    data: monthRevenue,
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                interaction: { mode: 'index', intersect: false },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</x-app-layout>
