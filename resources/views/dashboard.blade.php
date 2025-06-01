@extends('layouts.app') {{-- Ganti dengan layout customer milikmu jika berbeda --}}

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-6">Menu Dimsum</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($products as $product)
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top">
                    <div class="card-body">
                    <h3 class="text-lg font-semibold mt-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mt-1">{{ $product->category }}</p>
                    <p class="mt-2">{{ $product->description }}</p>
                    <p class="mt-2 font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit">Tambah ke Keranjang</button>
                    </form>

                    </div>
                </div>
            </div>
            @empty
                <p>Tidak ada produk tersedia.</p>
            @endforelse
        </div>
    </div>
@endsection
