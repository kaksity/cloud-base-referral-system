<?php

namespace App\Actions\VehicleWallet;

use App\Models\VehicleWallet;

class CreateVehicleWalletAction
{
    public function __construct(
        private VehicleWallet $vehicleWallet
    )
    {}

    public function execute(array $createVehicleWalletRecordOptions)
    {
        return $this->vehicleWallet->create(
            $createVehicleWalletRecordOptions
        );
    }
}