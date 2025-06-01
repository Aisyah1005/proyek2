@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">Keranjang Anda</h2>

    @if(count($cartItems) > 0)
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2">Produk</th>
                    <th class="p-2">Harga</th>
                    <th class="p-2">Jumlah</th>
                    <th class="p-2">Subtotal</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cartItems as $item)
                    @php
                        $subtotal = $item->product->price * $item->quantity;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td class="p-2">{{ $item->product->name }}</td>
                        <td class="p-2">Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                        <td class="p-2">{{ $item->quantity }}</td>
                        <td class="p-2">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        <td class="p-2">
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr class="font-bold">
                    <td colspan="3" class="p-2 text-right">Total:</td>
                    <td class="p-2">Rp {{ number_format($total, 0, ',', '.') }}</td>
                    <td>    
                        <form method="POST" action="{{ route('checkout.process') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" required class="w-full p-2 border rounded" placeholder="Alamat lengkap..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp">No HP</label>
                            <input type="text" name="no_hp" required class="w-full p-2 border rounded" placeholder="08xxxxx...">
                        </div>

                        <h3 class="mt-4 mb-2 font-semibold">Pilih Item:</h3>
                        @foreach ($cartItems as $item)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" class="mr-2" checked>
                                {{ $item->product->name }} ({{ $item->quantity }} x Rp{{ number_format($item->product->price, 0, ',', '.') }})
                            </div>
                        @endforeach

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-3">Lanjutkan ke Pembayaran</button>
                    </form>
                    </td>
                </tr>
            </tbody>
        </table>
    @else
        <p>Keranjang kosong.</p>
    @endif
</div>
@endsection
