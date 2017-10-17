<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function login($login, $pwd)
    {
        $user = User::where([
            ['name', $login],
            ['password', $pwd]
        ])->first();

        if($user != null)
            return response()->json(['success' => true, 'id_user' => $user->id]);
        else
            return response()->json(['success' => false]);
    }

    public function signup($mail, $username, $password)
    {
        $_user = User::where('name', $username)->get();
        $email = User::Where('email', $mail)->get();

        if(!$_user->count() && !$email->count()) {
            $user = new User();
            $user->name = $username;
            $user->email = $mail;
            $user->password = $password;

            $user->save();

            $max_id = User::max('id');

            return response()->json(['success' => true, 'id_user' => $max_id]);
        } else {
            return response()->json([
                'success' => false,
                'existLogin' => $_user->count() > 0,
                'existMail' => $email->count() > 0
            ]);
        }
    }
}
