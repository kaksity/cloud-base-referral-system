<?php

namespace App\Actions\OrganizationAdmin;

use App\Models\OrganizationAdmin;

class ListOrganizationAdminsAction
{
    public function __construct(
        private OrganizationAdmin $organizationAdmin
    ) {}

    public function execute(array $listOrganizationAdminsRecordOptions, array $relationships = [])
    {
        $paginationPayload = $listOrganizationAdminsRecordOptions['pagination_payload'] ?? null;
        $filterRecordOptionsPayload = $listOrganizationAdminsRecordOptions['filter_record_options_payload'] ?? null;

        $query = $this->organizationAdmin->query()
            ->with($relationships)
            ->orderBy('created_at', 'asc');

        if ($paginationPayload) {
            $paginatedOrganizationAdmins = $query->paginate(
                $paginationPayload['limit'] ?? config('businessConfig.default_page_limit'),
                ['*'],
                'page',
                $paginationPayload['page'] ?? 1
            );

            return [
                'organization_admin_payload' => $paginatedOrganizationAdmins->items(),
                'pagination_payload' => [
                    'meta' => generatePaginationMeta($paginatedOrganizationAdmins),
                    'links' => generatePaginationLinks($paginatedOrganizationAdmins)
                ],
            ];
        }

        $organizationAdmins = $query->get();

        return [
            'organization_admin_payload' => $organizationAdmins,
        ];
    }
}
