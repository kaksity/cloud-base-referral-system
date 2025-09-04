<?php

namespace App\Actions\SystemAdmin;

use App\Models\SystemAdmin;

class ListSystemAdminsAction
{
    public function __construct(
        private SystemAdmin $systemAdmin
    ) {}

    public function execute(array $listSystemAdminsRecordOptions, array $relationships = [])
    {
        $paginationPayload = $listSystemAdminsRecordOptions['pagination_payload'] ?? null;
        $filterRecordOptionsPayload = $listSystemAdminsRecordOptions['filter_record_options_payload'] ?? null;

        $query = $this->systemAdmin->query()
            ->with($relationships)
            ->orderBy('created_at', 'asc');

        if ($paginationPayload) {
            $paginatedSystemAdmins = $query->paginate(
                $paginationPayload['limit'] ?? config('businessConfig.default_page_limit'),
                ['*'],
                'page',
                $paginationPayload['page'] ?? 1
            );

            return [
                'system_admin_payload' => $paginatedSystemAdmins->items(),
                'pagination_payload' => [
                    'meta' => generatePaginationMeta($paginatedSystemAdmins),
                    'links' => generatePaginationLinks($paginatedSystemAdmins)
                ],
            ];
        }

        $systemAdmins = $query->get();

        return [
            'system_admin_payload' => $systemAdmins,
        ];
    }
}
