<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminIndexController extends Controller
{
    public function adminDashboard()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(5);
        $logs = Log::orderBy('created_at', 'desc')->latest()->paginate(10);
        return view('admin.pages.dashboard', compact('logs', 'orders'));
    }
}
