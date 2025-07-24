@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')

    <!-- Chart.js CDN for interactive charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div>
        <!-- Header -->
        <!-- <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-800">Welcome back, Admin!</h1>
            <p class="text-gray-500 mt-1">Here's a snapshot of your store's performance today.</p>
        </div> -->

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Revenue Card -->
            <div
                class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200 flex items-center gap-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="bg-green-100 p-4 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01M12 6v-1m0-1V4m0 2.01v.01M12 18v-1m0-1v-1m0-1v-1m0-1v-1m0-1v-1m0 0V9.01M12 4.01V3">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Revenue</p>
                    <p class="text-3xl font-extrabold text-gray-800">₹12,500</p>
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
                    <p class="text-3xl font-extrabold text-gray-800">34</p>
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
                    <p class="text-3xl font-extrabold text-gray-800">56</p>
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
                    <p class="text-3xl font-extrabold text-gray-800">3</p>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <!-- <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8"> -->
        <!-- Sales Overview Chart -->
        <!-- <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Sales Overview</h2>
                <div class="h-80">
                    <canvas id="salesChart"></canvas>
                </div>
            </div> -->
        <!-- Order Status Chart -->
        <!-- <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 flex flex-col">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Order Status</h2>
                <div class="flex-grow flex items-center justify-center relative h-80">
                     <canvas id="orderStatusChart"></canvas>
                </div>
            </div>
        </div> -->

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
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6 font-mono text-gray-700">#1005</td>
                            <td class="py-4 px-6 font-medium text-gray-800">Rahul Singh</td>
                            <td class="py-4 px-6 text-gray-600">July 18, 2025</td>
                            <td class="py-4 px-6 font-semibold text-gray-800">₹150.00</td>
                            <td class="py-4 px-6"><span
                                    class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">Cancelled</span>
                            </td>
                            <td class="py-4 px-6"><a href="#" class="text-green-600 hover:underline font-semibold">View</a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6 font-mono text-gray-700">#1004</td>
                            <td class="py-4 px-6 font-medium text-gray-800">Priya Verma</td>
                            <td class="py-4 px-6 text-gray-600">July 17, 2025</td>
                            <td class="py-4 px-6 font-semibold text-gray-800">₹580.00</td>
                            <td class="py-4 px-6"><span
                                    class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Completed</span>
                            </td>
                            <td class="py-4 px-6"><a href="#" class="text-green-600 hover:underline font-semibold">View</a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6 font-mono text-gray-700">#1003</td>
                            <td class="py-4 px-6 font-medium text-gray-800">Amit Kumar</td>
                            <td class="py-4 px-6 text-gray-600">July 17, 2025</td>
                            <td class="py-4 px-6 font-semibold text-gray-800">₹210.00</td>
                            <td class="py-4 px-6"><span
                                    class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Completed</span>
                            </td>
                            <td class="py-4 px-6"><a href="#" class="text-green-600 hover:underline font-semibold">View</a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6 font-mono text-gray-700">#1002</td>
                            <td class="py-4 px-6 font-medium text-gray-800">Jane Smith</td>
                            <td class="py-4 px-6 text-gray-600">July 16, 2025</td>
                            <td class="py-4 px-6 font-semibold text-gray-800">₹320.00</td>
                            <td class="py-4 px-6"><span
                                    class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">Pending</span>
                            </td>
                            <td class="py-4 px-6"><a href="#" class="text-green-600 hover:underline font-semibold">View</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Common Chart Font Styling
            Chart.defaults.font.family = 'Poppins, sans-serif';
            Chart.defaults.font.weight = '500';

            // Sales Chart
            const salesCtx = document.getElementById('salesChart').getContext('2d');
            const salesGradient = salesCtx.createLinearGradient(0, 0, 0, 300);
            salesGradient.addColorStop(0, 'rgba(34, 197, 94, 0.6)');
            salesGradient.addColorStop(1, 'rgba(34, 197, 94, 0)');

            new Chart(salesCtx, {
                type: 'line', // Changed to line chart for a better look
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                        label: 'Revenue (₹)',
                        data: [6500, 5900, 8000, 8100, 5600, 5500, 12500],
                        backgroundColor: salesGradient,
                        borderColor: '#16a34a',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4, // Makes the line curved
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
                        y: {
                            beginAtZero: true,
                            grid: { color: '#e5e7eb' },
                            ticks: {
                                callback: function (value) { return '₹' + value / 1000 + 'k'; }
                            }
                        },
                        x: { grid: { display: false } }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1f2937',
                            titleFont: { size: 16 },
                            bodyFont: { size: 14 },
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function (context) {
                                    return `Revenue: ₹${context.raw.toLocaleString()}`;
                                }
                            }
                        }
                    }
                }
            });

            // Order Status Chart
            const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
            const orderData = [29, 3, 2];
            const totalOrders = orderData.reduce((a, b) => a + b, 0);

            new Chart(orderStatusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Completed', 'Pending', 'Cancelled'],
                    datasets: [{
                        data: orderData,
                        backgroundColor: ['#10B981', '#F59E0B', '#EF4444'],
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
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                boxWidth: 12,
                                font: { size: 14, weight: '500' }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#1f2937',
                            titleFont: { size: 14 },
                            bodyFont: { size: 12 },
                            padding: 10,
                            cornerRadius: 8,
                            displayColors: true,
                        },
                        // Custom plugin to draw text in the center
                        centerText: {
                            display: true,
                            text: totalOrders,
                            subtext: 'Total Orders'
                        }
                    }
                },
                plugins: [{
                    id: 'centerText',
                    beforeDraw: function (chart) {
                        if (chart.options.plugins.centerText.display) {
                            const ctx = chart.ctx;
                            const H = chart.height;
                            const W = chart.width;
                            ctx.restore();

                            const text = chart.options.plugins.centerText.text;
                            const subtext = chart.options.plugins.centerText.subtext;

                            ctx.font = "bold 32px Poppins, sans-serif";
                            ctx.fillStyle = "#1f2937";
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'middle';
                            const textX = W / 2;
                            const textY = H / 2 - 10;
                            ctx.fillText(text, textX, textY);

                            ctx.font = "500 14px Poppins, sans-serif";
                            ctx.fillStyle = "#6b7280";
                            ctx.fillText(subtext, textX, textY + 25);

                            ctx.save();
                        }
                    }
                }]
            });
        });
    </script> -->
@endsection