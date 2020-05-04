<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RowDeleted extends JsonResource
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
            'deleted' => true,
            'resource' => $this->id
        ];
    }
}
