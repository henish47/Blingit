@extends('admin.layout')

@section('title', 'Manage Reviews | Admin')

@section('content')

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Reviews</h1>

    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-200">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-left text-gray-600">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">User</th>
                        <th class="px-4 py-3">Order</th>
                        <th class="px-4 py-3">Rating</th>
                        <th class="px-4 py-3">Comment</th>
                       
                        <th class="px-4 py-3">Created</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($reviews as $review)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $review->id }}</td>
                        <td class="px-4 py-3 flex items-center gap-2">
                            <img src="{{ $review->user->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($review->user->name).'&color=FFFFFF&background=10B981' }}" class="w-6 h-6 rounded-full object-cover" alt="{{ $review->user->name }}">
                            <span>{{ $review->user->name }}</span>
                        </td>
                        <td class="px-4 py-3">#{{ $review->order_id }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                @for($i=0;$i<5;$i++)
                                    <svg class="w-4 h-4 {{ $i < $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>
                        </td>
                        <td class="px-4 py-3 max-w-md truncate" title="{{ $review->comment }}">{{ $review->comment }}</td>
                        
                        <td class="px-4 py-3">{{ $review->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex gap-2">
                                <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}" onsubmit="return confirm('Delete this review?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 rounded bg-red-600 text-white text-xs hover:bg-red-700">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500">No reviews found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

