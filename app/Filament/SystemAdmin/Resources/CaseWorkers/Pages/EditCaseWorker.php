<?php

namespace App\Filament\SystemAdmin\Resources\CaseWorkers\Pages;

use App\Filament\SystemAdmin\Resources\CaseWorkers\CaseWorkerResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCaseWorker extends EditRecord
{
    protected static string $resource = CaseWorkerResource::class;

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
