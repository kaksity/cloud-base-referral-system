<?php

namespace App\Models;

class Country extends AbstractModel
{
    public function states()
    {
        return $this->hasMany(State::class, 'country_id');
    }

    public function localGovernmentAreas()
    {
        return $this->hasMany(LocalGovernmentArea::class, 'country_id');
    }

    public function wards()
    {
        return $this->hasMany(Ward::class, 'country_id');
    }

    public function locations()
    {
        return $this->hasMany(Location::class, 'country_id');
    }
}
