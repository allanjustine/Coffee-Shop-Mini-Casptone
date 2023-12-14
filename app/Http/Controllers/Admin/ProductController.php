<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserLog;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function searchProduct(Request $request)
    {
        $search = $request->search;

        $products = Product::where(function ($query) use ($search) {
            $query->where('product_name', 'like', "%$search%")
                ->orWhere('price', 'like', "%$search%")
                ->orWhere('sold', 'like', "%$search%");
        })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.products.searched', compact('products', 'search'));
    }

    public function index(Product $product)
    {
        $products = Product::orderBy('created_at', 'asc')->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_image'            =>          ['required', 'max:10000'],
            'product_name'             =>          ['required'],
            'price'                    =>          ['required', 'numeric', 'min:1']
        ]);

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');

            $imageFileName = Str::random(20) . '.' . $image->getClientOriginalExtension();

            $image->storeAs('images/coffee_pictures', $imageFileName, 'public');

            $imagePath = 'images/coffee_pictures/' . $imageFileName;
        }

        $product = Product::create([
            'product_image'            =>          $imagePath,
            'product_name'             =>          $request->product_name,
            'price'                    =>          $request->price
        ]);

        $log_entry = Auth::user()->fname . " added a new product: " . $product->product_name . " with the id# " . $product->id;
        event(new UserLog($log_entry));

        return redirect('/admin/products')->with('message', 'Product detail added successfully');
    }

    public function updateProduct(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_image'            =>          ['max:10000'],
            'product_name'             =>          ['required'],
            'price'                    =>          ['required', 'numeric', 'min:1']
        ]);

        $imagePath = $product->product_image;

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');

            $imageFileName = Str::random(20) . '.' . $image->getClientOriginalExtension();

            $image->storeAs('images/product_pictures', $imageFileName, 'public');

            $imagePath = 'images/product_pictures/' . $imageFileName;

            if ($product->product_image && !Str::contains($product->product_image, '3237155-200.png')) {
                Storage::disk('public')->delete($product->product_image);
            }
        }

        $product->update([
            'product_image'            =>          $imagePath,
            'product_name'             =>          $request->product_name,
            'price'                    =>          $request->price
        ]);

        $log_entry = Auth::user()->fname . " updated the product: " . $product->product_name . " with the id# " . $product->id;
        event(new UserLog($log_entry));

        return redirect('/admin/products')->with('message', 'Product updated successfully');
    }

    public function delete(Product $product)
    {
        $log_entry = Auth::user()->fname . " deleted the product " . $product->product_name .  " with the id# " . $product->id;
        event(new UserLog($log_entry));

        if ($product->product_image && !Str::contains($product->product_image, 'no-image.png')) {
            Storage::disk('public')->delete($product->product_image);
        }

        $product->delete();

        return redirect('/admin/products')->with('message', 'Product detail deleted successfully');
    }
}
