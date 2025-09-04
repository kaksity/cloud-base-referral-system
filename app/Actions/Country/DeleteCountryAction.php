<?php

namespace App\Actions\Country;

use App\Models\Country;

class DeleteCountryAction
{
    public function __construct(
        private Country $country
    )
    {
        
    }
    public function execute(string $countryId)
    {
        return $this->country->where([
            'id' => $countryId
        ])->delete();
    }
}