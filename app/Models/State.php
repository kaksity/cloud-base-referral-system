<?php

namespace App\Models;

class State extends AbstractModel
{
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function localGovernmentAreas()
    {
        return $this->hasMany(LocalGovernmentArea::class, 'state_id');
    }

    public function wards()
    {
        return $this->hasMany(Ward::class, 'state_id');
    }

    public function locations()
    {
        return $this->hasMany(Location::class, 'state_id');
    }
}
