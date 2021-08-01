<?php

namespace App\Http\Resources\Event;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'eventImages'=>$this->eventImages,
            'title'=>$this->title,
            'description'=>$this->description,
            'coordinates'=>$this->coordinates,
            'departure'=>$this->departure,
            "created_at"=>$this->created_at,
            "updated_at"=>$this->updated_at
        ];
    }
}
