<?php

namespace App\Http\Resources\Web\SystemAdmin\Settings\LocalGovernmentArea;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FetchLocalGovernmentAreasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'country' => [
                'id' => $this->country->id,
                'name' => $this->country->name
            ],
            'state' => [
                'id' => $this->state->id,
                'name' => $this->state->name
            ],
            'name' => $this->name,
        ];
    }
}
