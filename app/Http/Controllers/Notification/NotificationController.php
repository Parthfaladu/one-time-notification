<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse, RedirectResponse};
use Illuminate\View\View;
use App\Models\{User, Notification as NotificationModel};
use App\Services\Interfaces\INotificationService;
use App\Http\Requests\CreateNotificationRequest;
use DataTables;

class NotificationController extends Controller
{
    protected $notificationService;

    /**
     * Undocumented function
     *
     * @param INotificationService $notificationService
     */
    public function __construct(INotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * user notification list
     *
     * @param Request $request
     * @param string $userId
     * @return JsonResponse
     */
    public function userNotifications(Request $request, string $userId): JsonResponse
    {
        $notifications = $this->notificationService->userNotifications($userId);

        return response()->json($notifications);
    }

    /**
     * notification list view
     *
     * @param Request $request
     * @return View
     */
    public function notificationList(Request $request): View
    {
        return view("notification.notification-list");
    }

    /**
     * notification list for datatable
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function notificationDt(Request $request): JsonResponse
    {
        $notifications = $this->notificationService->notifications();

        return Datatables::of($notifications)->make(true);
    }

    /**
     * create new notification
     *
     * @param CreateNotificationRequest $request
     * @return RedirectResponse
     */
    public function createNotification(CreateNotificationRequest $request): RedirectResponse
    {
        $this->notificationService->createNotification($request);

        return redirect()->to("/notification");
    }

    /**
     * post notification view
     *
     * @param Request $request
     * @return View
     */
    public function postNotification(Request $request): View
    {
        $users = $this->notificationService->usersWithEnableNotification();

        return view("notification.notification-post", compact("users"));
    }

    /**
     * mark as read perticular notification
     *
     * @param Request $request
     * @param NotificationModel $notification
     * @return JsonResponse
     */
    public function markAsReadNotification(Request $request, NotificationModel $notification): JsonResponse
    {
        $result = $this->notificationService->markAsReadNotification($notification);

        return response()->json($result);
    }
}
