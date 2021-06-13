<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\UserService;
use App\Models\User;
use App\Notifications\EmailVerification;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

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
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create($request->validated() + [ 'verify_code' => mt_rand(100000, 999999) ]);

        $user->notify(new EmailVerification($user));

        return response()->json(['success' => 'Check your email and click on verify link']);

    }

    public function login(LoginRequest $request) :JsonResponse
    {
        $user = User::where('email', $request->email)
            ->first();

        if (!$user) {
            throw new AuthenticationException('Wrong email or verify_code');
        }

        $user->verify_code = mt_rand(100000, 999999);
        $user->save();

        $user->notify(new EmailVerification($user));

        return response()->json(['success' => 'Check your email and click on verify link']);
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

        auth()->setUser($user);

//        dd(auth()->user());

        $user = $this->userService->userEmailVerify();

        return $this->success($user);
    }

}
