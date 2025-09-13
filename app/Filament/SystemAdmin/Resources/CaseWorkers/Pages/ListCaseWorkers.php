<?php

namespace App\Filament\SystemAdmin\Resources\CaseWorkers\Pages;

use App\Filament\SystemAdmin\Resources\CaseWorkers\CaseWorkerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCaseWorkers extends ListRecords
{
    protected static string $resource = CaseWorkerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
