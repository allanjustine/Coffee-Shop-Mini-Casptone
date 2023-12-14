<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LogController extends Controller
{
    // public function index(){

    //     $logEntries = Log::orderBy('created_at', 'desc')->get();
    //     return view('Logs/index', ['logEntries' => $logEntries]);
    // }
    public function index()
    {
        $logEntries = Log::orderBy('created_at', 'desc')->paginate(10);

        // Format the created_at timestamps
        $logEntries->transform(function ($logEntry) {
            $logEntry->formattedCreatedAt = Carbon::parse($logEntry->created_at)->format('F-d-Y');
            return $logEntry;
        });

        return view('admin/Logs/index', ['logEntries' => $logEntries]);
    }
}
