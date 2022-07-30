<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;
use Carbon\Carbon;

class Notification extends DatabaseNotification
{
    /**
     * Get the user which has notification
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'notifiable_id');
    }

    /**
     * Scope a query to without expired notifications.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithoutExpired($query)
    {
        return $query->where("expire_at", ">", Carbon::now()->format("Y-m-d"));
    }
}
