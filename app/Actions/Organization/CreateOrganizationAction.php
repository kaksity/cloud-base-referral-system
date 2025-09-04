<?php

namespace App\Actions\Organization;

use App\Models\Organization;

class CreateOrganizationAction
{
    public function __construct(
        private Organization $organization
    ) {}

    public function execute(array $createOrganizationRecordOptions)
    {
        return $this->organization->create($createOrganizationRecordOptions);
    }
}
