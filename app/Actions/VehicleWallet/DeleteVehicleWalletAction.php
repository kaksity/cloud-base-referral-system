<?php

namespace App\Actions\VehicleWallet;

use App\Models\VehicleWallet;

class DeleteVehicleWalletAction
{
    public function __construct(
        private VehicleWallet $vehicleWallet
    )
    {
        
    }
    public function execute(string $vehicleWalletId)
    {
        return $this->vehicleWallet->where([
            'id' => $vehicleWalletId
        ])->delete();
    }
}