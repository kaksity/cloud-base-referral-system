<?php

namespace App\Actions\VehicleOwner;

use App\Models\VehicleOwner;

class CreateVehicleOwnerAction
{
    public function __construct(
        private VehicleOwner $vehicleOwner
    )
    {}

    public function execute(array $createVehicleOwnerRecordOptions)
    {
        return $this->vehicleOwner->create(
            $createVehicleOwnerRecordOptions
        );
    }
}