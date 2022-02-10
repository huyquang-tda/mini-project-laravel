<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    public function forgot(Request $request){
        $email = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink($email->validated());

        return response()->json(['message' => __($status)]);
    }

    public function reset(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        $status = Password::reset($validator->validated(), function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        if($status === Password::INVALID_TOKEN){
            return response()->json(['message' => __($status)], 400);
        } else {
            return response()->json(['message' => __($status)], 200);
        }
    }
}
