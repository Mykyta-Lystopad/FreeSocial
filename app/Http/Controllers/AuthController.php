<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\UserService;
use App\Models\User;
use App\Notifications\EmailVerification;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws AuthenticationException
     */
    public function login(LoginRequest $request) :JsonResponse
    {

        $user = User::where('email', $request->email)
            ->first();

        if ($user) {
            $user->verify_code = mt_rand(100000, 999999);

            $user->save();

            $user->notify(new EmailVerification($user));

            return response()->json(['success' => 'Check your email and click on verify link']);
        }


        elseif (!$user) {
            $user = User::create($request->validated() + [ 'verify_code' => mt_rand(100000, 999999) ]);

            $user->notify(new EmailVerification($user));

            return response()->json(['success' => 'Check your email and click on verify link']);
        }
        else{
            throw new AuthenticationException('Wrong email or verify_code');
        }

    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function verifyCode(LoginRequest $request) :JsonResponse
    {
        /**@var User $user */

        $user = User::where('email', $request->email)
                    ->where('verify_code', $request->verify_code)
                    ->first();

        if (!$user) {
            throw new AuthenticationException('Wrong email or verify_code');
        }

        // set default avatar
        $user->avatar = 'http://nikita-listopad-portfolio.pp.ua/FreeSocial/storage/avatars/default_avatar.png';

        auth()->setUser($user);

        $user = $this->userService->userEmailVerify();

        return $this->success($user);
    }

}
