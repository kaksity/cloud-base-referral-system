<?php

namespace App\Filament\SystemAdmin\Resources\BeneficiaryReferrals\Pages;

use App\Filament\SystemAdmin\Resources\BeneficiaryReferrals\BeneficiaryReferralResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBeneficiaryReferrals extends ListRecords
{
    protected static string $resource = BeneficiaryReferralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
