<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class UserController extends Controller
{
    public function register(UserRequest $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json([
                'status' => 202,
                'message' => 'Utilisateur cree',
                'user' => $user
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Utilisteur non cree',
                'erreur' => $e,
            ]);
        }
    }

    public function login(LoginRequest $request)
    {

        if (Auth::attempt($request->only(['email', 'password']))) {
            $user = Auth::user();
            $token = $user->createToken('MFA_KEY')->plainTextToken;
            return response()->json([
                'status' => 200,
                'message' => 'user connecte ',
                'user ' => $user,
                'token' => $token
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Connexion echouee ',

            ]);
        }
    }
}
