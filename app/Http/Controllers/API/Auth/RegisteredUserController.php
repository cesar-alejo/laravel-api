<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Auth\Events\Registered;
//use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
//use Illuminate\View\View;

use App\Models\User;

class RegisteredUserController extends Controller
{
    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:50', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('authToken')->plainTextToken;

            $data = [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ];

            return response()->json(['status' => true, 'data' => $data, 'message' => 'Create Token Success']);
        } catch (\Exception $e) {

            return response()->json(['status' => false, 'data' => null, 'message' => 'Create Token Failed: Error: ' . $e->getMessage()]);
        }
    }
}
