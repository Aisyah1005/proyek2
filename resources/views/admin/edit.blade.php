@extends('layouts.admin')
@section('content')
        <h2 class="font-semibold text-xl">Edit Product</h2>

    <div class="py-6 max-w-lg mx-auto">
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium">Name</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">Category</label>
                <input type="text" name="category" value="{{ old('category', $product->category) }}" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">Current Image</label><br>
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Image" width="150" class="rounded mb-2">
                @else
                    No Image
                @endif
            </div>

            <div>
                <label class="block font-medium">Change Image</label>
                <input type="file" name="image" accept="image/*" class="w-full">
            </div>

            <div>
                <label class="block font-medium">Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $product->description) }}</textarea>
            </div>

            <div>
                <label class="block font-medium">Price</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <button type="submit" class="bg-green-600 text-white rounded px-4 py-2">Update</button>
                <a href="{{ route('products.index') }}" class="ml-4 text-gray-600">Cancel</a>
            </div>
        </form>
    </div>
@endsection