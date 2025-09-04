<?php

namespace App\Actions\Service;

use App\Models\Service;

class ListServicesAction
{
    public function __construct(
        private Service $service
    ) {}

    public function execute(array $listServicesRecordOptions, array $relationships = [])
    {
        $paginationPayload = $listServicesRecordOptions['pagination_payload'] ?? null;
        $filterRecordOptionsPayload = $listServicesRecordOptions['filter_record_options_payload'] ?? null;

        $query = $this->service->query()
            ->with($relationships)
            ->orderBy('created_at', 'asc');

        if ($paginationPayload) {
            $paginatedServices = $query->paginate(
                $paginationPayload['limit'] ?? config('businessConfig.default_page_limit'),
                ['*'],
                'page',
                $paginationPayload['page'] ?? 1
            );

            return [
                'service_payload' => $paginatedServices->items(),
                'pagination_payload' => [
                    'meta' => generatePaginationMeta($paginatedServices),
                    'links' => generatePaginationLinks($paginatedServices)
                ],
            ];
        }

        $countries = $query->get();

        return [
            'service_payload' => $countries,
        ];
    }
}
