<?php

namespace App\Actions\VehicleWallet;

use App\Models\VehicleWallet;

class UpdateVehicleWalletAction
{
    public function __construct(
        private VehicleWallet $vehicleWallet
    )
    {
        
    }
    public function execute(array $updateVehicleWalletRecordOptions)
    {
        $vehicleWalletId = $updateVehicleWalletRecordOptions['id'];
        $data = $updateVehicleWalletRecordOptions['data'];

        return $this->vehicleWallet->where([
            'id' => $vehicleWalletId
        ])->update($data);
    }
}