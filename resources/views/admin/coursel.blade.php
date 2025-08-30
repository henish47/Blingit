@extends('admin.layout')

@section('title', 'Manage Banners')

@section('content')
<div class="container mx-auto px-4 py-8 space-y-12">

    {{-- Form to Add New Banner --}}
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-yellow-200">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-4">Add New Carousel Banner</h1>

        {{-- Display Success/Error Messages --}}
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6" role="alert">
                <p class="font-bold">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6" role="alert">
                 <p class="font-bold">Please fix the following errors:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Banner Image Upload -->
            <div>
                <label for="image_url" class="block text-gray-700 text-sm font-bold mb-2">Banner Image (Recommended: 1200x400px)</label>
                <input type="file" id="image_url" name="image_url" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" required>
            </div>

            <!-- Alt Text -->
            <div>
                <label for="alt_text" class="block text-gray-700 text-sm font-bold mb-2">Alternative Text (for SEO & Accessibility)</label>
                <input type="text" id="alt_text" name="alt_text" placeholder="e.g., Fresh vegetables special offer" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500" value="{{ old('alt_text') }}">
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Order -->
                <div>
                    <label for="order_column" class="block text-gray-700 text-sm font-bold mb-2">Display Order</label>
                    <input type="number" id="order_column" name="order_column" placeholder="e.g., 1" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500" value="{{ old('order_column', 0) }}">
                    <p class="text-gray-600 text-xs italic mt-1">Banners will be shown in ascending order (1, 2, 3...)</p>
                </div>

                <!-- Status -->
                <div>
                    <label for="is_active" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                    <select id="is_active" name="is_active" class="shadow-sm border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end pt-4">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300">
                    Add Banner
                </button>
            </div>
        </form>
    </div>

    {{-- Table to Display Existing Banners --}}
    <div class="max-w-7xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-yellow-200">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Existing Banners</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alt Text</th>
                        <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="py-3 px-6 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($banners as $banner)
                        <tr>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <img src="{{ asset('storage/' . $banner->image_url) }}" alt="{{ $banner->alt_text }}" class="w-40 h-16 object-cover rounded-md">
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-800">{{ $banner->alt_text ?? '-' }}</td>
                            <td class="py-4 px-6 whitespace-nowrap text-center text-sm text-gray-500">{{ $banner->order_column }}</td>
                            <td class="py-4 px-6 whitespace-nowrap text-center">
                                @if ($banner->is_active)
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this banner?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 px-6 text-center text-gray-500">
                                No banners found. Add one using the form above.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
