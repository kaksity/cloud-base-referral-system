<?php

namespace App\Filament\SystemAdmin\Resources\Beneficiaries\Pages;

use App\Filament\SystemAdmin\Resources\Beneficiaries\BeneficiaryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBeneficiaries extends ListRecords
{
    protected static string $resource = BeneficiaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
