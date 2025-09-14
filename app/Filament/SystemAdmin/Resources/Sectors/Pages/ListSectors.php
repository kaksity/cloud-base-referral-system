<?php

namespace App\Filament\SystemAdmin\Resources\Sectors\Pages;

use App\Filament\SystemAdmin\Resources\Sectors\SectorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSectors extends ListRecords
{
    protected static string $resource = SectorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
