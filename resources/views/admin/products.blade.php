@extends('admin.layout')

@section('title', 'Products Management')

@section('content')
{{-- 
  This Blade template provides a modern, responsive "Products Management" page.
  - It's styled entirely with Tailwind CSS, matching the "Blingit Grocery" theme.
  - Features a clean header, improved filtering options, and an enhanced table layout with product images.
  - The page is fully responsive and includes a single, reusable modal for both adding and editing products.
  - All icons are replaced with high-quality inline SVGs for optimal performance.
--}}

<div>
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

    <!-- Filters -->
    <div class="mb-6 flex flex-col sm:flex-row gap-4">
        <div class="relative flex-grow">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </span>
            <input type="text" placeholder="Search by product name or SKU..." class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        <select class="w-full sm:w-auto px-4 py-2.5 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            <option>All Categories</option>
            <option>Fruits</option>
            <option>Vegetables</option>
            <option>Dairy & Eggs</option>
        </select>
    </div>

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
                    @php
                        $products = [
                            ['id' => 1, 'name' => 'Fresh Apples', 'sku' => 'FRU-APL-001', 'category' => 'Fruits', 'price' => '150.00', 'stock' => 50, 'img' => 'https://www.bigbasket.com/media/uploads/p/l/1203432_2-fresho-apple-fuji.jpg', 'description' => 'Crisp and juicy Fuji apples, perfect for a healthy snack.'],
                            ['id' => 2, 'name' => 'Organic Carrots', 'sku' => 'VEG-CAR-001', 'category' => 'Vegetables', 'price' => '80.00', 'stock' => 120, 'img' => 'https://www.bigbasket.com/media/uploads/p/l/10000073_16-fresho-carrot-orange.jpg', 'description' => 'Fresh organic carrots, great for salads, soups, and roasting.'],
                            ['id' => 3, 'name' => 'Amul Gold Milk', 'sku' => 'DAI-MLK-001', 'category' => 'Dairy & Eggs', 'price' => '34.00', 'stock' => 75, 'img' => 'https://www.bigbasket.com/media/uploads/p/l/1203470_2-amul-gold-homogenised-standardised-milk.jpg', 'description' => 'Full cream homogenized milk, rich in nutrients.'],
                        ];
                    @endphp
                    @foreach($products as $product)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-4">
                                <img src="{{ $product['img'] }}" class="w-12 h-12 rounded-lg object-cover border border-gray-200" alt="{{ $product['name'] }}" onerror="this.onerror=null;this.src='https://placehold.co/48x48/f0f0f0/999999?text=Img';">
                                <span class="font-medium text-gray-800">{{ $product['name'] }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 font-mono text-gray-700">{{ $product['sku'] }}</td>
                        <td class="py-4 px-6"><span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">{{ $product['category'] }}</span></td>
                        <td class="py-4 px-6 font-semibold text-gray-800">₹{{ $product['price'] }}</td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 rounded-full text-xs font-bold shadow-sm @if($product['stock'] < 10) bg-red-100 text-red-700 @else bg-green-100 text-green-700 @endif">
                                {{ $product['stock'] }} in stock
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <button class="editProductBtn text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-full transition-colors" title="Edit"
                                        data-id="{{$product['id']}}" data-name="{{$product['name']}}" data-sku="{{$product['sku']}}" data-category="{{$product['category']}}" data-price="{{$product['price']}}" data-stock="{{$product['stock']}}" data-description="{{$product['description']}}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <button class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded-full transition-colors" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
        <form id="productForm">
            <input type="hidden" id="productId" name="id">
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
                            <option>Fruits</option>
                            <option>Vegetables</option>
                            <option>Dairy & Eggs</option>
                        </select>
                    </div>
                    <div>
                        <label for="productPrice" class="block font-semibold text-gray-700 mb-1">Price (₹)</label>
                        <input type="number" id="productPrice" name="price" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="e.g., 150.00" >
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
            </div>
            <div class="flex justify-end gap-4 mt-8">
                <button type="button" id="cancelProductModal" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold px-5 py-2.5 rounded-lg transition">Cancel</button>
                <button type="submit" id="saveProductBtn" class="bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-2.5 rounded-lg shadow-md hover:shadow-lg transition">Save Product</button>
            </div>
        </form>
    </div>
</div>

<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('productModal');
    const modalContent = modal.querySelector('div');
    const addBtn = document.getElementById('addProductBtn');
    const closeBtn = document.getElementById('closeProductModal');
    const cancelBtn = document.getElementById('cancelProductModal');
    const modalTitle = document.getElementById('modalTitle');
    const productForm = document.getElementById('productForm');
    const productIdInput = document.getElementById('productId');
    const productNameInput = document.getElementById('productName');
    const productSkuInput = document.getElementById('productSku');
    const productCategoryInput = document.getElementById('productCategory');
    const productPriceInput = document.getElementById('productPrice');
    const productStockInput = document.getElementById('productStock');
    const productDescriptionInput = document.getElementById('productDescription');
    const saveBtn = document.getElementById('saveProductBtn');
    const editBtns = document.querySelectorAll('.editProductBtn');

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
        productForm.reset();
        productIdInput.value = '';
        modalTitle.textContent = 'Add New Product';
        saveBtn.textContent = 'Save Product';
        productForm.action = '/admin/products'; // URL for creating
        openModal();
    }

    function setupEditModal(data) {
        productForm.reset();
        productIdInput.value = data.id;
        productNameInput.value = data.name;
        productSkuInput.value = data.sku;
        productCategoryInput.value = data.category;
        productPriceInput.value = data.price;
        productStockInput.value = data.stock;
        productDescriptionInput.value = data.description;
        modalTitle.textContent = 'Edit Product';
        saveBtn.textContent = 'Update Product';
        productForm.action = `/admin/products/${data.id}`; // URL for updating
        openModal();
    }

    addBtn.addEventListener('click', setupAddModal);
    
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const data = {
                id: this.dataset.id,
                name: this.dataset.name,
                sku: this.dataset.sku,
                category: this.dataset.category,
                price: this.dataset.price,
                stock: this.dataset.stock,
                description: this.dataset.description,
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

    productForm.addEventListener('submit', function(e) {
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
    const modal = document.getElementById('productModal');
    const modalContent = modal.querySelector('div');
    const addBtn = document.getElementById('addProductBtn');
    const closeBtn = document.getElementById('closeProductModal');
    const cancelBtn = document.getElementById('cancelProductModal');
    const modalTitle = document.getElementById('modalTitle');
    const productForm = document.getElementById('productForm');
    const productIdInput = document.getElementById('productId');
    const productNameInput = document.getElementById('productName');
    const productSkuInput = document.getElementById('productSku');
    const productCategoryInput = document.getElementById('productCategory');
    const productPriceInput = document.getElementById('productPrice');
    const productStockInput = document.getElementById('productStock');
    const productDescriptionInput = document.getElementById('productDescription');
    const saveBtn = document.getElementById('saveProductBtn');
    const editBtns = document.querySelectorAll('.editProductBtn');

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
        productForm.reset();
        productIdInput.value = '';
        modalTitle.textContent = 'Add New Product';
        saveBtn.textContent = 'Save Product';
        productForm.action = '/admin/products';
        openModal();
    }

    function setupEditModal(data) {
        clearErrors();
        productForm.reset();
        productIdInput.value = data.id;
        productNameInput.value = data.name;
        productSkuInput.value = data.sku;
        productCategoryInput.value = data.category;
        productPriceInput.value = data.price;
        productStockInput.value = data.stock;
        productDescriptionInput.value = data.description;
        modalTitle.textContent = 'Edit Product';
        saveBtn.textContent = 'Update Product';
        productForm.action = `/admin/products/${data.id}`;
        openModal();
    }

    addBtn.addEventListener('click', setupAddModal);

    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const data = {
                id: this.dataset.id,
                name: this.dataset.name,
                sku: this.dataset.sku,
                category: this.dataset.category,
                price: this.dataset.price,
                stock: this.dataset.stock,
                description: this.dataset.description,
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

    productForm.addEventListener('submit', function(e) {
        clearErrors();
        let valid = true;

        // 1. Required check first
        const requiredFields = [
            { input: productNameInput, name: 'Product Name' },
            { input: productSkuInput, name: 'SKU' },
            { input: productCategoryInput, name: 'Category' },
            { input: productPriceInput, name: 'Price' },
            { input: productStockInput, name: 'Stock' },
            { input: productDescriptionInput, name: 'Description' },
        ];

        requiredFields.forEach(field => {
            if (!field.input.value.trim()) {
                showError(field.input, `${field.name} is required.`);
                valid = false;
            }
        });

        if (!valid) {
            e.preventDefault();
            return;
        }

        // 2. Further strong validations only if required fields are filled

        const name = productNameInput.value.trim();
        if (name.length < 3 || !/^[A-Za-z0-9\s]+$/.test(name)) {
            showError(productNameInput, 'Product Name must be at least 3 letters and can only contain letters, numbers and spaces.');
            valid = false;
        }

        const sku = productSkuInput.value.trim();
        if (sku.length < 5 || !/^[A-Za-z0-9-_]+$/.test(sku)) {
            showError(productSkuInput, 'SKU must be alphanumeric and at least 5 characters (letters, numbers, - and _ only).');
            valid = false;
        }

        const price = parseFloat(productPriceInput.value.trim());
        if (isNaN(price) || price <= 0 || price > 99999.99) {
            showError(productPriceInput, 'Price must be a positive number not exceeding ₹99,999.99.');
            valid = false;
        }

        const stock = productStockInput.value.trim();
        if (!/^\d+$/.test(stock) || parseInt(stock) > 9999) {
            showError(productStockInput, 'Stock must be a whole number between 0 and 9999.');
            valid = false;
        }

        const desc = productDescriptionInput.value.trim();
        if (desc.length < 10) {
            showError(productDescriptionInput, 'Description must be at least 10 characters long.');
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
            return;
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
