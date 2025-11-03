<?php 
namespace App\Services;

use App\Repositories\interface\RequestRepositoryInterface;
use App\Services\interface\NotificationServiceInterface;
use Illuminate\Http\Request;

class NotificationService implements NotificationServiceInterface{
    public function __construct(protected RequestRepositoryInterface $requestRepository){}
    public function index(Request $request){
        $notifications = $request->user()->notifications;
        $final_notifications = [];
        foreach ($notifications as $notification) {
            if ($this->requestRepository->checkById($notification->data['request_id'])) {
                $final_notifications[] = $notification;
            }
        }
        return ['data' => $final_notifications, 'message' => 'Notifications Retrieved Success', 'status' => 200];
    }

    public function unreadNotification(Request $request){
        $notifications = $request->user()->unreadNotifications;
        return ['data' => $notifications , 'message' => 'Notifications Retrieved Success' , 'status' => 200];
    }

    public function readNotification(Request $request){
        $notifications = $request->user()->readNotifications;
        return ['data' => $notifications , 'message' => 'Notifications Retrieved Success' , 'status' => 200];
    }

    public function markAsRead(Request $request , $notificationId){
        $notification = $request->user()->notifications()->find($notificationId);
        $notification->markAsRead();
        return ['data' => $notification , 'message' => 'Notification Marked As Read' , 'status' => 200];
    }
}