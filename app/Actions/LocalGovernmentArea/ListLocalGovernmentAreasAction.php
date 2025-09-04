<?php

namespace App\Actions\LocalGovernmentArea;

use App\Models\LocalGovernmentArea;

class ListLocalGovernmentAreasAction
{
    public function __construct(
        private LocalGovernmentArea $localGovernmentArea
    ) {}

    public function execute(array $listLocalGovernmentAreasRecordOptions, array $relationships = [])
    {
        $paginationPayload = $listLocalGovernmentAreasRecordOptions['pagination_payload'] ?? null;
        $filterRecordOptionsPayload = $listLocalGovernmentAreasRecordOptions['filter_record_options_payload'] ?? null;

        $query = $this->localGovernmentArea->query()
            ->with($relationships)
            ->orderBy('created_at', 'asc');

        if ($paginationPayload) {
            $paginatedLocalGovernmentAreas = $query->paginate(
                $paginationPayload['limit'] ?? config('businessConfig.default_page_limit'),
                ['*'],
                'page',
                $paginationPayload['page'] ?? 1
            );

            return [
                'local_government_area_payload' => $paginatedLocalGovernmentAreas->items(),
                'pagination_payload' => [
                    'meta' => generatePaginationMeta($paginatedLocalGovernmentAreas),
                    'links' => generatePaginationLinks($paginatedLocalGovernmentAreas)
                ],
            ];
        }

        $localGovernmentAreas = $query->get();

        return [
            'local_government_area_payload' => $localGovernmentAreas,
        ];
    }
}
