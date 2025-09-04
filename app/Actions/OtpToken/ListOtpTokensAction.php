<?php

namespace App\Actions\OtpToken;

use App\Models\OtpToken;

class ListOtpTokensAction
{
    public function __construct(
        private OtpToken $otpToken
    ) {}

    public function execute(array $listOtpTokensRecordOptions, array $relationships = [])
    {
        $paginationPayload = $listOtpTokensRecordOptions['pagination_payload'] ?? null;
        $filterRecordOptionsPayload = $listEmployeesRecordOptions['filter_record_options_payload'] ?? null;

        $query = $this->otpToken->query()
            ->with($relationships)
            ->orderBy('OtpToken_label', 'asc');

        if (!empty($filterRecordOptionsPayload['country_id'])) {
            $query->where('country_id', $filterRecordOptionsPayload['country_id']);
        }

        if ($paginationPayload) {
            $paginatedOtpTokens = $query->paginate(
                $paginationPayload['limit'] ?? config('businessConfig.default_page_limit'),
                ['*'],
                'page',
                $paginationPayload['page'] ?? 1
            );

            return [
                'otp_token_payload' => $paginatedOtpTokens->items(),
                'pagination_payload' => [
                    'meta' => generatePaginationMeta($paginatedOtpTokens),
                    'links' => generatePaginationLinks($paginatedOtpTokens)
                ],
            ];
        }

        $otpTokens = $query->get();

        return [
            'otp_token_payload' => $otpTokens,
        ];
    }
}
