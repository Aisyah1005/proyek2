<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.index', compact('products'));
    }

    public function create()
    {
        return view('admin.create');
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'category' => 'required|string', // ← penting
        'description' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Simpan gambar
    $imagePath = $request->file('image')->store('products', 'public');

    // Simpan produk
    Product::create([
        'name' => $validated['name'],
        'category' => $validated['category'], // ← tambahkan ini
        'description' => $validated['description'],
        'price' => $validated['price'],
        'image' => $imagePath,
    ]);

    return redirect()->route('products.index')->with('success', 'Product added successfully.');
}

public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string',
        'category' => 'required|string',
        'image' => 'nullable|image|max:2048',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'category' => 'required|string',
    ]);

    $data = $request->all();

    if ($request->hasFile('image')) {
        // hapus gambar lama jika ada (opsional)
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    $product->update($data);

    return redirect()->route('products.index')->with('success', 'Product updated!');
}
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('index')->with('success', 'Product deleted!');
    }
    public function publicMenu()
{
    $products = Product::all();
    return view('dashboard', compact('products'));
}
public function edit(Product $product){

    return view('admin.edit',compact ('product'));
}
}
