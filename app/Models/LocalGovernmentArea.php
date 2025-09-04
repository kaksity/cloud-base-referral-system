<?php

namespace App\Models;

class LocalGovernmentArea extends AbstractModel
{
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function wards()
    {
        return $this->hasMany(Ward::class, 'local_government_area_id');
    }

    public function locations()
    {
        return $this->hasMany(Location::class, 'local_government_area_id');
    }
}
