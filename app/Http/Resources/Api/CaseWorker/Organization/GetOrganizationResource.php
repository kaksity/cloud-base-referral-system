<?php

namespace App\Http\Resources\Api\CaseWorker\Organization;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetOrganizationResource extends JsonResource
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
            'name' => $this->name,
            'acronym' => $this->acronym,
            'office_address' => $this->office_address,
            'official_email' => $this->official_email,
            'logo_url' => $this->logo_url,
            'services' => $this->services->map(function ($service) {
                return [
                    'name' => $service->name
                ];
            })
        ];
    }
}
