<?php

namespace App\Services;

use App\Services\Interfaces\INotificationService;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewPost;
use App\Models\{User, Notification as NotificationModel};
use App\Http\Requests\CreateNotificationRequest;
use Illuminate\Database\Eloquent\Collection;

class NotificationService implements INotificationService
{
    /**
     * user notification list
     *
     * @param string $userId
     * @return Collection
     */
    public function userNotifications(string $userId): Collection
    {
        // get user notifications which are not expired
        return NotificationModel::with("user")->withoutExpired()->where("notifiable_id", $userId)->get();
    }

    /**
     * all notification list
     *
     * @return Collection
     */
    public function notifications(): Collection
    {
        return NotificationModel::with("user")->get();
    }

    /**
     * create new notification
     *
     * @param CreateNotificationRequest $request
     * @return boolean
     */
    public function createNotification(CreateNotificationRequest $request): bool
    {
        $users = $this->getUsers($request);
        Notification::send($users, new NewPost($request));

        return true;
    }

    /**
     * get user list who has enable notification
     *
     * @return Collection
     */
    public function usersWithEnableNotification(): Collection
    {
        return User::where("is_receive_notification", true)->get();
    }

    /**
     * mark as read perticular notification
     *
     * @param NotificationModel $notification
     * @return boolean
     */
    public function markAsReadNotification(NotificationModel $notification): bool
    {
        if ($notification) {
            $notification->markAsRead();
            return true;
        }
        return false;
    }

    /**
     * get users
     *
     * @param CreateNotificationRequest $request
     */
    private function getUsers(CreateNotificationRequest $request)
    {
        if ($request->get("destination") === "all") {
            return User::where("is_receive_notification", true)->get();
        }
        return User::findOrFail($request->get("destination"));
    }
}
