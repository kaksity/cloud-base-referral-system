<?php

namespace App\Actions\VehicleWalletTransaction;

use App\Models\VehicleWalletTransaction;

class ListVehicleWalletTransactionsAction
{
    public function __construct(
        private VehicleWalletTransaction $vehicleWalletTransaction
    ) {}

    public function execute(array $listVehicleWalletTransactionsRecordOptions, array $relationships = [])
    {
        $paginationPayload = $listVehicleWalletTransactionsRecordOptions['pagination_payload'] ?? null;
        $filterRecordOptionsPayload = $listVehicleWalletTransactionsRecordOptions['filter_record_options_payload'] ?? null;

        $query = $this->vehicleWalletTransaction->query()
            ->with($relationships)
            ->orderBy('created_at', 'asc');

        if ($paginationPayload) {
            $paginatedVehicleWalletTransactions = $query->paginate(
                $paginationPayload['limit'] ?? config('businessConfig.default_page_limit'),
                ['*'],
                'page',
                $paginationPayload['page'] ?? 1
            );

            return [
                'vehicle_wallet_transaction_payload' => $paginatedVehicleWalletTransactions->items(),
                'pagination_payload' => [
                    'meta' => generatePaginationMeta($paginatedVehicleWalletTransactions),
                    'links' => generatePaginationLinks($paginatedVehicleWalletTransactions)
                ],
            ];
        }

        $vehicleWalletTransactions = $query->get();

        return [
            'vehicle_wallet_transaction_payload' => $vehicleWalletTransactions,
        ];
    }
}
