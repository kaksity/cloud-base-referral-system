<?php

namespace App\Filament\SystemAdmin\Resources\Services\Pages;

use App\Filament\SystemAdmin\Resources\Services\ServiceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;
}
