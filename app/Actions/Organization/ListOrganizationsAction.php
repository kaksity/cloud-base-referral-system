<?php

namespace App\Actions\Organization;

use App\Models\Organization;

class ListOrganizationsAction
{
    public function __construct(
        private Organization $organization
    ) {}

    public function execute(array $listOrganizationsRecordOptions, array $relationships = [])
    {
        $paginationPayload = $listOrganizationsRecordOptions['pagination_payload'] ?? null;
        $filterRecordOptionsPayload = $listOrganizationsRecordOptions['filter_record_options_payload'] ?? null;

        $query = $this->organization->query()
            ->with($relationships)
            ->orderBy('created_at', 'asc');

        if ($paginationPayload) {
            $paginatedOrganizations = $query->paginate(
                $paginationPayload['limit'] ?? config('businessConfig.default_page_limit'),
                ['*'],
                'page',
                $paginationPayload['page'] ?? 1
            );

            return [
                'organization_payload' => $paginatedOrganizations->items(),
                'pagination_payload' => [
                    'meta' => generatePaginationMeta($paginatedOrganizations),
                    'links' => generatePaginationLinks($paginatedOrganizations)
                ],
            ];
        }

        $countries = $query->get();

        return [
            'organization_payload' => $countries,
        ];
    }
}
