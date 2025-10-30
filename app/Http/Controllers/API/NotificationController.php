<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    use ApiResponse;
    public function index(Request $request){
        $notifications = $request->user()->notifications;
        return $this->successResponse($notifications , 'Notifications Retrieved Success' , 200);
    }

    public function unreadNotification(Request $request){
        $notifications = $request->user()->unreadNotifications;
        return $this->successResponse($notifications , 'Notifications Retrieved Success' , 200);
    }

    public function readNotification(Request $request){
        $notifications = $request->user()->readNotifications;
        return $this->successResponse($notifications , 'Notifications Retrieved Success' , 200);
    }

    public function markAsRead(Request $request , $notificationId){
        $notification = $request->user()->notifications()->find($notificationId);
        $notification->markAsRead();
        return $this->successResponse($notification , 'Notification Marked As Read' , 200);
    }
}
