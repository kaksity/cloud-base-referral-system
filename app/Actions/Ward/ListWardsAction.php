<?php

namespace App\Actions\Ward;

use App\Models\Ward;

class ListWardsAction
{
    public function __construct(
        private Ward $ward
    ) {}

    public function execute(array $listWardsRecordOptions, array $relationships = [])
    {
        $paginationPayload = $listWardsRecordOptions['pagination_payload'] ?? null;
        $filterRecordOptionsPayload = $listWardsRecordOptions['filter_record_options_payload'] ?? null;

        $query = $this->ward->query()
            ->with($relationships)
            ->orderBy('created_at', 'asc');

        if ($paginationPayload) {
            $paginatedWards = $query->paginate(
                $paginationPayload['limit'] ?? config('businessConfig.default_page_limit'),
                ['*'],
                'page',
                $paginationPayload['page'] ?? 1
            );

            return [
                'ward_payload' => $paginatedWards->items(),
                'pagination_payload' => [
                    'meta' => generatePaginationMeta($paginatedWards),
                    'links' => generatePaginationLinks($paginatedWards)
                ],
            ];
        }

        $countries = $query->get();

        return [
            'ward_payload' => $countries,
        ];
    }
}
