@extends('admin.layout')

@section('title', 'Users Management')

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
            <h1 class="text-3xl font-extrabold text-gray-800">Users Management</h1>
            <p class="text-gray-500 mt-1">Manage all registered users and their roles.</p>
        </div>
        <button id="addUserBtn" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-2.5 rounded-lg shadow-lg hover:shadow-green-500/30 transition-all duration-300 transform hover:-translate-y-0.5 mt-4 sm:mt-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add New User
        </button>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">ID</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">User</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Email</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Role</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-6 font-semibold text-gray-700">{{ $user->id }}</td>
                        <td class="py-3 px-6">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff" class="w-9 h-9 rounded-full" alt="{{ $user->name }}">
                                <span class="font-medium text-gray-800">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-gray-600">{{ $user->email }}</td>
                        <td class="py-3 px-6">
                            @if($user->role === 'admin')
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Admin</span>
                            @else
                                <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-3 py-1 rounded-full">Guest</span>
                            @endif
                        </td>
                        <td class="py-3 px-6">
                            <div class="flex items-center gap-2">
                                <button class="editUserBtn text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-full transition-colors" title="Edit"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-role="{{ $user->role }}"
                                        data-action="{{ route('admin.users.update', $user->id) }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                @if(auth()->id() !== $user->id)
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded-full transition-colors" title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m-7.5-2.962A3.75 3.75 0 0112 15v-2.25A3.75 3.75 0 0115.75 9v-2.25a3.75 3.75 0 01-3.75-3.75z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 12.75a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12a9 9 0 0114.59-6.41l-2.662 2.662a3.752 3.752 0 00-5.263 5.263L3.75 12zM12 12.75l-2.662 2.662a9.094 9.094 0 01-3.741-.479 3 3 0 014.682-2.72m7.5-2.962a3.75 3.75 0 00-5.263-5.263L12 12.75z" />
                                </svg>
                                No users found. Click "Add New User" to start.
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 bg-gray-50 border-t border-gray-200">
            {{ $users->links() }}
        </div>
    </div>
</div>

<!-- Add/Edit User Modal -->
<div id="userModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md relative transform transition-all scale-95 opacity-0">
        <button id="closeUserModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <h2 id="modalTitle" class="text-2xl font-bold mb-6 text-gray-800">Add New User</h2>
        <form id="userForm" method="POST" action="" class="space-y-4">
            @csrf
            <input type="hidden" name="_method" id="formMethod">
            <div>
                <label for="userName" class="block font-semibold text-gray-700 mb-1">Full Name</label>
                <input type="text" id="userName" name="name" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="e.g., John Doe">
            </div>
            <div>
                <label for="userEmail" class="block font-semibold text-gray-700 mb-1">Email Address</label>
                <input type="email" id="userEmail" name="email" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="e.g., john@example.com">
            </div>
             <div>
                <label for="userRole" class="block font-semibold text-gray-700 mb-1">Role</label>
                <select id="userRole" name="role" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <option value="guest">Guest</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div>
                <label for="password" class="block font-semibold text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                <p class="text-xs text-gray-500 mt-1">Leave blank to keep current password when editing.</p>
            </div>
            <div>
                <label for="password_confirmation" class="block font-semibold text-gray-700 mb-1">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div class="flex justify-end gap-4 pt-4">
                <button type="button" id="cancelUserModal" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold px-5 py-2.5 rounded-lg transition">Cancel</button>
                <button type="submit" id="saveUserBtn" class="bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-2.5 rounded-lg shadow-md hover:shadow-lg transition">Save User</button>
            </div>
        </form>
    </div>
</div>

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
    const formMethodInput = document.getElementById('formMethod');

    const userNameInput = document.getElementById('userName');
    const userEmailInput = document.getElementById('userEmail');
    const userRoleInput = document.getElementById('userRole');
    const passwordInput = document.getElementById('password');
    const passwordConfirmationInput = document.getElementById('password_confirmation');
    
    const editBtns = document.querySelectorAll('.editUserBtn');

    function openModal() {
        modal.classList.remove('hidden');
        setTimeout(() => modalContent.classList.remove('scale-95', 'opacity-0'), 10);
    }

    function closeModal() {
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => modal.classList.add('hidden'), 200);
    }

    function setupAddModal() {
        userForm.reset();
        modalTitle.textContent = 'Add New User';
        saveBtn.textContent = 'Save User';
        userForm.action = '{{ route("admin.users.store") }}';
        formMethodInput.value = 'POST';
        openModal();
    }
    
    function setupEditModal(data) {
        userForm.reset();
        modalTitle.textContent = 'Edit User';
        saveBtn.textContent = 'Update User';
        userNameInput.value = data.name;
        userEmailInput.value = data.email;
        userRoleInput.value = data.role;
        userForm.action = data.action;
        formMethodInput.value = 'PUT';
        openModal();
    }

    addBtn.addEventListener('click', setupAddModal);
    
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const data = {
                name: this.dataset.name,
                email: this.dataset.email,
                role: this.dataset.role,
                action: this.dataset.action,
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

    userForm.addEventListener('submit', function(e) {
        saveBtn.disabled = true;
        saveBtn.innerHTML = 'Saving...';
    });
});
</script>

@endsection
