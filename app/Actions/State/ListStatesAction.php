<?php

namespace App\Actions\State;

use App\Models\State;

class ListStatesAction
{
    public function __construct(
        private State $state
    ) {}

    public function execute(array $listStatesRecordOptions, array $relationships = [])
    {
        $paginationPayload = $listStatesRecordOptions['pagination_payload'] ?? null;
        $filterRecordOptionsPayload = $listStatesRecordOptions['filter_record_options_payload'] ?? null;

        $query = $this->state->query()
            ->with($relationships)
            ->orderBy('created_at', 'asc');

        if ($paginationPayload) {
            $paginatedStates = $query->paginate(
                $paginationPayload['limit'] ?? config('businessConfig.default_page_limit'),
                ['*'],
                'page',
                $paginationPayload['page'] ?? 1
            );

            return [
                'state_payload' => $paginatedStates->items(),
                'pagination_payload' => [
                    'meta' => generatePaginationMeta($paginatedStates),
                    'links' => generatePaginationLinks($paginatedStates)
                ],
            ];
        }

        $countries = $query->get();

        return [
            'state_payload' => $countries,
        ];
    }
}
