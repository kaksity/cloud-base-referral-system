<?php

namespace App\Http\Resources\Web\SystemAdmin\Organization;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FetchOrganizationsResource extends JsonResource
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
            'added_by_system_admin' => [
                'first_name' => $this->addedBySystemAdmin->first_name,
                'last_name' => $this->addedBySystemAdmin->last_name,
            ],
            'name' => $this->name,
            'acronym' => $this->acronym,
            'created_at' => \Carbon\Carbon::parse($this->created_at)->format('jS F Y'),
            'official_email' => $this->official_email,
        ];
    }
}
