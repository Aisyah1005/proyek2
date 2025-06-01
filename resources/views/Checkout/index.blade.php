@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container mt-5">
    <h2>Checkout</h2>

    <p>Silakan klik tombol di bawah untuk melanjutkan ke pembayaran.</p>

    <button id="pay-button" class="btn btn-success">Bayar Sekarang</button>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}">
    </script>

    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("Pembayaran sukses!");
                    window.location.href = "{{ route('dashboard') }}";
                },
                onPending: function(result) {
                    alert("Menunggu pembayaran...");
                    window.location.href = "{{ route('dashboard') }}";
                },
                onError: function(result) {
                    alert("Terjadi kesalahan saat pembayaran.");
                },
                onClose: function() {
                    alert('Popup ditutup.');
                }
            });
        };
    </script>
</div>
@endsection
