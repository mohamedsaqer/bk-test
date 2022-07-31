<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $authUser = Auth::user();
            $success['token'] = $authUser->createToken('MyAuthApp')->plainTextToken;
            $success['name'] = $authUser->name;

            return response()->json([
                'success' => true,
                'data' => $success,
                'message' => 'User signed in',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Unauthorised',
                'message' => 'Unauthorised.',
            ], 400);
        }
    }
}
