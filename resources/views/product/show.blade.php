{{-- resources/views/product/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product['name'] }}</h1>
    <p>Harga: Rp{{ number_format($product['price'], 0, ',', '.') }}</p>
    <img src="{{ asset('images/' . $product['image']) }}" alt="{{ $product['name'] }}" style="max-width: 300px;">
    <p>{{ $product['description'] }}</p>
</div>
@endsection

