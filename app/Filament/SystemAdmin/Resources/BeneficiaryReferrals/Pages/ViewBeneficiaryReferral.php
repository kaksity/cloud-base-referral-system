<?php

namespace App\Filament\SystemAdmin\Resources\BeneficiaryReferrals\Pages;

use App\Filament\SystemAdmin\Resources\BeneficiaryReferrals\BeneficiaryReferralResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBeneficiaryReferral extends ViewRecord
{
    protected static string $resource = BeneficiaryReferralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
