<?php

namespace App\Http\Controllers\NormalView;

use App\Events\UserLog;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function productList()
    {
        if (auth()->check()) {
            $carts = Cart::where('user_id', '=', auth()->user()->id)->get();
        } else {
            $carts = collect();
        }

        $allProducts = Product::orderBy('product_name', 'desc')->with('orders')->get();
        $numOrders = Order::where('user_id', auth()->id())->with('product')->get();

        return view('normal-view.pages.index', compact('allProducts', 'carts', 'numOrders'));
    }

    public function orders()
    {
        $carts = Cart::with('product')->orderBy('created_at', 'desc')->where('user_id', '=', auth()->user()->id)->get();

        $orders = Order::orderBy('created_at', 'asc')->where('user_id', auth()->id())->with('product')->paginate(10);
        $numOrders = Order::where('user_id', auth()->id())->with('product')->get();

        return view('normal-view.orders.index', compact('orders', 'carts', 'numOrders'));
    }

    public function confirmOrder(Cart $cart)
    {

        $carts = Cart::with('product')->orderBy('created_at', 'desc')->where('user_id', '=', auth()->user()->id)->get();
        $numOrders = Order::where('user_id', auth()->id())->with('product')->get();
        return view('normal-view.orders.confirm-orders', compact('cart', 'carts', 'numOrders'));
    }
    public function confirmQuantity(Product $product)
    {
        return view('normal-view.orders.confirm-quantity', compact('product'));
    }

    public function orderCreate(Request $request, Product $product)
    {
        if ($product) {

            $order = Order::create([
                'product_id'       => $request->product_id,
                'order_quantity'   => $request->order_quantity,
                'status'           => "Pending",
                'user_id'          => auth()->id()
            ]);

            $product->increment('sold', $order->order_quantity);

            $productName = $product->product_name;

            $log_entry = Auth::user()->fname . " has ordered product: " . $productName . " with the id# " . $product->id;
            event(new UserLog($log_entry));

            $cartItem = Cart::where('product_id', $request->product_id)
                ->where('user_id', auth()->id())
                ->first();

            if ($cartItem) {
                $cartItem->delete();
            }

            return redirect('/orders')->with('message', 'Ordered successfully');
        } else {
            return back()->with('error', 'Product not found. Please try again.');
        }
    }

    public function cancelled(Order $order)
    {
        $product = $order->product;
        $product->decrement('sold', $order->order_quantity);

        $order->delete();
        $productName = $product->product_name;

        $log_entry = Auth::user()->fname . " has cancelled order: " . $productName . " with the id# " . $order->id;
        event(new UserLog($log_entry));

        return redirect('/orders')->with('message', 'Order cancelled successfully');
    }

    public function searchProduct(Request $request)
    {
        $search = $request->search;
        $carts = Cart::with('product')->orderBy('created_at', 'desc')->where('user_id', '=', auth()->user()->id)->get();
        $numOrders = Order::where('user_id', auth()->id())->with('product')->get();

        $products = Product::where('product_name', 'like', "%$search%")
            ->orWhere('price', 'like', "%$search%")->orderBy('product_name', 'desc')->get();

        return view('normal-view.pages.searched', compact('search', 'products', 'carts', 'numOrders'));
    }
}
