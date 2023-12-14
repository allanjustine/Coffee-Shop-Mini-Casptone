<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Contact;
use App\Models\Feedback;
use App\Models\Order;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function contact()
    {
        if (auth()->check()) {
            $carts = Cart::where('user_id', '=', auth()->user()->id)->get();
        } else {
            $carts = collect();
        }
        $numOrders = Order::where('user_id', auth()->id())->with('product')->get();
        return view('normal-view.pages.contact', compact('carts', 'numOrders'));
    }

    public function contactStore(Request $request)
    {
        $request->validate([
            'name'          =>          ['required'],
            'email'         =>          ['required', 'email'],
            'message'       =>          ['required'],
        ]);

        Contact::create($request->all());

        return back()->with('message', 'Your message was sent. Thank You!');
    }

    public function about()
    {
        if (auth()->check()) {
            $carts = Cart::where('user_id', '=', auth()->user()->id)->get();
        } else {
            $carts = collect();
        }
        $numOrders = Order::where('user_id', auth()->id())->with('product')->get();
        return view('normal-view.pages.about', compact('carts', 'numOrders'));
    }
}
