<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'Get data success',
            'data' => UserResource::collection(User::all())
            //'data' => UserResource::collection(User::paginate())->resource
        ]);
    }

    public function show(User $user)
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        try {

            $user->deleteOrFail();

            return response()->noContent();
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}
