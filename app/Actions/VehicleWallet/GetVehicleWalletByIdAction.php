<?php

namespace App\Actions\VehicleWallet;

use App\Models\VehicleWallet;

class GetVehicleWalletByIdAction
{
    public function __construct(
        private VehicleWallet $vehicleWallet
    )
    {
        
    }
    public function execute(string $vehicleWalletId, array $relationships = [])
    {
        return $this->vehicleWallet->with(
            $relationships
        )->where([
            'id' => $vehicleWalletId
        ])->first();
    }
}