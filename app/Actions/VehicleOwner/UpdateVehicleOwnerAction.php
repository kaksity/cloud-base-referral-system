<?php

namespace App\Actions\VehicleOwner;

use App\Models\VehicleOwner;

class UpdateVehicleOwnerAction
{
    public function __construct(
        private VehicleOwner $vehicleOwner
    )
    {
        
    }
    public function execute(array $updateVehicleOwnerRecordOptions)
    {
        $vehicleOwnerId = $updateVehicleOwnerRecordOptions['id'];
        $data = $updateVehicleOwnerRecordOptions['data'];

        return $this->vehicleOwner->where([
            'id' => $vehicleOwnerId
        ])->update($data);
    }
}