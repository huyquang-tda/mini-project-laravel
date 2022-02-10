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

        if($email->fails()){
            return response()->json($email->errors(), 400);
        }

        $status = Password::sendResetLink($email->validated());
        if($status === Password::RESET_LINK_SENT){
            return response()->json(['success' => __($status)], 200);
        }

        return response()->json(['error' => __($status)], 400);
    }


    public function reset(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        
        $status = Password::reset($validator->validated(), function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        if($status === Password::INVALID_TOKEN){
            return response()->json(['error' => __($status)], 400);
        }

        return response()->json(['success' => 'Password successfully reset']);
    }
}
