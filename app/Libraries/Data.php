<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Auth;

final class Data
{

    private static $currentUser;


    public static function getCurrentUser()
    {
        if (!self::$currentUser) {
            self::$currentUser = Auth::user();
        }

        return self::$currentUser;
    }
}