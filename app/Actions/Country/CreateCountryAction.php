<?php

namespace App\Actions\Country;

use App\Models\Country;

class CreateCountryAction
{
    public function __construct(
        private Country $country
    )
    {}

    public function execute(array $createCountryRecordOptions)
    {
        return $this->country->create(
            $createCountryRecordOptions
        );
    }
}