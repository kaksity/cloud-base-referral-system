<?php

namespace App\Actions\VehicleWalletTransaction;

use App\Models\VehicleWalletTransaction;

class DeleteVehicleWalletTransactionAction
{
    public function __construct(
        private VehicleWalletTransaction $vehicleWalletTransaction
    )
    {
        
    }
    public function execute(string $vehicleWalletTransactionId)
    {
        return $this->vehicleWalletTransaction->where([
            'id' => $vehicleWalletTransactionId
        ])->delete();
    }
}