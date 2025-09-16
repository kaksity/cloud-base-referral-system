<?php

namespace App\Http\Resources\Api\CaseWorker\Profile;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetProfileResource extends JsonResource
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
            'current_organization' => [
                'id' => $this->currentOrganization->id,
                'name' => $this->currentOrganization->name,
                'logo_url' => $this->currentOrganization->logo_url,
            ],
            'current_location' => [
                'id' => $this->currentLocation->id,
                'name' => $this->currentLocation->name,
                'state' => [
                    'id' => $this->currentLocation->state->id,
                    'name' => $this->currentLocation->state->name,
                ],
                'local_government_area' => [
                    'id' => $this->currentLocation->localGovernmentArea->id,
                    'name' => $this->currentLocation->localGovernmentArea->name,
                ]
            ],
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'mobile_number' => $this->mobile_number,
            'status' => $this->status,
        ];
    }
}
