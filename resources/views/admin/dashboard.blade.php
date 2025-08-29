<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Admin Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Dashboard KPIs --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-8">

                    {{-- Total Orders Card --}}
                    <div class="bg-gray-100 p-6 rounded-xl shadow-lg transform transition duration-300 hover:scale-105">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-sm font-medium text-gray-600">Total Orders</h3>
                            <svg class="h-6 w-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2m-3 4l-4 4m0 0l4 4m-4-4h11"></path></svg>
                        </div>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalOrders }}</p>
                    </div>

                    {{-- Pending Orders Card --}}
                    <div class="bg-yellow-100 p-6 rounded-xl shadow-lg transform transition duration-300 hover:scale-105">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-sm font-medium text-gray-600">Pending</h3>
                            <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-3xl font-bold text-yellow-700">{{ $pendingOrders }}</p>
                    </div>

                    {{-- Completed Orders Card --}}
                    <div class="bg-green-100 p-6 rounded-xl shadow-lg transform transition duration-300 hover:scale-105">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-sm font-medium text-gray-600">Completed</h3>
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-3xl font-bold text-green-700">{{ $completedOrders }}</p>
                    </div>

                    {{-- Cancelled Orders Card --}}
                    <div class="bg-red-100 p-6 rounded-xl shadow-lg transform transition duration-300 hover:scale-105">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-sm font-medium text-gray-600">Cancelled</h3>
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-3xl font-bold text-red-700">{{ $cancelledOrders }}</p>
                    </div>

                    {{-- Total Invoices Card --}}
                    <div class="bg-gray-100 p-6 rounded-xl shadow-lg transform transition duration-300 hover:scale-105">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-sm font-medium text-gray-600">Total Invoices</h3>
                            <svg class="h-6 w-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </div>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalInvoices }}</p>
                    </div>

                </div>

                {{-- Total Revenue Card (as a separate, larger card) --}}
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-8 rounded-xl shadow-lg mb-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-medium opacity-90">Total Revenue</h3>
                            <p class="text-5xl font-extrabold mt-1">${{ number_format($totalRevenue, 2) }}</p>
                        </div>
                        <svg class="h-16 w-16 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9v2m0 4v2m-4-6v2m0 4v2M7 9v2m0 4v2M3 13h18M3 17h18M3 21h18"></path></svg>
                    </div>
                </div>

                {{-- Chart Section --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    
                    <div class="bg-white p-6 shadow-md rounded-lg">
                        <h3 class="font-bold text-lg text-gray-800 mb-4">Orders by Status</h3>
                        <canvas id="ordersStatusChart" class="w-full h-80"></canvas>
                    </div>
                    
                    <div class="bg-white p-6 shadow-md rounded-lg">
                        <h3 class="font-bold text-lg text-gray-800 mb-4">Monthly Revenue (Last 12 months)</h3>
                        <canvas id="monthlyRevenueChart" class="w-full h-80"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script>
        // Use more vibrant colors
        const colors = {
            indigo: 'rgba(99, 102, 241, 1)',
            green: 'rgba(34, 197, 94, 1)',
            yellow: 'rgba(250, 204, 21, 1)',
            red: 'rgba(239, 68, 68, 1)',
            gray: 'rgba(156, 163, 175, 1)'
        };

        // Orders by Status Doughnut Chart
        const statusData = @json($ordersByStatus);
        const statusOrder = ['completed', 'pending', 'cancelled'];
        const statusLabels = statusOrder.map(s => s.charAt(0).toUpperCase() + s.slice(1));
        const statusCounts = statusOrder.map(s => statusData[s] ?? 0);
        const statusColors = [colors.green, colors.yellow, colors.red];

        new Chart(document.getElementById('ordersStatusChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: statusLabels,
                datasets: [{
                    data: statusCounts,
                    backgroundColor: statusColors,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            usePointStyle: true,
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    label += context.parsed;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Monthly Revenue Line Chart
        const monthLabels = @json($monthLabels);
        const monthlyRevenue = @json($monthlyRevenue);

        new Chart(document.getElementById('monthlyRevenueChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Revenue',
                    data: monthlyRevenue,
                    borderColor: colors.indigo,
                    backgroundColor: 'rgba(99, 102, 241, 0.2)', // Light fill color
                    borderWidth: 3,
                    tension: 0.3, // Adds a slight curve to the line
                    fill: true
                }]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            callback: function(value, index, values) {
                                return '$' + value;
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>