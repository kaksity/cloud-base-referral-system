<?php

namespace App\Filament\SystemAdmin\Resources\Sectors\Pages;

use App\Filament\SystemAdmin\Resources\Sectors\SectorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSector extends ViewRecord
{
    protected static string $resource = SectorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
