<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    use HasApiTokens , HttpResponses;

    public function login(LoginRequest $request)
    {
    $validatedData = $request->validate($request->rules());

    if (!Auth::attempt($validatedData)) {
        return $this->error(' ', 'Credentials do not match', 401);
    }

    $user = User::where('email', $validatedData['email'])->first();

    return $this->success([
        'user' => $user,
        'token' => $user->createToken('NEW API Token of user ' . $user->name)->plainTextToken,
    ]);
}

    public function register(StoreUserRequest $request)
    {
        $validatedData = $request->validated();
    
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);
    
        $token = $user->createToken('Api Token of ' . $user->name)->plainTextToken;
    
        return $this->success ([
            'user' => $user,
            'token' => $token,
        ]);
    }
    
    
    public function logout(){

        if (Auth::check()) {
            Auth::user()->currentAccessToken()->delete();
        }
            return $this->success([
            'message' => 'Logout Successfully',
        ]);

    }

}
