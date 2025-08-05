@extends('admin.layout')

@section('title', 'Products Management')

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
            <h1 class="text-3xl font-extrabold text-gray-800">Products Management</h1>
            <p class="text-gray-500 mt-1">Manage your store's inventory, prices, and categories.</p>
        </div>
        <button id="addProductBtn" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-2.5 rounded-lg shadow-lg hover:shadow-green-500/30 transition-all duration-300 transform hover:-translate-y-0.5 mt-4 sm:mt-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Add New Product
        </button>
    </div>

    <!-- Filters Form -->
    <form method="GET" action="{{ route('products.index') }}">
        <div class="mb-6 flex flex-col sm:flex-row gap-4">
            <div class="relative flex-grow">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by product name or SKU..." class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <select name="category" class="w-full sm:w-auto px-4 py-2.5 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500" onchange="this.form.submit()">
                <option value="">All Categories</option>
                {{-- Loop through the Category models from the controller --}}
                @foreach($categories as $category)
                    <option value="{{ $category->name }}" @selected(request('category') == $category->name)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-lg shadow-md transition">Filter</button>
        </div>
    </form>


    <!-- Products Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Product</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">SKU</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Category</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Price</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Stock</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-4">
                                <img src="{{ $product->image_url }}" class="w-12 h-12 rounded-lg object-cover border border-gray-200" alt="{{ $product->name }}">
                                <span class="font-medium text-gray-800">{{ $product->name }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 font-mono text-gray-700">{{ $product->sku }}</td>
                        <td class="py-4 px-6"><span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">{{ $product->category }}</span></td>
                        <td class="py-4 px-6 font-semibold text-gray-800">₹{{ number_format($product->price, 2) }}</td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 rounded-full text-xs font-bold shadow-sm @if($product->stock < 10) bg-red-100 text-red-700 @elseif($product->stock < 50) bg-yellow-100 text-yellow-700 @else bg-green-100 text-green-700 @endif">
                                {{ $product->stock }} in stock
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <button class="editProductBtn text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-full transition-colors" title="Edit"
                                        data-id="{{$product->id}}"
                                        data-name="{{$product->name}}"
                                        data-sku="{{$product->sku}}"
                                        data-category="{{$product->category}}"
                                        data-price="{{$product->price}}"
                                        data-stock="{{$product->stock}}"
                                        data-description="{{$product->description}}"
                                        data-img="{{ $product->image_url }}"
                                        data-action="{{ route('products.update', $product->id) }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded-full transition-colors" title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V7a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                No products found. Try adjusting your search filters.
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
         <!-- Pagination Links -->
        <div class="p-4 bg-gray-50 border-t border-gray-200">
            {{ $products->withQueryString()->links() }}
        </div>
    </div>
</div>

<!-- Add/Edit Product Modal -->
<div id="productModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-lg relative transform transition-all scale-95 opacity-0">
        <button id="closeProductModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <h2 id="modalTitle" class="text-2xl font-bold mb-6 text-gray-800">Add New Product</h2>
        <form id="productForm" method="POST" action="" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="formMethod">
            <div class="space-y-4">
                <div>
                    <label for="productName" class="block font-semibold text-gray-700 mb-1">Product Name</label>
                    <input type="text" id="productName" name="name" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="e.g., Fresh Apples" >
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="productSku" class="block font-semibold text-gray-700 mb-1">SKU</label>
                        <input type="text" id="productSku" name="sku" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="e.g., FRU-APL-001" >
                    </div>
                    <div>
                        <label for="productCategory" class="block font-semibold text-gray-700 mb-1">Category</label>
                        <select id="productCategory" name="category" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                             {{-- Loop through the Category models from the controller --}}
                             @foreach($categories as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="productPrice" class="block font-semibold text-gray-700 mb-1">Price (₹)</label>
                        <input type="number" id="productPrice" step="0.01" name="price" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="e.g., 150.00" >
                    </div>
                    <div>
                        <label for="productStock" class="block font-semibold text-gray-700 mb-1">Stock Quantity</label>
                        <input type="number" id="productStock" name="stock" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="e.g., 50">
                    </div>
                </div>
                <div>
                    <label for="productDescription" class="block font-semibold text-gray-700 mb-1">Product Description</label>
                    <textarea id="productDescription" name="description" rows="3" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Enter a brief description of the product..."></textarea>
                </div>
                 <!-- Image Upload Field -->
                <div>
                    <label for="productImage" class="block font-semibold text-gray-700 mb-1">Product Image</label>
                    <div class="mt-2 flex items-center gap-4">
                        <img id="imagePreview" src="https://placehold.co/100x100/f0f0f0/999999?text=Preview" class="w-24 h-24 rounded-lg object-cover border">
                        <input type="file" id="productImage" name="img" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Leave blank to keep the current image when editing.</p>
                </div>
            </div>
            <div class="flex justify-end gap-4 mt-8">
                <button type="button" id="cancelProductModal" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold px-5 py-2.5 rounded-lg transition">Cancel</button>
                <button type="submit" id="saveProductBtn" class="bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-2.5 rounded-lg shadow-md hover:shadow-lg transition">Save Product</button>
            </div>
        </form>
    </div>
</div>

<script>
// This script remains the same as it correctly handles the modal interactions.
// The dynamic data is handled by Blade before the JavaScript runs.
document.addEventListener('DOMContentLoaded', function() {
    // Modal elements
    const modal = document.getElementById('productModal');
    const modalContent = modal.querySelector('div');
    const addBtn = document.getElementById('addProductBtn');
    const closeBtn = document.getElementById('closeProductModal');
    const cancelBtn = document.getElementById('cancelProductModal');
    const modalTitle = document.getElementById('modalTitle');
    const productForm = document.getElementById('productForm');

    // Form inputs
    const formMethodInput = document.getElementById('formMethod');
    const productNameInput = document.getElementById('productName');
    const productSkuInput = document.getElementById('productSku');
    const productCategoryInput = document.getElementById('productCategory');
    const productPriceInput = document.getElementById('productPrice');
    const productStockInput = document.getElementById('productStock');
    const productDescriptionInput = document.getElementById('productDescription');
    const productImageInput = document.getElementById('productImage');
    const imagePreview = document.getElementById('imagePreview');
    const saveBtn = document.getElementById('saveProductBtn');
    const editBtns = document.querySelectorAll('.editProductBtn');

    const defaultImage = 'https://placehold.co/100x100/f0f0f0/999999?text=Preview';

    function openModal() {
        modal.classList.remove('hidden');
        setTimeout(() => modalContent.classList.remove('scale-95', 'opacity-0'), 10);
    }

    function closeModal() {
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => modal.classList.add('hidden'), 200);
    }

    function setupAddModal() {
        clearErrors();
        productForm.reset();
        modalTitle.textContent = 'Add New Product';
        saveBtn.textContent = 'Save Product';
        productForm.action = '{{ route("products.store") }}';
        formMethodInput.value = 'POST';
        imagePreview.src = defaultImage;
        openModal();
    }

    function setupEditModal(data) {
        clearErrors();
        productForm.reset();
        productNameInput.value = data.name;
        productSkuInput.value = data.sku;
        productCategoryInput.value = data.category;
        productPriceInput.value = data.price;
        productStockInput.value = data.stock;
        productDescriptionInput.value = data.description;
        modalTitle.textContent = 'Edit Product';
        saveBtn.textContent = 'Update Product';
        productForm.action = data.action;
        formMethodInput.value = 'PUT';
        imagePreview.src = data.img || defaultImage;
        openModal();
    }

    addBtn.addEventListener('click', setupAddModal);

    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const data = {
                action: this.dataset.action,
                name: this.dataset.name,
                sku: this.dataset.sku,
                category: this.dataset.category,
                price: this.dataset.price,
                stock: this.dataset.stock,
                description: this.dataset.description,
                img: this.dataset.img,
            };
            setupEditModal(data);
        });
    });

    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);
    window.addEventListener('keydown', e => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
    });

    // Handle image preview
    productImageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => { imagePreview.src = e.target.result; };
            reader.readAsDataURL(file);
        }
    });

    // Client-side validation is a good UX, but remember server-side is for security!
    productForm.addEventListener('submit', function(e) {
        saveBtn.disabled = true;
        saveBtn.innerHTML = 'Saving...';
    });

    function showError(input, message) {
        const error = document.createElement('p');
        error.className = 'text-sm text-red-500 mt-1';
        error.textContent = message;
        input.parentNode.appendChild(error);
        input.classList.add('border-red-500', 'focus:ring-red-500');
    }

    function clearErrors() {
        document.querySelectorAll('.text-red-500').forEach(el => el.remove());
        productForm.querySelectorAll('input, select, textarea').forEach(el => {
            el.classList.remove('border-red-500', 'focus:ring-red-500');
        });
    }
});
</script>

@endsection
