<?php

namespace App\Models;

class Service extends AbstractModel
{
    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
