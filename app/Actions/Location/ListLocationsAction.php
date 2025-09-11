<?php

namespace App\Actions\Location;

use App\Models\Location;

class ListLocationsAction
{
    public function __construct(
        private Location $location
    ) {}

    public function execute(array $listLocationsRecordOptions, array $relationships = [])
    {
        $paginationPayload = $listLocationsRecordOptions['pagination_payload'] ?? null;
        $filterRecordOptionsPayload = $listLocationsRecordOptions['filter_record_options_payload'] ?? null;

        $query = $this->location->query()
            ->with($relationships)
            ->orderBy('created_at', 'asc');

        if (!empty($filterRecordOptionsPayload['organization_id'])) {
            $query->where('organization_id', $filterRecordOptionsPayload['organization_id']);
        }

        if ($paginationPayload) {
            $paginatedLocations = $query->paginate(
                $paginationPayload['limit'] ?? config('businessConfig.default_page_limit'),
                ['*'],
                'page',
                $paginationPayload['page'] ?? 1
            );

            return [
                'location_payload' => $paginatedLocations->items(),
                'pagination_payload' => [
                    'meta' => generatePaginationMeta($paginatedLocations),
                    'links' => generatePaginationLinks($paginatedLocations)
                ],
            ];
        }

        $countries = $query->get();

        return [
            'location_payload' => $countries,
        ];
    }
}
