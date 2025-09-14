<?php

namespace App\Filament\SystemAdmin\Resources\Wards\Pages;

use App\Filament\SystemAdmin\Resources\Wards\WardResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWards extends ListRecords
{
    protected static string $resource = WardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
