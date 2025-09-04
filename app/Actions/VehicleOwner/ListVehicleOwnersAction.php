<?php

namespace App\Actions\VehicleOwner;

use App\Models\VehicleOwner;

class ListVehicleOwnersAction
{
    public function __construct(
        private VehicleOwner $vehicleOwner
    ) {}

    public function execute(array $listVehicleOwnersRecordOptions, array $relationships = [])
    {
        $paginationPayload = $listVehicleOwnersRecordOptions['pagination_payload'] ?? null;
        $filterRecordOptionsPayload = $listVehicleOwnersRecordOptions['filter_record_options_payload'] ?? null;

        $query = $this->vehicleOwner->query()
            ->with($relationships)
            ->orderBy('created_at', 'asc');

        if ($paginationPayload) {
            $paginatedVehicleOwners = $query->paginate(
                $paginationPayload['limit'] ?? config('businessConfig.default_page_limit'),
                ['*'],
                'page',
                $paginationPayload['page'] ?? 1
            );

            return [
                'vehicle_owner_payload' => $paginatedVehicleOwners->items(),
                'pagination_payload' => [
                    'meta' => generatePaginationMeta($paginatedVehicleOwners),
                    'links' => generatePaginationLinks($paginatedVehicleOwners)
                ],
            ];
        }

        $vehicleOwners = $query->get();

        return [
            'vehicle_owner_payload' => $vehicleOwners,
        ];
    }
}
