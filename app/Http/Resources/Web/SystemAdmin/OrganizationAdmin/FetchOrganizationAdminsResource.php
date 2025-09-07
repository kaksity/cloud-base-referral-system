<?php

namespace App\Http\Resources\Web\SystemAdmin\OrganizationAdmin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FetchOrganizationAdminsResource extends JsonResource
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
            'added_by_system_admin' => [
                'first_name' => $this->addedBySystemAdmin->first_name,
                'last_name' => $this->addedBySystemAdmin->last_name,
            ],
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'mobile_number' => $this->mobile_number,
            'email' => $this->email,
        ];
    }
}
