<?php

namespace App\Actions\Location;

use App\Models\Location;

class GetLocationByIdAction
{
    public function __construct(
        private Location $location
    ) {}

    public function execute(string $locationId)
    {
        return $this->location->where('id', $locationId)->first();
    }
}
