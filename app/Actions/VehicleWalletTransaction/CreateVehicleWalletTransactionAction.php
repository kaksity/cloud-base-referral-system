<?php

namespace App\Actions\VehicleWalletTransaction;

use App\Models\VehicleWalletTransaction;

class CreateVehicleWalletTransactionAction
{
    public function __construct(
        private VehicleWalletTransaction $vehicleWalletTransaction
    )
    {}

    public function execute(array $createVehicleWalletTransactionRecordOptions)
    {
        return $this->vehicleWalletTransaction->create(
            $createVehicleWalletTransactionRecordOptions
        );
    }
}