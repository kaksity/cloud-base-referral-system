<?php

namespace App\Actions\VehicleOwner;

use App\Models\VehicleOwner;

class DeleteVehicleOwnerAction
{
    public function __construct(
        private VehicleOwner $vehicleOwner
    )
    {
        
    }
    public function execute(string $vehicleOwnerId)
    {
        return $this->vehicleOwner->where([
            'id' => $vehicleOwnerId
        ])->delete();
    }
}