<?php

namespace App\Actions\VehicleOwner;

use App\Models\VehicleOwner;

class GetVehicleOwnerByIdAction
{
    public function __construct(
        private VehicleOwner $vehicleOwner
    )
    {
        
    }
    public function execute(string $vehicleOwnerId, array $relationships = [])
    {
        return $this->vehicleOwner->with(
            $relationships
        )->where([
            'id' => $vehicleOwnerId
        ])->first();
    }
}