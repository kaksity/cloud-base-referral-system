<?php

namespace App\Actions\BeneficiaryReferral;

use App\Models\BeneficiaryReferral;

class ListBeneficiaryReferralsAction
{
    public function __construct(
        private BeneficiaryReferral $beneficiaryReferral
    ) {}

    public function execute(array $listBeneficiaryReferralsRecordOptions, array $relationships = [])
    {
        $paginationPayload = $listBeneficiaryReferralsRecordOptions['pagination_payload'] ?? null;
        $filterRecordOptionsPayload = $listBeneficiaryReferralsRecordOptions['filter_record_options_payload'] ?? null;

        $query = $this->beneficiaryReferral->query()
            ->with($relationships)
            ->orderBy('created_at', 'asc');

        if ($paginationPayload) {
            $paginatedBeneficiaryReferrals = $query->paginate(
                $paginationPayload['limit'] ?? config('businessConfig.default_page_limit'),
                ['*'],
                'page',
                $paginationPayload['page'] ?? 1
            );

            return [
                'beneficiary_referral_payload' => $paginatedBeneficiaryReferrals->items(),
                'pagination_payload' => [
                    'meta' => generatePaginationMeta($paginatedBeneficiaryReferrals),
                    'links' => generatePaginationLinks($paginatedBeneficiaryReferrals)
                ],
            ];
        }

        $beneficiaryReferrals = $query->get();

        return [
            'beneficiary_referral_payload' => $beneficiaryReferrals,
        ];
    }
}
