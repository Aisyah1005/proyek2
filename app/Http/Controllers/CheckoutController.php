<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Proses checkout dan panggil Midtrans Snap
     */
    public function process(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'selected_items' => 'required|array',
        ]);

        $userId = Auth::id();
        $selectedItemIds = $request->input('selected_items');

        $cartItems = Cart::with('product')
            ->where('user_id', $userId)
            ->whereIn('id', $selectedItemIds)
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Tidak ada item yang valid untuk checkout.');
        }

        $total = 0;
        $items = [];

        foreach ($cartItems as $item) {
            $subtotal = $item->product->price * $item->quantity;
            $total += $subtotal;
            $items[] = [
                'id' => (string) $item->product->id,
                'price' => (int) $item->product->price,
                'quantity' => (int) $item->quantity,
                'name' => substr($item->product->name, 0, 50),
            ];
        }

        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $orderId = 'ORDER-' . uniqid();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => $request->no_hp,
            ],
            'item_details' => $items,
        ];

        $snapToken = Snap::getSnapToken($params);

        $order = Order::create([
            'user_id' => $userId,
            'total_price' => $total,
            'payment_token' => $snapToken,
            'payment_status' => 'pending',
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        Cart::whereIn('id', $selectedItemIds)->delete();

     
    return view('checkout.index', compact('snapToken'));
}

    /**
     * Tampilkan daftar pesanan di halaman admin
     */
    public function index()
    {
        $orders = Order::with('user', 'items.product')->latest()->paginate(10);
        return view('cart.checkout', compact('orders'));
    }

    /**
     * Tampilkan detail pesanan
     */
    public function show($orderId)
    {
        $order = Order::where('order_id', $orderId)
            ->with('user', 'items.product')
            ->firstOrFail();

        return view('/', compact('order'));
    }
    public function update(Request $request)
{
    $request->validate([
        'alamat' => 'required|string|max:255',
        'no_hp' => 'required|string|max:20',
    ]);

    // Ambil order terakhir user yang statusnya pending
    $order = Order::where('user_id', Auth::id())
                  ->where('payment_status', 'pending')
                  ->latest()
                  ->first();

    if (!$order) {
        return response()->json(['error' => 'Order tidak ditemukan.'], 404);
    }

    $order->alamat = $request->alamat;
    $order->no_hp = $request->no_hp;
    $order->save();

    return response()->json(['success' => true]);
}
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed',
        ]);

        $order->payment_status = $request->payment_status;
        $order->save();

        return back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }
    
}