<?php

namespace App\Models;

class CaseWorker extends AbstractModel
{
    public function currentOrganization()
    {
        return $this->belongsTo(Organization::class, 'current_organization_id');
    }

    public function addedByOrganizationAdmin()
    {
        return $this->belongsTo(OrganizationAdmin::class, 'added_by_organization_admin_id');
    }

    public function currentLocation()
    {
        return $this->belongsTo(Location::class, 'current_location_id');
    }
}
