<?php

namespace App\Models;

class OrganizationAdmin extends AbstractModel
{
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}
