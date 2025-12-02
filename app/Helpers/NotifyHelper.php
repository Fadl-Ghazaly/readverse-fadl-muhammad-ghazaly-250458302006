<?php

namespace App\Helpers;

use App\Models\Notification;

class NotifyHelper
{
    public static function send($userId, $type, $message, $link = null)
    {
        Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'message' => $message,
            'link' => $link,
        ]);
    }
}
