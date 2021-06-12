<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'=> $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'birthDay'=> $this->birthDay,
            'age'=> $this->age,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'country' => $this->country,
            'city' => $this->city,
            'mobile' => $this->mobile,
            'role' => $this->role,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
