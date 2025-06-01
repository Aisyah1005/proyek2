@extends('layouts.admin')

@section('title', 'Admin - Daftar Pesanan')

@section('content')
<div class="container mt-5">
    <h3>Daftar Pesanan</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                
                <th>Nama Customer</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Total Harga</th>
                <th>Status Pembayaran</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                   
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->alamat ?? '-' }}</td>
                    <td>{{ $order->no_hp ?? '-' }}</td>
                    <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-flex">
                        @csrf
                        @method('PATCH')
                        <select name="payment_status" class="form-select form-select-sm me-2">
                            <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>paid</option>
                            <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Done</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                    </form>
                    </td>
                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                    <td>
                        {{-- <a href="{{ route('#', $order->order_id) }}" class="btn btn-sm btn-primary">Lihat Detail</a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
@endsection
