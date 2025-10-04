@extends('admin.layout')

@section('title', 'Orders Management')

@section('content')

<style>
    /* Custom styles for expandable rows and smooth transitions */
    .order-details-row {
        display: none; /* Pahelathi j details ne chupavi do */
    }
    .order-details-row.expanded {
        display: table-row; /* Click par 'expanded' class add thashe */
    }
    .expand-btn i {
        transition: transform 0.3s ease;
    }
    .expand-btn.expanded i {
        transform: rotate(180deg); /* Icon ne gol feravva mate */
    }
    /* Click karva mate fakt button par j cursor aave, aakhi row par nahi */
    tr[data-order-id] {
        cursor: default;
    }
    .expand-btn {
        cursor: pointer;
    }
</style>

<div>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800">Orders Management</h1>
            <p class="text-gray-500 mt-1">View, track, and manage all customer orders.</p>
        </div>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Filters -->
    <form method="GET" action="{{ route('admin.orders.index') }}">
        <div class="mb-6 flex flex-col sm:flex-row gap-4">
            <div class="relative flex-grow">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by customer or order ID..." class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <select name="status" class="w-full sm:w-auto px-4 py-2.5 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                <option value="Pending" @selected(request('status') == 'Pending')>Pending</option>
                <option value="Processing" @selected(request('status') == 'Processing')>Processing</option>
                <option value="Shipped" @selected(request('status') == 'Shipped')>Shipped</option>
                <option value="Completed" @selected(request('status') == 'Completed')>Completed</option>
                <option value="Cancelled" @selected(request('status') == 'Cancelled')>Cancelled</option>
            </select>
            <button type="submit" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-lg shadow-md transition">Filter</button>
        </div>
    </form>

    <!-- Orders Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 w-12"></th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Order #</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Customer</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Date</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Total</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Status</th>
                        <th class="py-3 px-6 text-center font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50 transition-colors" data-order-id="{{ $order->id }}">
                        <td class="py-4 px-6 text-center">
                            {{-- <button class="expand-btn text-gray-400 hover:text-green-600">
                                <i class="fas fa-chevron-down"></i>
                            </button> --}}
                        </td>
                        <td class="py-4 px-6 font-mono text-gray-700">#{{ $order->id }}</td>
                        <td class="py-4 px-6 font-medium text-gray-800">{{ $order->user->name ?? 'N/A' }}</td>
                        <td class="py-4 px-6 text-gray-600">{{ $order->created_at->format('M d, Y') }}</td>
                        <td class="py-4 px-6 font-semibold text-gray-800">₹{{ number_format($order->total, 2) }}</td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1.5 rounded-full text-xs font-bold shadow-sm ring-1 ring-inset 
                                @switch($order->status)
                                    @case('Completed') bg-green-50 text-green-700 ring-green-600/20 @break
                                    @case('Shipped') bg-blue-50 text-blue-700 ring-blue-600/20 @break
                                    @case('Processing') bg-purple-50 text-purple-700 ring-purple-600/20 @break
                                    @case('Pending') bg-yellow-50 text-yellow-700 ring-yellow-600/20 @break
                                    @case('Cancelled') bg-red-50 text-red-700 ring-red-600/20 @break
                                    @default bg-gray-50 text-gray-600 ring-gray-500/20
                                @endswitch">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-2">
                                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" onclick="event.stopPropagation();">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="text-xs border-gray-300 rounded-md shadow-sm" onchange="this.form.submit()">
                                        <option value="Pending" @selected($order->status == 'Pending')>Pending</option>
                                        <option value="Processing" @selected($order->status == 'Processing')>Processing</option>
                                        <option value="Shipped" @selected($order->status == 'Shipped')>Shipped</option>
                                        <option value="Completed" @selected($order->status == 'Completed')>Completed</option>
                                        <option value="Cancelled" @selected($order->status == 'Cancelled')>Cancelled</option>
                                    </select>
                                </form>
                                @if($order->email)
                                    <span class="text-green-600" title="Email notifications enabled">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                        </svg>
                                    </span>
                                @else
                                    <span class="text-gray-400" title="No email address available">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                @endif
                                <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Are you sure?');" onclick="event.stopPropagation();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded-full" title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr id="details-{{ $order->id }}" class="order-details-row">
                        <td colspan="7" class="p-0 bg-gray-100">
                            <div class="p-6">
                                <h4 class="font-bold text-gray-700 mb-4">Items in Order #{{ $order->id }}:</h4>
                                <div class="space-y-4">
                                    @forelse($order->items as $item)
                                    <div class="flex items-center justify-between p-3 bg-white rounded-lg border">
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $item->name }}</p>
                                            <p class="text-sm text-gray-500">Qty: {{ $item->quantity }} x ₹{{ number_format($item->price, 2) }}</p>
                                        </div>
                                        <p class="font-bold text-gray-800">₹{{ number_format($item->price * $item->quantity, 2) }}</p>
                                    </div>
                                    @empty
                                    <p class="text-sm text-gray-500">No items found for this order.</p>
                                    @endforelse
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-10 text-gray-500">
                        <p>No orders found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 bg-gray-50 border-t border-gray-200">
            {{ $orders->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection

@push('script')
{{-- <script>
document.addEventListener('DOMContentLoaded', function() {
    const expandButtons = document.querySelectorAll('.expand-btn');

    expandButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation(); // Stop click from bubbling to other elements
            
            const row = this.closest('tr[data-order-id]');
            const orderId = row.dataset.orderId;
            const detailsRow = document.getElementById(`details-${orderId}`);

            if (detailsRow) {
                detailsRow.classList.toggle('expanded');
                this.classList.toggle('expanded'); // 'this' refers to the button
            }
        });
    });
});
</script> --}}
@endpush

