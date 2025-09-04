<?php

namespace App\Actions\Organization;

use App\Models\Organization;

class DeleteOrganizationAction
{
    public function __construct(
        private Organization $organization
    ) {}

    public function execute($organizationId)
    {
        $this->organization->where('id', $organizationId)->delete();
    }
}
