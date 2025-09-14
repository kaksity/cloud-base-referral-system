<?php

namespace App\Filament\SystemAdmin\Resources\Countries\Pages;

use App\Filament\SystemAdmin\Resources\Countries\CountryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCountry extends CreateRecord
{
    protected static string $resource = CountryResource::class;
}
