@extends('admin.layout')

@section('title', 'Category Management')

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
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">ID</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Category Name</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Status</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Product Count</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($categories as $category)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-semibold text-gray-700">{{ $category->id }}</td>
                        <td class="py-4 px-6">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">{{ $category->name }}</span>
                        </td>
                        <td class="py-4 px-6">
                            @if($category->status)
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Active</span>
                            @else
                                <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-3 py-1 rounded-full">Inactive</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 font-medium text-gray-800">{{ $category->products_count }}</td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <button class="editCategoryBtn text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-full transition-colors" title="Edit"
                                        data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}"
                                        data-status="{{ $category->status ? 1 : 0 }}"
                                        data-action="{{ route('categories.update', $category->id) }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
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
                        <td colspan="5" class="text-center py-10 text-gray-500">
                             <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0A2.25 2.25 0 013.75 7.5h16.5a2.25 2.25 0 012.25 2.25m-18.75 0h18.75v.008H3.75V9.776z" />
                                </svg>
                                No categories found. Click "Add New Category" to start.
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination Links -->
        <div class="p-4 bg-gray-50 border-t border-gray-200">
            {{ $categories->links() }}
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
        <form id="categoryForm" method="POST" action="">
            @csrf
            <input type="hidden" name="_method" id="formMethod">
            <div class="mb-4">
                <label for="categoryName" class="block font-semibold text-gray-700 mb-1">Category Name</label>
                <input type="text" id="categoryName" name="name" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="e.g., Fruits">
            </div>
            <div class="mb-4">
                <label for="categoryStatus" class="block font-semibold text-gray-700 mb-1">Status</label>
                <select id="categoryStatus" name="status" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <div class="flex justify-end gap-4 mt-8">
                <button type="button" id="cancelCategoryModal" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold px-5 py-2.5 rounded-lg transition">Cancel</button>
                <button type="submit" id="saveCategoryBtn" class="bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-2.5 rounded-lg shadow-md hover:shadow-lg transition">Save Category</button>
            </div>
        </form>
    </div>
</div>

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
    const categoryStatusInput = document.getElementById('categoryStatus'); // Get the status select element
    const formMethodInput = document.getElementById('formMethod');
    const saveBtn = document.getElementById('saveCategoryBtn');
    const editBtns = document.querySelectorAll('.editCategoryBtn');

    function openModal() {
        modal.classList.remove('hidden');
        setTimeout(() => modalContent.classList.remove('scale-95', 'opacity-0'), 10);
    }

    function closeModal() {
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => modal.classList.add('hidden'), 200);
    }

    function setupAddModal() {
        categoryForm.reset();
        modalTitle.textContent = 'Add New Category';
        saveBtn.textContent = 'Save Category';
        categoryForm.action = '{{ route("categories.store") }}';
        formMethodInput.value = 'POST';
        categoryStatusInput.value = '1'; // Default to Active
        openModal();
    }

    function setupEditModal(data) {
        categoryForm.reset();
        categoryNameInput.value = data.name;
        categoryStatusInput.value = data.status; // Set the status from data attribute
        modalTitle.textContent = 'Edit Category';
        saveBtn.textContent = 'Update Category';
        categoryForm.action = data.action;
        formMethodInput.value = 'PUT';
        openModal();
    }

    addBtn.addEventListener('click', setupAddModal);

    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const data = {
                name: this.dataset.name,
                status: this.dataset.status, // Get status from data attribute
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

    categoryForm.addEventListener('submit', function(e) {
        saveBtn.disabled = true;
        saveBtn.innerHTML = 'Saving...';
    });
});
</script>

@endsection
