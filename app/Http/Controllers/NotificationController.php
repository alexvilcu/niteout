<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use Notification;

class NotificationController extends Controller
{
    public function view_notifications()
    {
        $user = Auth::user();
        return view('notifications.index', ['user' => $user]);

    }

    public function mark_as_read($id)
    {
    	$user = Auth::user();
    	$notification = $user->notifications()->where('id', $id)->first();
    	if ($notification) {
    		$notification->delete();
    		flash('Marked as read');
    		return redirect()->back();
    	} else {
    		flash('Error occured');
    		return redirect()->back();
    	}

    }
}
