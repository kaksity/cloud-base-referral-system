<?php

namespace App\Actions\VehicleWalletTransaction;

use App\Models\VehicleWalletTransaction;

class UpdateVehicleWalletTransactionAction
{
    public function __construct(
        private VehicleWalletTransaction $vehicleWalletTransaction
    )
    {
        
    }
    public function execute(array $updateVehicleWalletTransactionRecordOptions)
    {
        $vehicleWalletTransactionId = $updateVehicleWalletTransactionRecordOptions['id'];
        $data = $updateVehicleWalletTransactionRecordOptions['data'];

        return $this->vehicleWalletTransaction->where([
            'id' => $vehicleWalletTransactionId
        ])->update($data);
    }
}