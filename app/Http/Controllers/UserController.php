<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\User\AvatarRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegistrationRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function info() {
        return UserResource::collection([auth()->user()]);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where($request->all())->first();

        if ($user) {
            Auth::login($user);
            return response()->json(['data' => ['user_token' => Auth::user()->login()]]);
        } else {
            throw new ApiException(401, 'Authentication failed');
        }
    }

    public function logout()
    {
        Auth::user()->logout();
        return response()->json(['data' => ['message' => 'logout']]);
    }

    public function user()
    {
        return UserResource::collection(User::all());
    }

    public function add(RegistrationRequest $request)
    {
        $user = User::create(
            $request->all()
        );

        return response()->json([
            'data' => [
                'id' => $user->id,
                'status' => 'created'
            ]
        ])->setStatusCode(200, 'Created');
    }

    public function avatar(AvatarRequest $request) {
        $user = auth()->user();

        if($user->photo_file)
            Storage::disk('avatars')->delete($user->photo_file);

        $user->update([
            'photo_file' => $request->photo_file->storePublicly('', ['disk' => 'avatars']),
        ]);

        return response()->json([
            'data' => [
                'id' => $user->id,
                'status' => true
            ]
        ])->setStatusCode('200', "Updated");
    }

    public function remove($id) {
        User::find($id)->delete();

        return response()->json([
            'data' => [
                'id' => $id,
                'status' => 'removed'
            ]
        ])->setStatusCode('200', "Removed");
    }

    public function update(UpdateRequest $request, $id) {
        User::find($id)->update($request->all());

        return response()->json([
            'data' => [
                'id' => $id,
                'status' => 'updated'
            ]
        ])->setStatusCode('200', "Updated");
    }
}
