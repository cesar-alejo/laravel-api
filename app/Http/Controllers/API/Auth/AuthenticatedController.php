<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthenticatedController extends Controller
{
    public function store(LoginRequest $request)
    {
        try {

            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {

                throw new \Exception('Authentication Failed');
            }

            $user = User::where('email', $request->email)->first();
            if (!Hash::check($request->password, $user->password, [])) {

                throw new \Exception('Invalid Credentials');
            }

            $token = $user->createToken('authToken')->plainTextToken;

            $data = [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ];

            return response()->json(['status' => true, 'result' => $data, 'message' => 'Authenticated']);
        } catch (\Exception $e) {

            return response()->json(['status' => false, 'result' => null, 'message' => 'Login Failed: ' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        $user = User::find(Auth::user()->id);

        $user->tokens()->delete();

        return response()->noContent();
    }
}
