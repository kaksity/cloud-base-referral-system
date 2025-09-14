<?php

namespace App\Filament\SystemAdmin\Resources\Wards\Pages;

use App\Filament\SystemAdmin\Resources\Wards\WardResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWard extends ViewRecord
{
    protected static string $resource = WardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
