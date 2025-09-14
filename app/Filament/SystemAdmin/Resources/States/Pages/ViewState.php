<?php

namespace App\Filament\SystemAdmin\Resources\States\Pages;

use App\Filament\SystemAdmin\Resources\States\StateResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewState extends ViewRecord
{
    protected static string $resource = StateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
