<?php

namespace App\Actions\OrganizationAdmin;

use App\Models\OrganizationAdmin;

class CreateOrganizationAdminAction
{
    public function __construct(
        private OrganizationAdmin $organizationAdmin
    )
    {}

    public function execute(array $createOrganizationAdminRecordOptions)
    {
        return $this->organizationAdmin->create(
            $createOrganizationAdminRecordOptions
        );
    }
}