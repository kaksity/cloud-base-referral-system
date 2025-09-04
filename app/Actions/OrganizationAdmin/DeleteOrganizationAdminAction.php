<?php

namespace App\Actions\OrganizationAdmin;

use App\Models\OrganizationAdmin;

class DeleteOrganizationAdminAction
{
    public function __construct(
        private OrganizationAdmin $organizationAdmin
    )
    {
        
    }
    public function execute(string $organizationAdminId)
    {
        return $this->organizationAdmin->where([
            'id' => $organizationAdminId
        ])->delete();
    }
}