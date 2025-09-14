<?php

namespace App\Filament\SystemAdmin\Resources\LocalGovernmentAreas\Pages;

use App\Filament\SystemAdmin\Resources\LocalGovernmentAreas\LocalGovernmentAreaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLocalGovernmentArea extends ViewRecord
{
    protected static string $resource = LocalGovernmentAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
