<?php

namespace App\Filament\SystemAdmin\Resources\CaseWorkers\Pages;

use App\Filament\SystemAdmin\Resources\CaseWorkers\CaseWorkerResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCaseWorker extends ViewRecord
{
    protected static string $resource = CaseWorkerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
