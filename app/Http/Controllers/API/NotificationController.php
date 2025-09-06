<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Traits\SendNotificationTrait;
use App\Http\Resources\NotificationResource;
use App\Notifications\AppNotification;

class NotificationController extends Controller
{
    use ApiResponseTrait;


    public function index()
    {
        $user = auth()->user();

        $notificationsToday = $user->notifications()->whereDate('created_at', now())->latest()->get();
        $notificationsYesterday = $user->notifications()->whereDate('created_at', now()->subDay())->latest()->get();

        $data = [
            'today' => NotificationResource::collection($notificationsToday),
            'yesterday' => NotificationResource::collection($notificationsYesterday),
        ];

        return $this->ApiResponse($data, 'success', 200);
    }

    public function delete($id)
    {
        $notify = auth()->user()->notifications()->find($id);

        if (!$notify) {
            return $this->notFoundResponse();
        }

        $notify->delete();

        return $this->ApiResponse(null, __('Delete Notification Successfully'), 200);
    }
    public function deleteAll()
    {
        $user = auth()->user();

        if ($user->notifications()->count() === 0) {
            return $this->notFoundResponse();
        }

        $user->notifications()->delete();

        return $this->ApiResponse(null, __('Delete All Notifications Successfully'), 200);
    }


    public function send()
    {
        $user = auth()->user();

        $data = [
            'name_ar' => 'تجربة',
            'name_en' => 'Test',
            'body_ar' => 'رسالة تجربة',
            'body_en' => 'Test message',
            'photo'   => str_replace(' ', '%20', asset('storage/' . getSetting('logo'))),
        ];

        $user->notify(new AppNotification($data));


        return $this->ApiResponse(null, __('Send Notification Successfully'), 200);
    }
}
