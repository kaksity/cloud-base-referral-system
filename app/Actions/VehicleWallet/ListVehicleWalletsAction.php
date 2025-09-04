<?php

namespace App\Actions\VehicleWallet;

use App\Models\VehicleWallet;

class ListVehicleWalletsAction
{
    public function __construct(
        private VehicleWallet $vehicleWallet
    ) {}

    public function execute(array $listVehicleWalletsRecordOptions, array $relationships = [])
    {
        $paginationPayload = $listVehicleWalletsRecordOptions['pagination_payload'] ?? null;
        $filterRecordOptionsPayload = $listVehicleWalletsRecordOptions['filter_record_options_payload'] ?? null;

        $query = $this->vehicleWallet->query()
            ->with($relationships)
            ->orderBy('created_at', 'asc');

        if ($paginationPayload) {
            $paginatedVehicleWallets = $query->paginate(
                $paginationPayload['limit'] ?? config('businessConfig.default_page_limit'),
                ['*'],
                'page',
                $paginationPayload['page'] ?? 1
            );

            return [
                'vehicle_wallet_payload' => $paginatedVehicleWallets->items(),
                'pagination_payload' => [
                    'meta' => generatePaginationMeta($paginatedVehicleWallets),
                    'links' => generatePaginationLinks($paginatedVehicleWallets)
                ],
            ];
        }

        $vehicleWallets = $query->get();

        return [
            'vehicle_wallet_payload' => $vehicleWallets,
        ];
    }
}
