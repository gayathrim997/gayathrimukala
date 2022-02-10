<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'client_id'=>$this->id,
            'client_name'=>$this->name,
            'description'=>$this->description,
            'department_id'=>$this->department_id,
            'status'=>$this->status,
        ];
    }
}
