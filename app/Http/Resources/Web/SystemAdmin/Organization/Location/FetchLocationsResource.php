<?php

namespace App\Http\Resources\Web\SystemAdmin\Organization\Location;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FetchLocationsResource extends JsonResource
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
            'organization' => [
                'id' => $this->organization->id,
                'name' => $this->organization->name,
            ],
            'country' => [
                'id' => $this->country->id,
                'name' => $this->country->name,
            ],
            'state' => [
                'id' => $this->state->id,
                'name' => $this->state->name,
            ],
            'local_government_area' => [
                'id' => $this->localGovernmentArea->id,
                'name' => $this->localGovernmentArea->name,
            ],
            'ward' => [
                'id' => $this->ward->id,
                'name' => $this->ward->name,
            ],
            'name' => $this->name,
        ];
    }
}
