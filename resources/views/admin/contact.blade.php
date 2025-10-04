@extends('admin.layout')

@section('title', 'Contact Messages')

@section('content')

<div>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800">Contact Messages</h1>
            <p class="text-gray-500 mt-1">Review and respond to inquiries from your customers.</p>
        </div>
        {{-- This button is for demonstration; functionality can be added later --}}
        <button class="w-full sm:w-auto flex items-center justify-center gap-2 bg-gray-500 text-white font-bold px-5 py-2.5 rounded-lg shadow-lg cursor-not-allowed" disabled>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            Export All
        </button>
    </div>

     <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
            <p class="font-bold">Success!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Messages Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">ID</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">From</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Subject</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Message</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Status</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($messages as $message)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-semibold text-gray-700">{{ $message->id }}</td>
                        <td class="py-4 px-6">
                            <div class="font-medium text-gray-800">{{ $message->name }}</div>
                            <div class="text-xs text-gray-500">{{ $message->email }}</div>
                        </td>
                        <td class="py-4 px-6 font-medium text-gray-700">{{ $message->subject }}</td>
                        <td class="py-4 px-6 text-gray-600 truncate max-w-xs" title="{{ $message->message }}">{{ $message->message }}</td>
                        <td class="py-4 px-6">
                            @if($message->isReplied())
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Replied
                                </span>
                                <div class="text-xs text-gray-500 mt-1">{{ $message->replied_at->format('d M Y, h:i A') }}</div>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    Pending
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <button class="viewMessageBtn text-green-600 hover:text-green-800 p-2 hover:bg-green-50 rounded-full transition-colors" title="View Message"
                                        data-id="{{ $message->id }}"
                                        data-name="{{ $message->name }}"
                                        data-email="{{ $message->email }}"
                                        data-subject="{{ $message->subject }}"
                                        data-message="{{ $message->message }}"
                                        data-date="{{ $message->created_at->format('F d, Y, h:i A') }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                                <form method="POST" action="{{ route('admin.contact.destroy', $message->id) }}" onsubmit="return confirm('Are you sure you want to delete this message?');">
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
                            No messages found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
         <!-- Pagination Links -->
        <div class="p-4 bg-gray-50 border-t border-gray-200">
            {{ $messages->links() }}
        </div>
    </div>
</div>

<!-- View Message Modal -->
<div id="messageModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-2xl relative transform transition-all scale-95 opacity-0">
        <button id="closeMessageModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <h2 id="modalTitle" class="text-2xl font-bold mb-4 text-gray-800">Message Details</h2>
        <div class="border-t border-gray-200 pt-4 space-y-4">
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-1 font-semibold text-gray-500">From:</div>
                <div id="modalFromName" class="col-span-2 font-medium text-gray-800"></div>
            </div>
             <div class="grid grid-cols-3 gap-4">
                <div class="col-span-1 font-semibold text-gray-500">Email:</div>
                <div id="modalFromEmail" class="col-span-2 text-gray-600"></div>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-1 font-semibold text-gray-500">Date:</div>
                <div id="modalDate" class="col-span-2 text-gray-600"></div>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-1 font-semibold text-gray-500">Subject:</div>
                <div id="modalSubject" class="col-span-2 font-medium text-gray-800"></div>
            </div>
            <div class="space-y-2">
                <label class="block font-semibold text-gray-500">Message:</label>
                <p id="modalMessage" class="text-gray-700 bg-gray-50 p-4 rounded-lg border border-gray-200 whitespace-pre-wrap"></p>
            </div>
            
            <!-- Reply Section -->
            <div id="replySection" class="space-y-4 border-t border-gray-200 pt-4">
                <h3 class="text-lg font-semibold text-gray-800">Send Reply</h3>
                <form id="replyForm" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="replyMessage" class="block text-sm font-medium text-gray-700 mb-2">Your Reply:</label>
                            <textarea id="replyMessage" name="reply" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Type your reply here..." required></textarea>
                            <div id="replyError" class="text-red-500 text-sm mt-1 hidden"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="flex justify-end gap-4 mt-8">
            <button type="button" id="cancelMessageModal" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold px-5 py-2.5 rounded-lg transition">Close</button>
            <button type="button" id="sendReplyBtn" class="bg-green-600 hover:bg-green-700 text-white font-bold px-5 py-2.5 rounded-lg shadow-md hover:shadow-lg transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                Send Reply
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('messageModal');
    const modalContent = modal.querySelector('div');
    const viewBtns = document.querySelectorAll('.viewMessageBtn');
    const closeBtn = document.getElementById('closeMessageModal');
    const cancelBtn = document.getElementById('cancelMessageModal');
    const sendReplyBtn = document.getElementById('sendReplyBtn');
    const replyForm = document.getElementById('replyForm');
    const replyMessage = document.getElementById('replyMessage');
    const replyError = document.getElementById('replyError');
    
    const modalFromName = document.getElementById('modalFromName');
    const modalFromEmail = document.getElementById('modalFromEmail');
    const modalDate = document.getElementById('modalDate');
    const modalSubject = document.getElementById('modalSubject');
    const modalMessage = document.getElementById('modalMessage');

    let currentMessageId = null;

    function openModal(data) {
        currentMessageId = data.id;
        modalFromName.textContent = data.name;
        modalFromEmail.textContent = data.email;
        modalDate.textContent = data.date;
        modalSubject.textContent = data.subject;
        modalMessage.textContent = data.message;
        
        // Clear previous reply
        replyMessage.value = '';
        replyError.classList.add('hidden');
        
        // Update form action
        replyForm.action = `/admin/contact/${data.id}/reply`;
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
        }, 10);
    }

    function closeModal() {
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            currentMessageId = null;
        }, 200);
    }

    function showError(message) {
        replyError.textContent = message;
        replyError.classList.remove('hidden');
    }

    function hideError() {
        replyError.classList.add('hidden');
    }

    viewBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const data = {
                id: this.dataset.id,
                name: this.dataset.name,
                email: this.dataset.email,
                subject: this.dataset.subject,
                message: this.dataset.message,
                date: this.dataset.date,
            };
            openModal(data);
        });
    });

    sendReplyBtn.addEventListener('click', function() {
        const reply = replyMessage.value.trim();
        
        if (!reply) {
            showError('Please enter a reply message.');
            return;
        }
        
        if (reply.length < 10) {
            showError('Reply must be at least 10 characters long.');
            return;
        }
        
        hideError();
        
        // Disable button and show loading state
        this.disabled = true;
        this.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg> Sending...';
        
        // Submit the form
        replyForm.submit();
    });

    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    // Clear error when user starts typing
    replyMessage.addEventListener('input', hideError);

    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
});
</script>
@endsection
