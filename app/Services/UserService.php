<?php

namespace App\Services;

use App\Services\Interfaces\IUserService;
use App\Http\Requests\UpdateUserSettingsRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService implements IUserService
{
    /**
     * user list with unread notification count
     *
     * @return Collection
     */
    public function users(): Collection
    {
        // users with unread notification count
        return User::withCount("unreadNotificationsWithoutExpired")->get();
    }

    /**
     * update user settings
     *
     * @param UpdateUserSettingsRequest $request
     * @param User $user
     * @return boolean
     */
    public function updateUserSettings(UpdateUserSettingsRequest $request, User $user): bool
    {
        $user->is_receive_notification = $request->get("isSendNotification");
        $user->phone_number            = $request->get("phoneNumber");
        $user->email                   = $request->get("email");
        $user->save();

        return true;
    }

    /**
     * user detail with notification
     *
     * @param string $userId
     * @return User
     */
    public function userWithNotification(string $userId): User
    {
        // get user detail with notification
        return User::with("notifications")->findOrFail($userId);
    }
}
