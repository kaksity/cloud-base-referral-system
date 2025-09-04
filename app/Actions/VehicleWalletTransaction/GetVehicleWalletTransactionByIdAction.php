<?php

namespace App\Actions\VehicleWalletTransaction;

use App\Models\VehicleWalletTransaction;

class GetVehicleWalletTransactionByIdAction
{
    public function __construct(
        private VehicleWalletTransaction $vehicleWalletTransaction
    )
    {
        
    }
    public function execute(string $vehicleWalletTransactionId, array $relationships = [])
    {
        return $this->vehicleWalletTransaction->with(
            $relationships
        )->where([
            'id' => $vehicleWalletTransactionId
        ])->first();
    }
}