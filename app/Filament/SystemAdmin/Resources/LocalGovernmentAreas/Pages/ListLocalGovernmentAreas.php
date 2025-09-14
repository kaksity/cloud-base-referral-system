<?php

namespace App\Filament\SystemAdmin\Resources\LocalGovernmentAreas\Pages;

use App\Filament\SystemAdmin\Resources\LocalGovernmentAreas\LocalGovernmentAreaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLocalGovernmentAreas extends ListRecords
{
    protected static string $resource = LocalGovernmentAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
