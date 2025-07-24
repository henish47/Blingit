@extends('admin.layout')

@section('title', 'Orders Management')

@section('content')

<div>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800">Orders Management</h1>
            <p class="text-gray-500 mt-1">View, track, and manage all customer orders.</p>
        </div>
        
    </div>

    <!-- Filters -->
    <div class="mb-6 flex flex-col sm:flex-row gap-4">
        <div class="relative flex-grow">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </span>
            <input type="text" placeholder="Search by customer or order ID..." class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        <select class="w-full sm:w-auto px-4 py-2.5 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            <option>Filter by Status</option>
            <option>Completed</option>
            <option>Pending</option>
            <option>Cancelled</option>
        </select>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
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
                        <td class="py-4 px-6 font-mono text-gray-700">#1001</td>
                        <td class="py-4 px-6 font-medium text-gray-800">John Doe</td>
                        <td class="py-4 px-6 text-gray-600">July 1, 2025</td>
                        <td class="py-4 px-6 font-semibold text-gray-800">₹450.00</td>
                        <td class="py-4 px-6"><span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Completed</span></td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <button class="text-green-600 hover:text-green-800 font-semibold text-xs">Completed</button>
                                <button class="text-yellow-600 hover:text-yellow-800 font-semibold text-xs">Pending</button>
                                <button class="text-orange-600 hover:text-orange-800 font-semibold text-xs">Cancelled</button>
                                <button class="text-red-600 hover:text-red-800 font-semibold text-xs">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-mono text-gray-700">#1002</td>
                        <td class="py-4 px-6 font-medium text-gray-800">Jane Smith</td>
                        <td class="py-4 px-6 text-gray-600">July 2, 2025</td>
                        <td class="py-4 px-6 font-semibold text-gray-800">₹320.00</td>
                        <td class="py-4 px-6"><span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">Pending</span></td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <button class="text-green-600 hover:text-green-800 font-semibold text-xs">Completed</button>
                                <button class="text-yellow-600 hover:text-yellow-800 font-semibold text-xs">Pending</button>
                                <button class="text-orange-600 hover:text-orange-800 font-semibold text-xs">Cancelled</button>
                                <button class="text-red-600 hover:text-red-800 font-semibold text-xs">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-mono text-gray-700">#1003</td>
                        <td class="py-4 px-6 font-medium text-gray-800">Amit Kumar</td>
                        <td class="py-4 px-6 text-gray-600">July 3, 2025</td>
                        <td class="py-4 px-6 font-semibold text-gray-800">₹210.00</td>
                        <td class="py-4 px-6"><span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Completed</span></td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <button class="text-green-600 hover:text-green-800 font-semibold text-xs">Completed</button>
                                <button class="text-yellow-600 hover:text-yellow-800 font-semibold text-xs">Pending</button>
                                <button class="text-orange-600 hover:text-orange-800 font-semibold text-xs">Cancelled</button>
                                <button class="text-red-600 hover:text-red-800 font-semibold text-xs">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-mono text-gray-700">#1004</td>
                        <td class="py-4 px-6 font-medium text-gray-800">Priya Verma</td>
                        <td class="py-4 px-6 text-gray-600">July 3, 2025</td>
                        <td class="py-4 px-6 font-semibold text-gray-800">₹580.00</td>
                        <td class="py-4 px-6"><span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Completed</span></td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <button class="text-green-600 hover:text-green-800 font-semibold text-xs">Completed</button>
                                <button class="text-yellow-600 hover:text-yellow-800 font-semibold text-xs">Pending</button>
                                <button class="text-orange-600 hover:text-orange-800 font-semibold text-xs">Cancelled</button>
                                <button class="text-red-600 hover:text-red-800 font-semibold text-xs">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-mono text-gray-700">#1005</td>
                        <td class="py-4 px-6 font-medium text-gray-800">Rahul Singh</td>
                        <td class="py-4 px-6 text-gray-600">July 4, 2025</td>
                        <td class="py-4 px-6 font-semibold text-gray-800">₹150.00</td>
                        <td class="py-4 px-6"><span class="bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full">Cancelled</span></td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <button class="text-green-600 hover:text-green-800 font-semibold text-xs">Completed</button>
                                <button class="text-yellow-600 hover:text-yellow-800 font-semibold text-xs">Pending</button>
                                <button class="text-orange-600 hover:text-orange-800 font-semibold text-xs">Cancelled</button>
                                <button class="text-red-600 hover:text-red-800 font-semibold text-xs">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
