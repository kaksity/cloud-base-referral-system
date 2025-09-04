<?php

namespace App\Actions\OrganizationAdmin;

use App\Models\OrganizationAdmin;

class GetOrganizationAdminByIdAction
{
    public function __construct(
        private OrganizationAdmin $organizationAdmin
    )
    {
        
    }
    public function execute(string $organizationAdminId, array $relationships = [])
    {
        return $this->organizationAdmin->with(
            $relationships
        )->where([
            'id' => $organizationAdminId
        ])->first();
    }
}