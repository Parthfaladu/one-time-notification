<?php

namespace App\Services\Interfaces;

use App\Http\Requests\UpdateUserSettingsRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface IUserService
{
    /**
     * user list with unread notification count
     *
     * @return Collection
     */
    public function users(): Collection;

    /**
     * update user settings
     *
     * @param UpdateUserSettingsRequest $request
     * @param User $user
     * @return boolean
     */
    public function updateUserSettings(UpdateUserSettingsRequest $request, User $user): bool;

    /**
     * user detail with notification
     *
     * @param string $userId
     * @return User
     */
    public function userWithNotification(string $userId): User;
}
