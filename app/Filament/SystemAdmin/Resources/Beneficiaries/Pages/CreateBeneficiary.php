<?php

namespace App\Filament\SystemAdmin\Resources\Beneficiaries\Pages;

use App\Filament\SystemAdmin\Resources\Beneficiaries\BeneficiaryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBeneficiary extends CreateRecord
{
    protected static string $resource = BeneficiaryResource::class;
}
