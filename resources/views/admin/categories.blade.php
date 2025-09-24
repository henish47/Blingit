@extends('admin.layout')

@section('title', 'Categories Management')

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
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800">Categories Management</h1>
            <p class="text-gray-500 mt-1">Add, edit, or remove product categories.</p>
        </div>
        <button id="addCategoryBtn" class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-2.5 rounded-lg shadow-lg transition-transform transform hover:-translate-y-0.5">
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
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Category Name</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Product Count</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Status</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($categories as $category)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-medium text-gray-800">{{ $category->name }}</td>
                        <td class="py-4 px-6 text-gray-600">{{ $category->products_count }}</td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 rounded-full text-xs font-bold shadow-sm {{ $category->status == 'Active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                {{ $category->status }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <button class="editCategoryBtn text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-full"
                                        data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}"
                                        data-status="{{ $category->status }}"
                                        data-action="{{ route('admin.categories.update', $category->id) }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure? Deleting a category cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded-full">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-10 text-gray-500">No categories found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 bg-gray-50 border-t border-gray-200">
            {{ $categories->links() }}
        </div>
    </div>
</div>

<!-- Add/Edit Category Modal -->
<div id="categoryModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md relative">
        <button id="closeCategoryModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <h2 id="modalTitle" class="text-2xl font-bold mb-6 text-gray-800">Add New Category</h2>
        <form id="categoryForm" method="POST" action="">
            @csrf
            <input type="hidden" name="_method" id="formMethod">
            <div class="space-y-4">
                <div>
                    <label for="categoryName" class="block font-semibold text-gray-700 mb-1">Category Name</label>
                    <input type="text" id="categoryName" name="name" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
                <div>
                    <label for="categoryStatus" class="block font-semibold text-gray-700 mb-1">Status</label>
                    <select id="categoryStatus" name="status" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end gap-4 mt-8">
                <button type="button" id="cancelCategoryModal" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold px-5 py-2.5 rounded-lg">Cancel</button>
                <button type="submit" id="saveCategoryBtn" class="bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-2.5 rounded-lg">Save Category</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('categoryModal');
    const addBtn = document.getElementById('addCategoryBtn');
    const closeBtn = document.getElementById('closeCategoryModal');
    const cancelBtn = document.getElementById('cancelCategoryModal');
    const modalTitle = document.getElementById('modalTitle');
    const categoryForm = document.getElementById('categoryForm');
    const formMethodInput = document.getElementById('formMethod');
    const categoryNameInput = document.getElementById('categoryName');
    const categoryStatusInput = document.getElementById('categoryStatus');
    const saveBtn = document.getElementById('saveCategoryBtn');
    const editBtns = document.querySelectorAll('.editCategoryBtn');

    function openModal() { modal.classList.remove('hidden'); }
    function closeModal() { modal.classList.add('hidden'); }

    function setupAddModal() {
        categoryForm.reset();
        modalTitle.textContent = 'Add New Category';
        saveBtn.textContent = 'Save Category';
        categoryForm.action = '{{ route("admin.categories.store") }}';
        formMethodInput.value = 'POST';
        categoryStatusInput.value = 'Active';
        openModal();
    }

    function setupEditModal(data) {
        categoryForm.reset();
        categoryNameInput.value = data.name;
        categoryStatusInput.value = data.status;
        modalTitle.textContent = 'Edit Category';
        saveBtn.textContent = 'Update Category';
        categoryForm.action = data.action;
        formMethodInput.value = 'PUT';
        openModal();
    }

    addBtn.addEventListener('click', setupAddModal);
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            setupEditModal({
                action: this.dataset.action,
                name: this.dataset.name,
                status: this.dataset.status,
            });
        });
    });

    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);
    window.addEventListener('keydown', e => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
    });
});
</script>

@endsection
