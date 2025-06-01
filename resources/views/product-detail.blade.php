<!-- resources/views/product-detail.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <img src="{{ asset('images/' . $product['image']) }}" class="card-img-top" alt="{{ $product['name'] }}">
        <div class="card-body">
            <h5 class="card-title">{{ $product['name'] }}</h5>
            <p class="card-text">Harga: Rp{{ number_format($product['price'], 0, ',', '.') }}</p>
            <form action="{{ url('/add-to-cart/' . $product['id']) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
            </form>
        </div>
    </div>
</div>
@endsection
