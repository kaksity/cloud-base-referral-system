<?php

namespace App\Models;

class Ward extends AbstractModel
{
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function localGovernmentArea()
    {
        return $this->belongsTo(LocalGovernmentArea::class, 'local_government_area_id');
    }

    public function locations()
    {
        return $this->hasMany(Location::class, 'ward_id');
    }
}
