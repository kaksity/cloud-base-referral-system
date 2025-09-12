<?php

namespace App\Actions\CaseWorker;

use App\Models\CaseWorker;

class ListCaseWorkersAction
{
    public function __construct(
        private CaseWorker $caseWorker
    ) {}

    public function execute(array $listCaseWorkersRecordOptions, array $relationships = [])
    {
        $paginationPayload = $listCaseWorkersRecordOptions['pagination_payload'] ?? null;
        $filterRecordOptionsPayload = $listCaseWorkersRecordOptions['filter_record_options_payload'] ?? null;

        $query = $this->caseWorker->query()
            ->with($relationships)
            ->orderBy('created_at', 'asc');

        if (!empty($filterRecordOptionsPayload['current_organization_id'])) {
            $query->where('current_organization_id', $filterRecordOptionsPayload['current_organization_id']);
        }

        if (!empty($filterRecordOptionsPayload['added_by_organization_admin_id'])) {
            $query->where('added_by_organization_admin_id', $filterRecordOptionsPayload['added_by_organization_admin_id']);
        }

        if (!empty($filterRecordOptionsPayload['current_location_id'])) {
            $query->where('current_location_id', $filterRecordOptionsPayload['current_location_id']);
        }

        if ($paginationPayload) {
            $paginatedCaseWorkers = $query->paginate(
                $paginationPayload['limit'] ?? config('businessConfig.default_page_limit'),
                ['*'],
                'page',
                $paginationPayload['page'] ?? 1
            );

            return [
                'case_worker_payload' => $paginatedCaseWorkers->items(),
                'pagination_payload' => [
                    'meta' => generatePaginationMeta($paginatedCaseWorkers),
                    'links' => generatePaginationLinks($paginatedCaseWorkers)
                ],
            ];
        }

        $caseWorkers = $query->get();

        return [
            'case_worker_payload' => $caseWorkers,
        ];
    }
}
