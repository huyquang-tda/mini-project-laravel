<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $users = User::latest()->get();

        return response()->json(['users' => $users], 200);
    }
    
    public function show($id){
        $user = User::find($id);
        if(! $user){
            return response()->json(['message' => 'User Not Found'], 400);
        }
        return response()->json(['user' => $user], 200);
    }

    public function destroy($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            return response()->json(['message' => 'User deleted successfully'], 200);
        }

        return response()->json(['message' => 'User Not Found'], 400);
    }
}
