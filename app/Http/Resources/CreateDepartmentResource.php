<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateDepartmentResource extends JsonResource
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
            
            'id'=>$this->id,
            'name' =>$this->name,
            'description'=>$this->description,
            'added_by'=>$this->added_by,
            'status' =>$this->status,
            'created_at'=>Carbon::parse($this->created_at)->format('d-m-y')
        ];
    }
}
