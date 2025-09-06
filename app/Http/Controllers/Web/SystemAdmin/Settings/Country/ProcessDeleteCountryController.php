<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\Country;

use App\Actions\Country\GetCountryByIdAction;
use App\Actions\Country\DeleteCountryAction;
use App\Http\Controllers\Controller;

class ProcessDeleteCountryController extends Controller
{
    public function __construct(
        private GetCountryByIdAction $getCountryByIdAction,
        private DeleteCountryAction $deleteCountryAction
    ) {}

    public function __invoke(string $countryId)
    {
        $country = $this->getCountryByIdAction->execute($countryId);

        if (is_null($country)) {
            return back()->with('error', 'Country record does not exists');
        }

        $this->deleteCountryAction->execute($countryId);

        return back()->with('success', 'Country record was deleted successfully');
    }
}
