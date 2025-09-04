<?php

namespace App\Actions\Location;

use App\Models\Location;

class DeleteLocationAction
{
    public function __construct(
        private Location $location
    ) {}

    public function execute($locationId)
    {
        $this->location->where('id', $locationId)->delete();
    }
}
