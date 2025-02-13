<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json(['token' => $user->createToken('API Token')->plainTextToken], 201);
    }

    public function login(Request $request)
    {
        // Validation de la requête
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Vérification si l'utilisateur souhaite rester connecté
        $remember_me = $request->has('remember_me') ? true : false;
    
        // Tentative de connexion
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me)) {
            // Authentification réussie, retourner le token
            return response()->json(['token' => Auth::user()->createToken('API Token')->plainTextToken]);
        } else {
            // Authentification échouée
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function me(Request $request) {
        return response()->json($request->user());
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}