@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')

    <!-- Chart.js CDN for interactive charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div>
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Revenue Card -->
            <div
                class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200 flex items-center gap-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="bg-green-100 p-4 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01M12 6v-1m0-1V4m0 2.01v.01M12 18v-1m0-1v-1m0-1v-1m0-1v-1m0 0V9.01M12 4.01V3">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Revenue</p>
                    <p class="text-3xl font-extrabold text-gray-800">₹{{ number_format($totalRevenue, 2) }}</p>
                </div>
            </div>
            <!-- Total Orders Card -->
            <div
                class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200 flex items-center gap-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="bg-yellow-100 p-4 rounded-full">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Orders</p>
                    <p class="text-3xl font-extrabold text-gray-800">{{ $totalOrders }}</p>
                </div>
            </div>
            <!-- Total Customers Card -->
            <div
                class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200 flex items-center gap-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="bg-blue-100 p-4 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197M15 21a6 6 0 006-6v-1a3 3 0 00-3-3H9a3 3 0 00-3 3v1a6 6 0 006 6z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Customers</p>
                    <p class="text-3xl font-extrabold text-gray-800">{{ $totalCustomers }}</p>
                </div>
            </div>
            <!-- Pending Orders Card -->
            <div
                class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200 flex items-center gap-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="bg-orange-100 p-4 rounded-full">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Pending Orders</p>
                    <p class="text-3xl font-extrabold text-gray-800">{{ $pendingOrders }}</p>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8"> 
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Sales Overview (Last 7 Days)</h2>
                <div class="h-80">
                    <canvas id="salesChart"></canvas>
                </div>
            </div> 
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 flex flex-col">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Order Status</h2>
                <div class="flex-grow flex items-center justify-center relative h-80">
                   <canvas id="orderStatusChart"></canvas>
                </div>
            </div>
        </div> 

        <!-- Recent Orders Table -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Recent Orders</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-6 text-left font-semibold text-gray-600">Order #</th>
                            <th class="py-3 px-6 text-left font-semibold text-gray-600">Customer</th>
                            <th class="py-3 px-6 text-left font-semibold text-gray-600">Date</th>
                            <th class="py-3 px-6 text-left font-semibold text-gray-600">Total</th>
                            <th class="py-3 px-6 text-left font-semibold text-gray-600">Status</th>
                            <th class="py-3 px-6 text-left font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($recentOrders as $order)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6 font-mono text-gray-700">#{{ $order->id }}</td>
                            <td class="py-4 px-6 font-medium text-gray-800">{{ $order->user->name ?? 'N/A' }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="py-4 px-6 font-semibold text-gray-800">₹{{ number_format($order->total, 2) }}</td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 rounded-full text-xs font-bold @switch($order->status) @case('Completed') bg-green-100 text-green-700 @break @case('Pending') bg-yellow-100 text-yellow-700 @break @case('Cancelled') bg-red-100 text-red-700 @break @default bg-gray-100 text-gray-700 @endswitch">{{ $order->status }}</span>
                            </td>
                            <td class="py-4 px-6"><a href="{{ route('admin.orders.index', ['search' => $order->id]) }}" class="text-green-600 hover:underline font-semibold">View</a></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-10 text-gray-500">No recent orders found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

   <script>
        document.addEventListener('DOMContentLoaded', function () {
            Chart.defaults.font.family = 'Poppins, sans-serif';
            Chart.defaults.font.weight = '500';

            // Sales Chart
            const salesCtx = document.getElementById('salesChart').getContext('2d');
            const salesGradient = salesCtx.createLinearGradient(0, 0, 0, 300);
            salesGradient.addColorStop(0, 'rgba(34, 197, 94, 0.6)');
            salesGradient.addColorStop(1, 'rgba(34, 197, 94, 0)');

            new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: @json($salesChartLabels),
                    datasets: [{
                        label: 'Revenue (₹)',
                        data: @json($salesChartData),
                        backgroundColor: salesGradient,
                        borderColor: '#16a34a',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#16a34a',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { beginAtZero: true, grid: { color: '#e5e7eb' }, ticks: { callback: value => '₹' + value.toLocaleString() } },
                        x: { grid: { display: false } }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1f2937',
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: context => `Revenue: ₹${context.raw.toLocaleString()}`
                            }
                        }
                    }
                }
            });

            // Order Status Chart
            const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
            const orderLabels = @json($orderStatusChartLabels);
            const orderData = @json($orderStatusChartData);
            const totalOrders = orderData.reduce((a, b) => a + b, 0);
            
            const backgroundColors = orderLabels.map(label => {
                switch(label) {
                    case 'Completed': return '#10B981';
                    case 'Pending': return '#F59E0B';
                    case 'Cancelled': return '#EF4444';
                    case 'Processing': return '#8B5CF6';
                    case 'Shipped': return '#3B82F6';
                    default: return '#6B7280';
                }
            });

            new Chart(orderStatusCtx, {
                type: 'doughnut',
                data: {
                    labels: orderLabels,
                    datasets: [{
                        data: orderData,
                        backgroundColor: backgroundColors,
                        borderColor: '#ffffff',
                        borderWidth: 4,
                        hoverOffset: 12,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: { position: 'bottom', labels: { padding: 20, boxWidth: 12, font: { size: 14 } } },
                        tooltip: { backgroundColor: '#1f2937', padding: 10, cornerRadius: 8 },
                        centerText: { display: true, text: totalOrders, subtext: 'Total Orders' }
                    }
                },
                plugins: [{
                    id: 'centerText',
                    beforeDraw: function (chart) {
                        if (chart.options.plugins.centerText.display) {
                            const ctx = chart.ctx;
                            const { width, height } = chart;
                            ctx.restore();
                            const text = chart.options.plugins.centerText.text;
                            const subtext = chart.options.plugins.centerText.subtext;
                            ctx.font = "bold 32px Poppins, sans-serif";
                            ctx.fillStyle = "#1f2937";
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'middle';
                            ctx.fillText(text, width / 2, height / 2 - 10);
                            ctx.font = "500 14px Poppins, sans-serif";
                            ctx.fillStyle = "#6b7280";
                            ctx.fillText(subtext, width / 2, height / 2 + 25);
                            ctx.save();
                        }
                    }
                }]
            });
        });
    </script> 
@endsection

