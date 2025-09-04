<?php

namespace App\Actions\OrganizationAdmin;

use App\Models\OrganizationAdmin;

class UpdateOrganizationAdminAction
{
    public function __construct(
        private OrganizationAdmin $organizationAdmin
    )
    {
        
    }
    public function execute(array $updateOrganizationAdminRecordOptions)
    {
        $organizationAdminId = $updateOrganizationAdminRecordOptions['id'];
        $data = $updateOrganizationAdminRecordOptions['data'];

        return $this->organizationAdmin->where([
            'id' => $organizationAdminId
        ])->update($data);
    }
}