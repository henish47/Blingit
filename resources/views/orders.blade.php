@extends('layout')

@section('title', 'My Orders | Blingit Grocery')

@section('content')
<style>
    .order-details-row {
        transition: all 0.3s ease-in-out;
    }
    .order-details-row.hidden {
        display: none;
    }
</style>

<div class="bg-gray-50 min-h-screen py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-8">My Orders</h1>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr class="text-gray-600 uppercase font-semibold tracking-wider">
                            <th class="py-4 px-6 text-left w-12"></th> <!-- For expand button -->
                            <th class="py-4 px-6 text-left">Order ID</th>
                            <th class="py-4 px-6 text-left">Date</th>
                            <th class="py-4 px-6 text-left">Total</th>
                            <th class="py-4 px-6 text-left">Status</th>
                            <th class="py-4 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($orders as $order)
                        <tr class="hover:bg-gray-50 transition-colors cursor-pointer" data-order-id="{{ $order->id }}">
                            <td class="py-4 px-6 text-center">
                                <button class="expand-btn text-gray-400 hover:text-green-600">
                                    <i class="fas fa-chevron-down transition-transform duration-300"></i>
                                </button>
                            </td>
                            <td class="py-4 px-6 font-mono text-gray-700">#BLINGIT-{{ $order->id }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $order->created_at->format('d M, Y') }}</td>
                            <td class="py-4 px-6 font-semibold text-gray-800">₹{{ number_format($order->total, 2) }}</td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1.5 rounded-full text-xs font-bold shadow-sm ring-1 ring-inset 
                                    @switch($order->status)
                                        @case('Completed')
                                            bg-green-50 text-green-700 ring-green-600/20
                                            @break
                                        @case('Shipped')
                                            bg-blue-50 text-blue-700 ring-blue-600/20
                                            @break
                                        @case('Processing')
                                            bg-purple-50 text-purple-700 ring-purple-600/20
                                            @break
                                        @case('Pending')
                                            bg-yellow-50 text-yellow-700 ring-yellow-600/20
                                            @break
                                        @case('Cancelled')
                                            bg-red-50 text-red-700 ring-red-600/20
                                            @break
                                        @default
                                            bg-gray-50 text-gray-600 ring-gray-500/20
                                    @endswitch">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <a href="{{ route('orders.invoice', $order) }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-semibold inline-flex items-center gap-1">
                                    <i class="fas fa-file-invoice"></i> View Invoice
                                </a>
                            </td>
                        </tr>
                        <tr id="details-{{ $order->id }}" class="order-details-row hidden">
                            <td colspan="6" class="p-0 bg-gray-50">
                                <div class="p-6">
                                    <h4 class="font-bold text-gray-700 mb-4">Items in this order:</h4>
                                    <div class="space-y-4">
                                        @foreach($order->items as $item)
                                        <div class="flex items-center justify-between p-3 bg-white rounded-lg border">
                                            <div class="flex items-center gap-4">
                                                <img src="{{ $item->product->image_url ?? 'https://placehold.co/64x64' }}" class="w-16 h-16 rounded-lg border object-cover" alt="{{ $item->name }}">
                                                <div>
                                                    <p class="font-semibold text-gray-800">{{ $item->name }}</p>
                                                    <p class="text-sm text-gray-500">Qty: {{ $item->quantity }} x ₹{{ number_format($item->price, 2) }}</p>
                                                </div>
                                            </div>
                                            <p class="font-bold text-gray-800">₹{{ number_format($item->price * $item->quantity, 2) }}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-16 text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No orders yet</h3>
                                <p class="mt-1 text-sm text-gray-500">You haven't placed any orders with us yet.</p>
                                <div class="mt-6">
                                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                        Start Shopping
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 bg-gray-50 border-t border-gray-200">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const orderRows = document.querySelectorAll('tr[data-order-id]');

    orderRows.forEach(row => {
        row.addEventListener('click', function(e) {
            // Prevent toggling when clicking on the invoice link
            if (e.target.closest('a')) {
                return;
            }

            const orderId = this.dataset.orderId;
            const detailsRow = document.getElementById(`details-${orderId}`);
            const icon = this.querySelector('.expand-btn i');

            if (detailsRow) {
                detailsRow.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            }
        });
    });
});
</script>
@endpush

