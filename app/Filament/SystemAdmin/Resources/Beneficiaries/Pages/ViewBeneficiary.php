<?php

namespace App\Filament\SystemAdmin\Resources\Beneficiaries\Pages;

use App\Filament\SystemAdmin\Resources\Beneficiaries\BeneficiaryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBeneficiary extends ViewRecord
{
    protected static string $resource = BeneficiaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
