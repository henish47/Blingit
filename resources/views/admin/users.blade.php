@extends('admin.layout')

@section('title', 'Users Management')

@section('content')
{{-- 
  This Blade template provides a modern, responsive "Users Management" page.
  - It's styled entirely with Tailwind CSS, matching the "Blingit Grocery" theme.
  - Features a clean header, an improved table layout with avatars, and a redesigned modal for adding/editing users.
  - The page is fully responsive and includes interactive modals for a better user experience.
  - All icons are replaced with high-quality inline SVGs for optimal performance.
--}}

<div>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800">Users Management</h1>
            <p class="text-gray-500 mt-1">Manage all registered users and their roles.</p>
        </div>
        <button id="addUserBtn" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-2.5 rounded-lg shadow-lg hover:shadow-green-500/30 transition-all duration-300 transform hover:-translate-y-0.5 mt-4 sm:mt-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Add New User
        </button>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">#</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">User</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Email</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Role</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-6 font-semibold text-gray-700">1</td>
                        <td class="py-3 px-6">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name=John+Doe&background=22c55e&color=fff" class="w-9 h-9 rounded-full" alt="John Doe">
                                <span class="font-medium text-gray-800">John Doe</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-gray-600">john@example.com</td>
                        <td class="py-3 px-6"><span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Admin</span></td>
                        <td class="py-3 px-6">
                            <div class="flex items-center gap-2">
                                <button class="text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-full transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <button class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded-full transition-colors" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-6 font-semibold text-gray-700">2</td>
                        <td class="py-3 px-6">
                             <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name=Jane+Smith&background=ec4899&color=fff" class="w-9 h-9 rounded-full" alt="Jane Smith">
                                <span class="font-medium text-gray-800">Jane Smith</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-gray-600">jane@example.com</td>
                        <td class="py-3 px-6"><span class="bg-gray-100 text-gray-800 text-xs font-semibold px-3 py-1 rounded-full">Guest</span></td>
                        <td class="py-3 px-6">
                            <div class="flex items-center gap-2">
                                <button class="text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-full transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <button class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded-full transition-colors" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add/Edit User Modal -->
<div id="userModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md relative transform transition-all scale-95 opacity-0">
        <button id="closeUserModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <h2 id="modalTitle" class="text-2xl font-bold mb-6 text-gray-800">Add New User</h2>
        <form id="userForm" class="space-y-4">
            <div>
                <label for="userName" class="block font-semibold text-gray-700 mb-1">Full Name</label>
                <input type="text" id="userName" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="e.g., John Doe">
            </div>
            <div>
                <label for="userEmail" class="block font-semibold text-gray-700 mb-1">Email Address</label>
                <input type="email" id="userEmail" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="e.g., john@example.com">
            </div>
            <div>
                <label for="userRole" class="block font-semibold text-gray-700 mb-1">Role</label>
                <select id="userRole" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <option value="guest">Guest</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="flex justify-end gap-4 pt-4">
                <button type="button" id="cancelUserModal" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold px-5 py-2.5 rounded-lg transition">Cancel</button>
                <button type="submit" id="saveUserBtn" class="bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-2.5 rounded-lg shadow-md hover:shadow-lg transition">Save User</button>
            </div>
        </form>
    </div>
</div>

<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('userModal');
    const modalContent = modal.querySelector('div');
    const addBtn = document.getElementById('addUserBtn');
    const closeBtn = document.getElementById('closeUserModal');
    const cancelBtn = document.getElementById('cancelUserModal');
    const modalTitle = document.getElementById('modalTitle');
    const userForm = document.getElementById('userForm');
    const saveBtn = document.getElementById('saveUserBtn');

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
        userForm.reset();
        modalTitle.textContent = 'Add New User';
        saveBtn.textContent = 'Save User';
        openModal();
    }

    addBtn.addEventListener('click', setupAddModal);
    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });

    userForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Handle form submission logic here
        console.log('User form submitted.');
        closeModal();
    });
});
</script> -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('userModal');
    const modalContent = modal.querySelector('div');
    const addBtn = document.getElementById('addUserBtn');
    const closeBtn = document.getElementById('closeUserModal');
    const cancelBtn = document.getElementById('cancelUserModal');
    const modalTitle = document.getElementById('modalTitle');
    const userForm = document.getElementById('userForm');
    const saveBtn = document.getElementById('saveUserBtn');

    const userName = document.getElementById('userName');
    const userEmail = document.getElementById('userEmail');
    const userRole = document.getElementById('userRole');

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
        userForm.reset();
        removeErrors();
        modalTitle.textContent = 'Add New User';
        saveBtn.textContent = 'Save User';
        openModal();
    }

    function showError(input, message) {
        removeError(input);
        const error = document.createElement('p');
        error.className = 'text-red-500 text-sm mt-1';
        error.textContent = message;
        input.classList.add('border-red-500');
        input.parentNode.appendChild(error);
    }

    function removeError(input) {
        input.classList.remove('border-red-500');
        const error = input.parentNode.querySelector('.text-red-500');
        if (error) error.remove();
    }

    function removeErrors() {
        const errors = document.querySelectorAll('.text-red-500');
        errors.forEach(e => e.remove());
        [userName, userEmail, userRole].forEach(i => i.classList.remove('border-red-500'));
    }

    function validateForm() {
        let isValid = true;
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const namePattern = /^[a-zA-Z\s]+$/;

        removeErrors();

        if (!userName.value.trim()) {
            showError(userName, 'Full Name is required.');
            isValid = false;
        } else if (!namePattern.test(userName.value.trim())) {
            showError(userName, 'Name can only contain letters and spaces.');
            isValid = false;
        }

        if (!userEmail.value.trim()) {
            showError(userEmail, 'Email address is required.');
            isValid = false;
        } else if (!emailPattern.test(userEmail.value.trim())) {
            showError(userEmail, 'Invalid email format.');
            isValid = false;
        }

        if (!userRole.value.trim()) {
            showError(userRole, 'Role selection is required.');
            isValid = false;
        }

        return isValid;
    }

    addBtn.addEventListener('click', setupAddModal);
    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });

    userForm.addEventListener('submit', function(e) {
        e.preventDefault();
        if (validateForm()) {
            console.log('User form submitted.');
            closeModal();
        }
    });
});
</script>


@endsection
