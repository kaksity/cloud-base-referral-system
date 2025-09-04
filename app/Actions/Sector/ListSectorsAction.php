<?php

namespace App\Actions\Sector;

use App\Models\Sector;

class ListSectorsAction
{
    public function __construct(
        private Sector $sector
    ) {}

    public function execute(array $listSectorsRecordOptions, array $relationships = [])
    {
        $paginationPayload = $listSectorsRecordOptions['pagination_payload'] ?? null;
        $filterRecordOptionsPayload = $listSectorsRecordOptions['filter_record_options_payload'] ?? null;

        $query = $this->sector->query()
            ->with($relationships)
            ->orderBy('created_at', 'asc');

        if ($paginationPayload) {
            $paginatedSectors = $query->paginate(
                $paginationPayload['limit'] ?? config('businessConfig.default_page_limit'),
                ['*'],
                'page',
                $paginationPayload['page'] ?? 1
            );

            return [
                'sector_payload' => $paginatedSectors->items(),
                'pagination_payload' => [
                    'meta' => generatePaginationMeta($paginatedSectors),
                    'links' => generatePaginationLinks($paginatedSectors)
                ],
            ];
        }

        $countries = $query->get();

        return [
            'sector_payload' => $countries,
        ];
    }
}
