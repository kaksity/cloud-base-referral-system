<?php

namespace App\Actions\VehicleWallet;

use App\Models\VehicleWallet;

class GetVehicleWalletByVehicleIdAction
{
    public function __construct(
        private VehicleWallet $vehicleWallet
    )
    {
        
    }
    public function execute(string $vehicleId, array $relationships = [])
    {
        return $this->vehicleWallet->with(
            $relationships
        )->where([
            'vehicle_id' => $vehicleId
        ])->first();
    }
}