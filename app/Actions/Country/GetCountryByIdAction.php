<?php

namespace App\Actions\Country;

use App\Models\Country;

class GetCountryByIdAction
{
    public function __construct(
        private Country $country
    )
    {
        
    }
    public function execute(string $countryId, array $relationships = [])
    {
        return $this->country->with(
            $relationships
        )->where([
            'id' => $countryId
        ])->first();
    }
}