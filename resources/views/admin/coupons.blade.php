@extends('admin.layout')

@section('title', 'Coupons Management')

@section('content')

<div>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800">Coupons Management</h1>
            <p class="text-gray-500 mt-1">Create, manage, and track promotional coupons.</p>
        </div>
        <button id="addCouponBtn" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-2.5 rounded-lg shadow-lg hover:shadow-green-500/30 transition-all duration-300 transform hover:-translate-y-0.5 mt-4 sm:mt-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Add New Coupon
        </button>
    </div>

    <!-- Filters -->
    <div class="mb-6 flex flex-col sm:flex-row gap-4">
        <input type="text" placeholder="Search by coupon code..." class="w-full sm:w-1/2 px-4 py-2.5 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
        <select class="w-full sm:w-auto px-4 py-2.5 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            <option>Filter by Status</option>
            <option>Active</option>
            <option>Expired</option>
        </select>
    </div>

    <!-- Coupons Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Code</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Type</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Discount</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Expiry Date</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Status</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-mono text-gray-700">WELCOME10</td>
                        <td class="py-4 px-6"><span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">Percentage</span></td>
                        <td class="py-4 px-6 font-medium text-gray-800">10%</td>
                        <td class="py-4 px-6 text-gray-600">Dec 31, 2025</td>
                        <td class="py-4 px-6"><span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Active</span></td>
                        <td class="py-4 px-6 flex gap-2">
                            <button class="editCouponBtn flex items-center gap-1 text-blue-600 hover:text-blue-800 font-semibold text-xs" data-id="1" data-code="WELCOME10" data-type="percentage" data-discount="10" data-expiry="2025-12-31" data-status="active"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg> Edit</button>
                            <button class="flex items-center gap-1 text-red-600 hover:text-red-800 font-semibold text-xs"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> Delete</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-mono text-gray-700">FRESH50</td>
                        <td class="py-4 px-6"><span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-3 py-1 rounded-full">Flat</span></td>
                        <td class="py-4 px-6 font-medium text-gray-800">₹50</td>
                        <td class="py-4 px-6 text-gray-600">Nov 30, 2025</td>
                        <td class="py-4 px-6"><span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Active</span></td>
                        <td class="py-4 px-6 flex gap-2">
                           <button class="editCouponBtn flex items-center gap-1 text-blue-600 hover:text-blue-800 font-semibold text-xs" data-id="2" data-code="FRESH50" data-type="flat" data-discount="50" data-expiry="2025-11-30" data-status="active"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg> Edit</button>
                            <button class="flex items-center gap-1 text-red-600 hover:text-red-800 font-semibold text-xs"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> Delete</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-mono text-gray-700">BLING20</td>
                        <td class="py-4 px-6"><span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">Percentage</span></td>
                        <td class="py-4 px-6 font-medium text-gray-800">20%</td>
                        <td class="py-4 px-6 text-gray-600">Oct 15, 2025</td>
                        <td class="py-4 px-6"><span class="bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full">Expired</span></td>
                        <td class="py-4 px-6 flex gap-2">
                            <button class="editCouponBtn flex items-center gap-1 text-blue-600 hover:text-blue-800 font-semibold text-xs" data-id="3" data-code="BLING20" data-type="percentage" data-discount="20" data-expiry="2025-10-15" data-status="expired"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg> Edit</button>
                            <button class="flex items-center gap-1 text-red-600 hover:text-red-800 font-semibold text-xs"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add/Edit Coupon Modal -->
<div id="couponModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md relative transform transition-all scale-95 opacity-0">
        <button id="closeCouponModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <h2 id="modalTitle" class="text-2xl font-bold mb-6 text-gray-800">Add New Coupon</h2>
        <form id="couponForm">
            <input type="hidden" id="couponId" name="id">
            <div class="space-y-4">
                <div>
                    <label for="couponCode" class="block font-semibold text-gray-700 mb-1">Coupon Code</label>
                    <input type="text" id="couponCode" name="code" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="e.g., WELCOME10" >
                </div>
                <div>
                    <label for="couponType" class="block font-semibold text-gray-700 mb-1">Type</label>
                    <select id="couponType" name="type" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="percentage">Percentage</option>
                        <option value="flat">Flat</option>
                    </select>
                </div>
                <div>
                    <label for="couponDiscount" class="block font-semibold text-gray-700 mb-1">Discount Value</label>
                    <input type="number" id="couponDiscount" name="discount" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="e.g., 10 or 50">
                </div>
                <div>
                    <label for="couponExpiry" class="block font-semibold text-gray-700 mb-1">Expiry Date</label>
                    <input type="date" id="couponExpiry" name="expiry" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" >
                </div>
                 <div>
                    <label for="couponStatus" class="block font-semibold text-gray-700 mb-1">Status</label>
                    <select id="couponStatus" name="status" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" >
                        <option value="active">Active</option>
                        <option value="expired">Expired</option>
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

