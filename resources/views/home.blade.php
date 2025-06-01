@extends('layouts.app')

@section('content')
    {{-- Banner --}}
    <div class="logo-wrapper d-flex justify-content-center align-items-center" style="height: 30vh;">
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo Dimsum Lindy" style="max-width: 400px;">
    </div>
    

{{-- Menu Favorit --}}
<h4 class="mb-3">Menu Favorit</h4>
<div class="row row-cols-1 g-3 mb-4">
    @foreach($favorites as $product)
    <div class="col">
        <div class="card flex-row align-items-center shadow-sm p-2">
            <img src="{{ asset('images/menu1.jpg') }}" 
                 class="img-fluid" 
                 style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; margin-right: 15px;"
                 alt="{{ $product->name }}">
            <div class="card-body p-2">
                <h6 class="card-title mb-0">{{ $product->name }}</h6>
            </div>
        </div>
    </div>
    @endforeach
</div>

    {{-- Carousel Promo --}}
    <div class="mb-5">
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('images/menu1.jpg') }}" class="d-block w-100" alt="Promo">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/promo2.jpg') }}" class="d-block w-100" alt="Promo 2">
                </div>
            </div>
        </div>
    </div>

    {{-- Menu Terbaru --}}
    <h4 class="mb-3">Menu Terbaru</h4>
    <div class="row row-cols-2 row-cols-md-4 g-3 mb-5">
        @for($i = 0; $i < 4; $i++)
        <a href="{{ route('product.show', $i) }}">
    <div class="col">
        <div class="card h-100 shadow-sm">
            <img src="{{ asset('images/menu3.jpg') }}" class="card-img-top" alt="Dimsum">
            <div class="card-body text-center">
                <h6 class="card-title">Dimsum Baru</h6>
            </div>
        </div>
    </div>
</a>
@endfor

    </div>

    {{-- Berita Dimsum --}}
    <h4 class="mb-3">PROMO PROMOOO!!!!</h4>
    <div class="row row-cols-1 row-cols-md-3 g-3">
        @for($i = 0; $i < 2; $i++)
        <a href='#'>
        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('images/promo1.jpg') }}" class="card-img-top" alt="Berita">
                <div class="card-body">
                    <h6 class="card-title">Promo Dimsum</h6>
                    <p class="card-text">Buruannn ada promo di Dimsum Lindy lohh!!.</p>
                </div>
            </div>
        </div>
        @endfor
    </div>
</a>
@endsection

