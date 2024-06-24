<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Auth\Events\Registered;
//use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use App\Models\User;

class RegisteredUserController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'type_ident' => ['required', 'string', 'min:2', 'max:3'],
                'ident' => ['required', 'numeric', 'min:4'],
                'name' => ['required', 'string', 'max:50'],
                'lastname' => ['required', 'string', 'max:49'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:50', 'unique:' . User::class],
                'username' => ['required', 'string', 'max:15'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'type_ident' => $request->type_ident,
                'ident' => $request->ident,
                'name' => "{$request->name}|{$request->lastname}",
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('authToken')->plainTextToken;

            $data = [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ];

            return response()->json(['status' => true, 'result' => $data, 'message' => 'Create Token Success']);
        } catch (\Exception $e) {

            return response()->json(['status' => false, 'result' => null, 'message' => 'Create Token Failed: Error: ' . $e->getMessage()]);
        }
    }
}
