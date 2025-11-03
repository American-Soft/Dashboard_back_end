<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\interface\NotificationServiceInterface;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    use ApiResponse;

    public function __construct(protected NotificationServiceInterface $notificationService){}

    public function index(Request $request){
        $result = $this->notificationService->index($request);
        return $this->successResponse($result['data'],$result['message'],$result['status']);
    }

    public function unreadNotification(Request $request){
        $result = $this->notificationService->unreadNotification($request);
        return $this->successResponse($result['data'],$result['message'],$result['status']);
    }

    public function readNotification(Request $request){
        $result = $this->notificationService->readNotification($request);
        return $this->successResponse($result['data'],$result['message'],$result['status']);
    }

    public function markAsRead(Request $request , $notificationId){
        $result = $this->notificationService->markAsRead($request , $notificationId);
        return $this->successResponse($result['data'],$result['message'],$result['status']);
    }
}
