<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\UserService;
use App\Models\User;
use App\Notifications\EmailVerification;
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

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(LoginRequest $request) :JsonResponse
    {
        /**@var User $user */

        if (!auth()->once($request->validated())) {
            throw ValidationException::withMessages([
                'email' => 'Wrong email or password'
            ]);
        }

        $user = $this->userService->userEmailVerify();

        return $this->success($user);
    }

}
