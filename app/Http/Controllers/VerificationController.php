<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify($id, Request $request) {
        if (!$request->hasValidSignature()) {
            return response()->json(["message" => "Invalid/Expired url provided."], 401);
        }
    
        $user = User::findOrFail($id);
    
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }
    
        return redirect()->to('http://localhost:3000/login');
    }

    public function resend(Request $request) {
        $user = User::where('email', $request->email)->first();
        if($user->hasVerifiedEmail()){
            return response()->json(['message' => 'Email has been verified']);
        } else {
            $user->sendEmailVerificationNotification();
            return response()->json(["message" => "Email verification link sent to your email"]);
        }
        
        // if (auth()->user()->hasVerifiedEmail()) {
        //     return response()->json(["message" => "Email already verified."], 400);
        // }
        // auth()->user()->sendEmailVerificationNotification();
    
        // return response()->json(["message" => "Email verification link sent on your email id"]);
    }
}
