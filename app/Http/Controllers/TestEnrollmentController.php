<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TestEnrollment;
use App\Models\User;


class TestEnrollmentController extends Controller
{
    public function sendTestNotification()
    {
        $data = [
        'body'             => 'You recieved a new text notification.',
        'enrollmentText'   => 'You are allowed to enroll',
        'url'              => url('/'),
        'thankyou'       => 'You have 14 days to enroll',

    ];
    $user = User::first();

    // $user-> User::notify(new TestEnrollment($data));
     Notification::send($user, new TestEnrollment($data));
  }
}
