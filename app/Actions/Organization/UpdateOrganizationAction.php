<?php

namespace App\Actions\Organization;

use App\Models\Organization;

class UpdateOrganizationAction
{
    public function __construct(
        private Organization $organization
    ) {}

    public function execute($updateOrganizationRecordOptions)
    {
        $id = $updateOrganizationRecordOptions['id'];
        $data = $updateOrganizationRecordOptions['data'];

        $this->organization->where('id', $id)->update($data);
    }
}
