<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\EventService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{

    private $userService;
    private $eventService;

    /**
     * UserController constructor.
     * @param UserService $userService
     * @param EventService $eventService
     */
    public function __construct(
        UserService $userService,
        EventService $eventService
    )
    {
        $this->authorizeResource(User::class);
        $this->userService = $userService;
        $this->eventService = $eventService;
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
        $user->avatar = $this->eventService->saveImages($request->avatar);

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
