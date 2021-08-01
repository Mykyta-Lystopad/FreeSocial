<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;
use App\Http\Resources\Event\EventResource;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{

    private $eventService;

    public function __construct(eventService $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $events = $this->eventService->searchEvents();
        $check = EventResource::collection($events);
//        dd($check);
        return $this->success(EventResource::collection($events));
    }

    /**
     * @param Event $event
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Event $event)
    {
        return $this->success(new EventResource($event));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(StoreRequest $request)
    {
        $user = auth()->user();
        $event = $user->events()->create($request->validated());
        $event->eventImages = $this->eventService->saveImages($request->eventImages);
        $event->save();

        return $this->created(new EventResource($event));
    }

    /**
     * @param UpdateRequest $request
     * @param Event $event
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Event $event)
    {
        $event->update($request->validated());
        $event->eventImages = $this->eventService->saveImages($request->eventImages);
        $event->save();

        return $this->success(new EventResource($event));
    }

    /**
     * @param Event $event
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return $this->deleted();
    }
}
