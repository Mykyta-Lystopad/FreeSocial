<?php

namespace App\Http\Controllers;

//use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->authorizeResource(User::class);
        $this->userService = $userService;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $users = $this->userService->searchUsers();

        return $this->success(UserResource::collection($users));

    }

    public function show(User $user)
    {
        return $this->success(new UserResource($user));
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user->age = Carbon::parse($request->birthDay)->diffInYears(\Carbon\Carbon::now());

        $user->update($request->validated());
        return $this->success(new UserResource($user));
    }

    /**
     * @param User $user
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->deleted();
    }



}
