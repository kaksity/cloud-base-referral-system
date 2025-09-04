<?php

namespace App\Actions\Location;

use App\Models\Location;

class CreateLocationAction
{
    public function __construct(
        private Location $location
    ) {}

    public function execute(array $createLocationRecordOptions)
    {
        return $this->location->create($createLocationRecordOptions);
    }
}
