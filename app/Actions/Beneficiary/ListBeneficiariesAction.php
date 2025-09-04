<?php

namespace App\Actions\Beneficiary;

use App\Models\Beneficiary;

class ListBeneficiariesAction
{
    public function __construct(
        private Beneficiary $beneficiary
    ) {}

    public function execute(array $listBeneficiariesRecordOptions, array $relationships = [])
    {
        $paginationPayload = $listBeneficiariesRecordOptions['pagination_payload'] ?? null;
        $filterRecordOptionsPayload = $listBeneficiariesRecordOptions['filter_record_options_payload'] ?? null;

        $query = $this->beneficiary->query()
            ->with($relationships)
            ->orderBy('created_at', 'asc');

        if ($paginationPayload) {
            $paginatedBeneficiaries = $query->paginate(
                $paginationPayload['limit'] ?? config('businessConfig.default_page_limit'),
                ['*'],
                'page',
                $paginationPayload['page'] ?? 1
            );

            return [
                'beneficiary_payload' => $paginatedBeneficiaries->items(),
                'pagination_payload' => [
                    'meta' => generatePaginationMeta($paginatedBeneficiaries),
                    'links' => generatePaginationLinks($paginatedBeneficiaries)
                ],
            ];
        }

        $beneficiaries = $query->get();

        return [
            'beneficiary_payload' => $beneficiaries,
        ];
    }
}
