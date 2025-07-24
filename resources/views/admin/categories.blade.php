@extends('admin.layout')

@section('title', 'Category Management')

@section('content')
{{-- 
  This Blade template provides a modern, responsive "Category Management" page.
  - It's styled entirely with Tailwind CSS, matching the "Blingit Grocery" theme.
  - Features a clean header, an improved table layout, and a redesigned modal for adding/editing categories.
  - The page is fully responsive and includes interactive modals for a better user experience.
  - All icons are replaced with high-quality inline SVGs.
--}}

<div>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800">Category Management</h1>
            <p class="text-gray-500 mt-1">Add, edit, or remove product categories from your store.</p>
        </div>
        <button id="addCategoryBtn" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-2.5 rounded-lg shadow-lg hover:shadow-green-500/30 transition-all duration-300 transform hover:-translate-y-0.5 mt-4 sm:mt-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Add New Category
        </button>
    </div>

    <!-- Categories Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">#</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Category Name</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Product Count</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-semibold text-gray-700">1</td>
                        <td class="py-4 px-6"><span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Fruits</span></td>
                        <td class="py-4 px-6 font-medium text-gray-800">15</td>
                        <td class="py-4 px-6 flex gap-2">
                            <button class="editCategoryBtn flex items-center gap-1 text-blue-600 hover:text-blue-800 font-semibold text-xs" data-id="1" data-name="Fruits"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg> Edit</button>
                            <button class="flex items-center gap-1 text-red-600 hover:text-red-800 font-semibold text-xs"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> Delete</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-semibold text-gray-700">2</td>
                        <td class="py-4 px-6"><span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">Vegetables</span></td>
                        <td class="py-4 px-6 font-medium text-gray-800">22</td>
                        <td class="py-4 px-6 flex gap-2">
                            <button class="editCategoryBtn flex items-center gap-1 text-blue-600 hover:text-blue-800 font-semibold text-xs" data-id="2" data-name="Vegetables"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg> Edit</button>
                            <button class="flex items-center gap-1 text-red-600 hover:text-red-800 font-semibold text-xs"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> Delete</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-semibold text-gray-700">3</td>
                        <td class="py-4 px-6"><span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">Dairy & Eggs</span></td>
                        <td class="py-4 px-6 font-medium text-gray-800">18</td>
                        <td class="py-4 px-6 flex gap-2">
                            <button class="editCategoryBtn flex items-center gap-1 text-blue-600 hover:text-blue-800 font-semibold text-xs" data-id="3" data-name="Dairy & Eggs"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg> Edit</button>
                            <button class="flex items-center gap-1 text-red-600 hover:text-red-800 font-semibold text-xs"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add/Edit Category Modal -->
<div id="categoryModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md relative transform transition-all scale-95 opacity-0">
        <button id="closeCategoryModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <h2 id="modalTitle" class="text-2xl font-bold mb-6 text-gray-800">Add New Category</h2>
        <form id="categoryForm">
            <input type="hidden" id="categoryId" name="id">
            <div class="mb-4">
                <label for="categoryName" class="block font-semibold text-gray-700 mb-1">Category Name</label>
                <input type="text" id="categoryName" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="e.g., Fruits">
            </div>
            <div class="flex justify-end gap-4 mt-8">
                <button type="button" id="cancelCategoryModal" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold px-5 py-2.5 rounded-lg transition">Cancel</button>
                <button type="submit" id="saveCategoryBtn" class="bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-2.5 rounded-lg shadow-md hover:shadow-lg transition">Save Category</button>
            </div>
        </form>
    </div>
</div>

<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('categoryModal');
    const modalContent = modal.querySelector('div');
    const addBtn = document.getElementById('addCategoryBtn');
    const closeBtn = document.getElementById('closeCategoryModal');
    const cancelBtn = document.getElementById('cancelCategoryModal');
    const modalTitle = document.getElementById('modalTitle');
    const categoryForm = document.getElementById('categoryForm');
    const categoryNameInput = document.getElementById('categoryName');
    const categoryIdInput = document.getElementById('categoryId');
    const saveBtn = document.getElementById('saveCategoryBtn');
    const editBtns = document.querySelectorAll('.editCategoryBtn');

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
        categoryForm.reset();
        categoryIdInput.value = '';
        modalTitle.textContent = 'Add New Category';
        saveBtn.textContent = 'Save Category';
        categoryForm.action = '/admin/categories'; // URL for creating
        openModal();
    }

    function setupEditModal(id, name) {
        categoryForm.reset();
        categoryIdInput.value = id;
        categoryNameInput.value = name;
        modalTitle.textContent = 'Edit Category';
        saveBtn.textContent = 'Update Category';
        categoryForm.action = `/admin/categories/${id}`; // URL for updating
        openModal();
    }

    addBtn.addEventListener('click', setupAddModal);
    
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            setupEditModal(id, name);
        });
    });

    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });

    categoryForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Here you would typically submit the form data via AJAX
        // For demonstration, we'll just log the data and close the modal.
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
    const modal = document.getElementById('categoryModal');
    const modalContent = modal.querySelector('div');
    const addBtn = document.getElementById('addCategoryBtn');
    const closeBtn = document.getElementById('closeCategoryModal');
    const cancelBtn = document.getElementById('cancelCategoryModal');
    const modalTitle = document.getElementById('modalTitle');
    const categoryForm = document.getElementById('categoryForm');
    const categoryNameInput = document.getElementById('categoryName');
    const categoryIdInput = document.getElementById('categoryId');
    const saveBtn = document.getElementById('saveCategoryBtn');
    const editBtns = document.querySelectorAll('.editCategoryBtn');

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
        categoryForm.reset();
        categoryIdInput.value = '';
        modalTitle.textContent = 'Add New Category';
        saveBtn.textContent = 'Save Category';
        categoryForm.action = '/admin/categories';
        openModal();
    }

    function setupEditModal(id, name) {
        categoryForm.reset();
        categoryIdInput.value = id;
        categoryNameInput.value = name;
        modalTitle.textContent = 'Edit Category';
        saveBtn.textContent = 'Update Category';
        categoryForm.action = `/admin/categories/${id}`;
        openModal();
    }

    addBtn.addEventListener('click', setupAddModal);

    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            setupEditModal(id, name);
        });
    });

    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });

    // ✅ Strong JS Validation (only letters allowed)
    categoryForm.addEventListener('submit', function(e) {
        const name = categoryNameInput.value.trim();
        const namePattern = /^[A-Za-z\s]+$/; // Only letters and spaces

        // Remove old error
        const oldError = categoryNameInput.parentNode.querySelector('.category-error');
        if (oldError) oldError.remove();

        let isValid = true;

        if (!name) {
            showError('Category name is required.');
            isValid = false;
        } else if (name.length < 3) {
            showError('Category name must be at least 3 characters.');
            isValid = false;
        } else if (name.length > 50) {
            showError('Category name must not exceed 50 characters.');
            isValid = false;
        } else if (!namePattern.test(name)) {
            showError('Only letters and spaces are not allowed in category name.');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
            return;
        }

        function showError(msg) {
            const errorEl = document.createElement('p');
            errorEl.className = 'category-error text-sm text-red-500 mt-1';
            errorEl.textContent = msg;
            categoryNameInput.parentNode.appendChild(errorEl);
        }
    });
});
</script>


@endsection
