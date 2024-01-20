<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserLog;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $users = User::has('orders')->orderBy('created_at', 'asc')->paginate(10);
        return view('admin.orders.index', compact('users'));
    }

    public function manageOrders(Request $request, $id)
    {
        // $statusUpdated = $request->status;

        // // Validate the provided status against expected values
        // $validStatuses = ['Pending', 'Preparing', 'Ongoing delivery', 'Delivered'];
        // if (!in_array($statusUpdated, $validStatuses)) {
        //     return back()->with('error', 'Invalid status provided');
        // }

        // // Check the current status and update accordingly
        // if ($statusUpdated == "Pending") {
        //     $statusUpdated = "Preparing";
        // } elseif ($statusUpdated == "Preparing") {
        //     $statusUpdated = "Ongoing delivery";
        // } elseif ($statusUpdated == "Ongoing delivery") {
        //     $statusUpdated = "Delivered";
        // } elseif ($statusUpdated == "Delivered") {
        //     $statusUpdated = "Paid";
        // }

        $order = Order::find($id);

        if(!$order) {
            return back()->with('error', 'No order available');
        } else {
            // Update the order status
        $order->update([
            'status'        =>      $request->status,
        ]);
        }



        $log_entry = Auth::user()->lname . " marked as " . $order->status . " for " .  $order->user->fname . "'s order. " . " with the id# " . $order->id;
        event(new UserLog($log_entry));

        return back()->with('message', 'Successfully marked as ' . $order->status);
    }


    public function searchOrder(Request $request)
    {
        $search = $request->search;

        $users = User::has('orders')->withCount('orders')->where(function ($query) use ($search) {
            $query->where('lname', 'like', "%$search%")
                ->orWhere('fname', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('phone', 'like', "%$search%")
                ->orWhere('gender', 'like', "%$search%")
                ->orWhere('address', 'like', "%$search%");
        })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.orders.searched', compact('users', 'search'));
    }

    public function createOrder()
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'Admin');
        })->get();
        $products = Product::all();
        return view('admin.orders.create', compact('users', 'products'));
    }
    public function createOrderNow(Request $request)
    {
        $request->validate([
            'product_id'       => ['required'],
            'status'           => ['required'],
            'order_quantity'   => ['required', 'numeric', 'min:1'],
            'user_id'          => ['required']
        ]);

        $product = Product::find($request->product_id);

        if (!$product) {
            return back()->with('error', 'Product not found. Please try again.');
        }
        $order = Order::create([
            'product_id'       => $request->product_id,
            'status'           => $request->status,
            'order_quantity'   => $request->order_quantity,
            'user_id'          => $request->user_id
        ]);
        $product->increment('sold', $order->order_quantity);

        $productName = $product->product_name;

        $log_entry = Auth::user()->lname . " has ordered a product: " . $productName . " for " . $order->user->fname . " with the id# " . $order->id;
        event(new UserLog($log_entry));

        return redirect('/admin/orders')->with('message', 'Successfully ordered a product: ' . $productName . ' for '  . $order->user->fname);
    }
}
