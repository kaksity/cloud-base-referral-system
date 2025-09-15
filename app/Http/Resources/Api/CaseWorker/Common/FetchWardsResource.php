<?php

namespace App\Http\Resources\Api\CaseWorker\Common;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FetchWardsResource extends JsonResource
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
            'country' => $this->country->name,
            'state' => $this->state->name,
            'local_government_area' => $this->localGovernmentArea->name,
            'name' => $this->name,
        ];
    }
}
