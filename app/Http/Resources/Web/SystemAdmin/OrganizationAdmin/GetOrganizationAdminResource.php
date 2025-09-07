<?php

namespace App\Http\Resources\Web\SystemAdmin\OrganizationAdmin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetOrganizationAdminResource extends JsonResource
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
                'added_by_system_admin' => [
                    'first_name' => $this->organization->addedBySystemAdmin->first_name,
                    'last_name' => $this->organization->addedBySystemAdmin->last_name,
                ],
                'name' => $this->organization->name,
                'acronym' => $this->organization->acronym,
                'created_at' => \Carbon\Carbon::parse($this->organization->created_at)->format('jS F Y'),
                'description' => $this->organization->description,
                'office_address' => $this->organization->office_address,
                'official_email' => $this->organization->official_email,
            ],
            'personal_information' => [
                'added_by_system_admin' => [
                    'first_name' => $this->addedBySystemAdmin->first_name,
                    'last_name' => $this->addedBySystemAdmin->last_name,
                ],
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
                'mobile_number' => $this->mobile_number,
                'email' => $this->email,
                'created_at' => \Carbon\Carbon::parse($this->created_at)->format('jS F Y'),
            ]
        ];
    }
}
