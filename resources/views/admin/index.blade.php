@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mt-6 mb-4">
        <h2 class="text-2xl font-semibold">Product List</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Add New Product
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2 text-left">Image</th>
                    <th class="border px-4 py-2 text-left">Name</th>
                    <th class="border px-4 py-2 text-left">Category</th>
                    <th class="border px-4 py-2 text-left">Price</th>
                    <th class="border px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Image" width="80" class="rounded object-cover">
                            @else
                                <span class="text-gray-500">No Image</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2">{{ $product->name }}</td>
                        <td class="border px-4 py-2">{{ $product->category }}</td>
                        <td class="border px-4 py-2">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="border px-4 py-2 space-x-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4 text-gray-500">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
