<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User as UserModel;

class User extends JsonResource
{
    /**
     * @param $user
     * @return array
     */
    public function toArray($user): array
    {
        return [
            'id'                      => $user->id,
            'email'                   => $user->email,
            'name'                    => $user->name,
            'is_receive_notification' => $user->is_receive_notification,
            'phone_number'            => $user->phone_number,
            'email_verified'          => $user->hasVerifiedEmail(),
        ];
    }
}