<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('couponModal');
    const modalContent = modal.querySelector('div');
    const addBtn = document.getElementById('addCouponBtn');
    const closeBtn = document.getElementById('closeCouponModal');
    const cancelBtn = document.getElementById('cancelCouponModal');
    const modalTitle = document.getElementById('modalTitle');
    const couponForm = document.getElementById('couponForm');
    const couponIdInput = document.getElementById('couponId');
    const couponCodeInput = document.getElementById('couponCode');
    const couponTypeInput = document.getElementById('couponType');
    const couponDiscountInput = document.getElementById('couponDiscount');
    const couponExpiryInput = document.getElementById('couponExpiry');
    const couponStatusInput = document.getElementById('couponStatus');
    const saveBtn = document.getElementById('saveCouponBtn');
    const editBtns = document.querySelectorAll('.editCouponBtn');

    function openModal() {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
        }, 10);
    }

    function closeModal() {
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 200);
    }

    function setupAddModal() {
        couponForm.reset();
        couponIdInput.value = '';
        modalTitle.textContent = 'Add New Coupon';
        saveBtn.textContent = 'Save Coupon';
        couponForm.action = '/admin/coupons'; // URL for creating
        openModal();
    }

    function setupEditModal(data) {
        couponForm.reset();
        couponIdInput.value = data.id;
        couponCodeInput.value = data.code;
        couponTypeInput.value = data.type;
        couponDiscountInput.value = data.discount;
        couponExpiryInput.value = data.expiry;
        couponStatusInput.value = data.status;
        modalTitle.textContent = 'Edit Coupon';
        saveBtn.textContent = 'Update Coupon';
        couponForm.action = `/admin/coupons/${data.id}`; // URL for updating
        openModal();
    }

    addBtn.addEventListener('click', setupAddModal);
    
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const data = {
                id: this.dataset.id,
                code: this.dataset.code,
                type: this.dataset.type,
                discount: this.dataset.discount,
                expiry: this.dataset.expiry,
                status: this.dataset.status,
            };
            setupEditModal(data);
        });
    });

    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });

    couponForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        console.log('Form submitted!');
        console.log('Action:', this.action);
        for (let [key, value] of formData.entries()) {
            console.log(key, value);
        }
        closeModal();
    });
});
</script> -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('couponModal');
    const modalContent = modal.querySelector('div');
    const addBtn = document.getElementById('addCouponBtn');
    const closeBtn = document.getElementById('closeCouponModal');
    const cancelBtn = document.getElementById('cancelCouponModal');
    const modalTitle = document.getElementById('modalTitle');
    const couponForm = document.getElementById('couponForm');
    const couponIdInput = document.getElementById('couponId');
    const couponCodeInput = document.getElementById('couponCode');
    const couponTypeInput = document.getElementById('couponType');
    const couponDiscountInput = document.getElementById('couponDiscount');
    const couponExpiryInput = document.getElementById('couponExpiry');
    const couponStatusInput = document.getElementById('couponStatus');
    const saveBtn = document.getElementById('saveCouponBtn');
    const editBtns = document.querySelectorAll('.editCouponBtn');

    function openModal() {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
        }, 10);
    }

    function closeModal() {
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 200);
    }

    function setupAddModal() {
        clearErrors();
        couponForm.reset();
        couponIdInput.value = '';
        modalTitle.textContent = 'Add New Coupon';
        saveBtn.textContent = 'Save Coupon';
        couponForm.action = '/admin/coupons';
        openModal();
    }

    function setupEditModal(data) {
        clearErrors();
        couponForm.reset();
        couponIdInput.value = data.id;
        couponCodeInput.value = data.code;
        couponTypeInput.value = data.type;
        couponDiscountInput.value = data.discount;
        couponExpiryInput.value = data.expiry;
        couponStatusInput.value = data.status;
        modalTitle.textContent = 'Edit Coupon';
        saveBtn.textContent = 'Update Coupon';
        couponForm.action = `/admin/coupons/${data.id}`;
        openModal();
    }

    addBtn.addEventListener('click', setupAddModal);

    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const data = {
                id: this.dataset.id,
                code: this.dataset.code,
                type: this.dataset.type,
                discount: this.dataset.discount,
                expiry: this.dataset.expiry,
                status: this.dataset.status,
            };
            setupEditModal(data);
        });
    });

    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });

    // ✅ STRONG VALIDATION
    couponForm.addEventListener('submit', function(e) {
        clearErrors();
        let valid = true;

        // Coupon Code
        const codePattern = /^[A-Za-z0-9]{4,20}$/;
        const code = couponCodeInput.value.trim();
        if (!code) {
            showError(couponCodeInput, 'Coupon Code is required.');
            valid = false;
        } else if (!codePattern.test(code)) {
            showError(couponCodeInput, 'Coupon Code must be 4–20 alphanumeric characters.');
            valid = false;
        }

        // Coupon Type
        if (!couponTypeInput.value.trim()) {
            showError(couponTypeInput, 'Please select a valid Coupon Type.');
            valid = false;
        }

        // Discount
        const discount = couponDiscountInput.value.trim();
        if (!discount) {
            showError(couponDiscountInput, 'Discount is required.');
            valid = false;
        } else if (isNaN(discount) || discount < 1 || discount > 100) {
            showError(couponDiscountInput, 'Discount must be a number between 1 and 100.');
            valid = false;
        }

        // Expiry Date
        const expiry = couponExpiryInput.value.trim();
        const today = new Date().toISOString().split('T')[0];
        if (!expiry) {
            showError(couponExpiryInput, 'Expiry Date is required.');
            valid = false;
        } else if (expiry < today) {
            showError(couponExpiryInput, 'Expiry Date must be today or in the future.');
            valid = false;
        }

        // Status
        if (!couponStatusInput.value.trim()) {
            showError(couponStatusInput, 'Please select a valid status.');
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
            return;
        }

        // Optional: remove this if using actual form submission
        const formData = new FormData(this);
        console.log('Form submitted to:', this.action);
        for (let [key, value] of formData.entries()) {
            console.log(key, value);
        }
        closeModal();
    });

    function showError(input, message) {
        const error = document.createElement('p');
        error.className = 'text-sm text-red-500 mt-1';
        error.textContent = message;
        input.parentNode.appendChild(error);
    }

    function clearErrors() {
        document.querySelectorAll('.text-red-500').forEach(el => el.remove());
    }
});
</script>

@endsection
