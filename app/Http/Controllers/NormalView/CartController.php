<?php

namespace App\Http\Controllers\NormalView;

use App\Events\UserLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->check()) {
            $carts = Cart::with('product')->orderBy('created_at', 'desc')->where('user_id', '=', auth()->user()->id)->get();
        }
        $numOrders = Order::where('user_id', auth()->id())->with('product')->get();

        return view('normal-view.carts.index', compact('carts', 'numOrders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addToCart(Request $request)
    {

        if (!Product::where('id', $request->product_id)->exists()) {
            return back()->with('error', 'Sorry this product was deleted or not available, please select another one');
        } else {
            $userId = auth()->user()->id;
            $productId = $request->product_id;

            $existingCart = Cart::where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if ($existingCart) {
                $existingCart->update([
                    'cart_quantity' => $existingCart->cart_quantity + 1,
                ]);

                $log_entry = Auth::user()->fname . " added the quantity of product: " . $existingCart->product->product_name . " in cart " . " with the id# " . $existingCart->id;
                event(new UserLog($log_entry));

                return redirect('/carts')->with('message', 'Added to cart');
            } else {
                $cart = Cart::create([
                    'product_id' => $productId,
                    'user_id' => $userId,
                    'cart_quantity' => 1,
                ]);

                $log_entry = Auth::user()->fname . " added a product: " . $cart->product->product_name . " to cart " . " with the id# " . $cart->id;
                event(new UserLog($log_entry));

                return redirect('/carts')->with('message', 'Added to cart');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        return view('normal-view.carts.edit', compact('cart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);

        $request->validate([
            'cart_quantity'         =>          ['required', 'numeric', 'min:1']
        ]);

        if (!$cart) {
            return back()->with('error', 'The cart item you selected not found');
        } else {
            $cart->update([
                'cart_quantity'         =>          $request->cart_quantity
            ]);
        }

        $log_entry = Auth::user()->fname . " update a quantity of product: " . $cart->product->product_name . " from cart " . " with the id# " . $cart->id;
        event(new UserLog($log_entry));

        return redirect('/carts')->with('message', 'Item quantity updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return back()->with('error', 'No cart item to delete');
        } else {
            $cart->delete();
        }

        $log_entry = Auth::user()->fname . " Deleted product: " . $cart->product->product_name . " from cart " . " with the id# " . $cart->id;
        event(new UserLog($log_entry));

        return redirect('/carts')->with('message', 'Cart item deleted');
    }
}
