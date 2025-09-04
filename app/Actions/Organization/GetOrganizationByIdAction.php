<?php

namespace App\Actions\Organization;

use App\Models\Organization;

class GetOrganizationByIdAction
{
    public function __construct(
        private Organization $organization
    ) {}

    public function execute(string $organizationId)
    {
        return $this->organization->where('id', $organizationId)->first();
    }
}
