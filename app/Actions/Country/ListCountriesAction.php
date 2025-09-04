<?php

namespace App\Actions\Country;

use App\Models\Country;

class ListCountriesAction
{
    public function __construct(
        private Country $country
    ) {}

    public function execute(array $listCountriesRecordOptions, array $relationships = [])
    {
        $paginationPayload = $listCountriesRecordOptions['pagination_payload'] ?? null;
        $filterRecordOptionsPayload = $listCountriesRecordOptions['filter_record_options_payload'] ?? null;

        $query = $this->country->query()
            ->with($relationships)
            ->orderBy('created_at', 'asc');

        if ($paginationPayload) {
            $paginatedCountries = $query->paginate(
                $paginationPayload['limit'] ?? config('businessConfig.default_page_limit'),
                ['*'],
                'page',
                $paginationPayload['page'] ?? 1
            );

            return [
                'country_payload' => $paginatedCountries->items(),
                'pagination_payload' => [
                    'meta' => generatePaginationMeta($paginatedCountries),
                    'links' => generatePaginationLinks($paginatedCountries)
                ],
            ];
        }

        $countries = $query->get();

        return [
            'country_payload' => $countries,
        ];
    }
}
