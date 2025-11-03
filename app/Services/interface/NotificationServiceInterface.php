<?php 
namespace App\Services\interface;

use Illuminate\Http\Request;

interface NotificationServiceInterface
{
    public function index(Request $request);
    public function unreadNotification(Request $request);
    public function readNotification(Request $request);
    public function markAsRead(Request $request , $notificationId);
}