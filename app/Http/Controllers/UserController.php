<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login($login, $pwd)
    {
        $user = User::where([
            ['email', '=', $login],
            ['password', '=', $pwd]
        ])->first();

        return response()->json(['success' => $user != null]);
    }
}
