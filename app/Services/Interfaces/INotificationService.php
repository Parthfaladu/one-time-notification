<?php

namespace App\Services\Interfaces;

use App\Models\{User, Notification as NotificationModel};
use App\Http\Requests\CreateNotificationRequest;
use Illuminate\Database\Eloquent\Collection;

interface INotificationService
{
    /**
     * user notification list
     *
     * @param string $userId
     * @return Collection
     */
    public function userNotifications(string $userId): Collection;

    /**
     * notification list
     *
     * @return Collection
     */
    public function notifications(): Collection;

    /**
     * create new notification
     *
     * @param CreateNotificationRequest $request
     * @return boolean
     */
    public function createNotification(CreateNotificationRequest $request): bool;

    /**
     * get user list who has enable notification
     *
     * @return Collection
     */
    public function usersWithEnableNotification(): Collection;

    /**
     * mark as read perticular notification
     *
     * @param NotificationModel $notification
     * @return boolean
     */
    public function markAsReadNotification(NotificationModel $notification): bool;
}
