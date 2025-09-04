<?php

namespace App\Actions\Location;

use App\Models\Location;

class UpdateLocationAction
{
    public function __construct(
        private Location $location
    ) {}

    public function execute($updateLocationRecordOptions)
    {
        $id = $updateLocationRecordOptions['id'];
        $data = $updateLocationRecordOptions['data'];

        $this->location->where('id', $id)->update($data);
    }
}
