<?php

namespace App\Actions\Country;

use App\Models\Country;

class UpdateCountryAction
{
    public function __construct(
        private Country $country
    )
    {
        
    }
    public function execute(array $updateCountryRecordOptions)
    {
        $countryId = $updateCountryRecordOptions['id'];
        $data = $updateCountryRecordOptions['data'];

        return $this->country->where([
            'id' => $countryId
        ])->update($data);
    }
}