<?php


namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    /**
     * @return mixed
     */
    public function searchUsers()
    {
        if (request()->search) {
            return $users = User::where('first_name', 'like', '%' . request()->search . '%')
                ->orWhere('last_name', 'like', '%' . request()->search . '%')
                ->orWhere('age', 'like', '%' . request()->search . '%')
                ->orWhere('country', 'like', '%' . request()->search . '%')
                ->orWhere('city', 'like', '%' . request()->search . '%')
                ->paginate();

        }
        else {
            return $users = User::paginate();
        }

    }

    public function userEmailVerify()
    {
        $user = auth()->user();
        $request = request();

        if ($user->email_verified_at === null) {
            $user->email_verified_at = now();
        }

        $user->verify_code = 'done';
        $user->save();
        $data = UserResource::make($user)->toArray($request) +
            ['access_token' => $user->createToken('api')->plainTextToken];

        return $data;
    }
}
