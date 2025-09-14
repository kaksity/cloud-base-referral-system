<?php

namespace App\Filament\SystemAdmin\Resources\LocalGovernmentAreas\Pages;

use App\Filament\SystemAdmin\Resources\LocalGovernmentAreas\LocalGovernmentAreaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLocalGovernmentArea extends EditRecord
{
    protected static string $resource = LocalGovernmentAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
