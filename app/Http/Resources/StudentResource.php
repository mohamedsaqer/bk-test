<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'order' => $this->order,
            'school_id' => $this->school_id,
            'school_name' => $this->school->name,
            'created' => $this->created_at ? $this->created_at->format('d/m/Y h:i:a') : '',
            'updated' => $this->updated_at ? $this->updated_at->format('d/m/Y h:i:a') : '',
        ];
    }
}
