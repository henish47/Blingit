@extends('admin.layout')

@section('title', 'Coupons Management')

@section('content')
<div>
    <!-- Session Messages -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
            <p class="font-bold">Success</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
             <p class="font-bold">Please fix the following errors:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800">Coupons Management</h1>
            <p class="text-gray-500 mt-1">Create, manage, and track promotional coupons.</p>
        </div>
        <button id="addCouponBtn" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-2.5 rounded-lg shadow-lg hover:shadow-green-500/30 transition-all duration-300 transform hover:-translate-y-0.5 mt-4 sm:mt-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add New Coupon
        </button>
    </div>
<div>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
            <p class="font-bold">Please fix the following errors:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!-- Coupons Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Code</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Type</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Value</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Expiry Date</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Status</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($coupons as $coupon)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-mono text-gray-700">{{ $coupon->code }}</td>
                        <td class="py-4 px-6">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full capitalize">{{ $coupon->type }}</span>
                        </td>
                        <td class="py-4 px-6 font-medium text-gray-800">{{ $coupon->type == 'percent' ? $coupon->value.'%' : '₹'.number_format($coupon->value, 2) }}</td>
                        <td class="py-4 px-6 text-gray-600">{{ $coupon->expires_at ? $coupon->expires_at->format('M d, Y') : 'No Expiry' }}</td>
                        <td class="py-4 px-6">
                             @if($coupon->status)
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Active</span>
                            @else
                                <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-3 py-1 rounded-full">Inactive</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <button class="editCouponBtn text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-full" title="Edit"
                                        data-id="{{ $coupon->id }}"
                                        data-code="{{ $coupon->code }}"
                                        data-type="{{ $coupon->type }}"
                                        data-value="{{ $coupon->value }}"
                                        data-expires_at="{{ $coupon->expires_at ? $coupon->expires_at->format('Y-m-d') : '' }}"
                                        data-status="{{ $coupon->status ? 1 : 0 }}"
                                        data-action="{{ route('admin.coupons.update', $coupon->id) }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this coupon?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded-full" title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-gray-500">No coupons found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 bg-gray-50 border-t border-gray-200">
            {{ $coupons->links() }}
        </div>
    </div>
</div>

<!-- Add/Edit Coupon Modal -->
<div id="couponModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md relative transform transition-all scale-95 opacity-0">
        <button id="closeCouponModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <h2 id="modalTitle" class="text-2xl font-bold mb-6 text-gray-800">Add New Coupon</h2>
        <form id="couponForm" method="POST" action="">
            @csrf
            <input type="hidden" name="_method" id="formMethod">
            <div class="space-y-4">
                <div>
                    <label for="couponCode" class="block font-semibold text-gray-700 mb-1">Coupon Code</label>
                    <input type="text" id="couponCode" name="code" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="e.g., WELCOME10">
                </div>
                <div>
                    <label for="couponType" class="block font-semibold text-gray-700 mb-1">Type</label>
                    <select id="couponType" name="type" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="percent">Percentage</option>
                        <option value="fixed">Fixed</option>
                    </select>
                </div>
                <div>
                    <label for="couponValue" class="block font-semibold text-gray-700 mb-1">Value</label>
                    <input type="number" id="couponValue" name="value" step="0.01" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="e.g., 10 or 50">
                </div>
                <div>
                    <label for="couponExpiry" class="block font-semibold text-gray-700 mb-1">Expiry Date (Optional)</label>
                    <input type="date" id="couponExpiry" name="expires_at" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                 <div>
                    <label for="couponStatus" class="block font-semibold text-gray-700 mb-1">Status</label>
                    <select id="couponStatus" name="status" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end gap-4 mt-8">
                <button type="button" id="cancelCouponModal" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold px-5 py-2.5 rounded-lg transition">Cancel</button>
                <button type="submit" id="saveCouponBtn" class="bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-2.5 rounded-lg shadow-md hover:shadow-lg transition">Save Coupon</button>
            </div>
        </form>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('couponModal');
    const modalContent = modal.querySelector('div');
    const addBtn = document.getElementById('addCouponBtn');
    const closeBtn = document.getElementById('closeCouponModal');
    const cancelBtn = document.getElementById('cancelCouponModal');
    const modalTitle = document.getElementById('modalTitle');
    const couponForm = document.getElementById('couponForm');
    const formMethodInput = document.getElementById('formMethod');
    
    const couponCodeInput = document.getElementById('couponCode');
    const couponTypeInput = document.getElementById('couponType');
    const couponValueInput = document.getElementById('couponValue');
    const couponExpiryInput = document.getElementById('couponExpiry');
    const couponStatusInput = document.getElementById('couponStatus');
    const saveBtn = document.getElementById('saveCouponBtn');
    const editBtns = document.querySelectorAll('.editCouponBtn');

    function openModal() {
        modal.classList.remove('hidden');
        setTimeout(() => modalContent.classList.remove('scale-95', 'opacity-0'), 10);
    }

    function closeModal() {
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => modal.classList.add('hidden'), 200);
    }

    function setupAddModal() {
        couponForm.reset();
        modalTitle.textContent = 'Add New Coupon';
        saveBtn.textContent = 'Save Coupon';
        // FIX: Use admin route prefix
        couponForm.action = '{{ route("admin.coupons.store") }}';
        formMethodInput.value = 'POST';
        openModal();
    }

    function setupEditModal(data) {
        couponForm.reset();
        modalTitle.textContent = 'Edit Coupon';
        saveBtn.textContent = 'Update Coupon';
        couponCodeInput.value = data.code;
        couponTypeInput.value = data.type;
        couponValueInput.value = data.value;
        couponExpiryInput.value = data.expires_at;
        couponStatusInput.value = data.status;
        couponForm.action = data.action;
        formMethodInput.value = 'PUT';
        openModal();
    }

    addBtn.addEventListener('click', setupAddModal);
    
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const data = {
                id: this.dataset.id,
                code: this.dataset.code,
                type: this.dataset.type,
                value: this.dataset.value,
                expires_at: this.dataset.expires_at,
                status: this.dataset.status,
                action: this.dataset.action,
            };
            setupEditModal(data);
        });
    });

    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);
    window.addEventListener('keydown', e => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
    });

    couponForm.addEventListener('submit', function(e) {
        saveBtn.disabled = true;
        saveBtn.innerHTML = 'Saving...';
    });
});
</script>


@endsection
