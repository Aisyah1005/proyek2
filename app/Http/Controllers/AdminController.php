<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // ← ini yang penting

class AdminController extends Controller
{
    public function dashboard()
{
    return view('admin.dashboard2', [
        'users' => User::all()
    ]);
}
    public function pesanan()
{
    // Contoh ambil semua pesanan dari database
    $orders = \App\Models\Order::all(); // pastikan model Order ada
    return view('admin.pesanan', compact('orders'));
}

}
