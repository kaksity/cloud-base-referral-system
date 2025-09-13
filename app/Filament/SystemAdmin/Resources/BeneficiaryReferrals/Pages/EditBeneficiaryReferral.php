<?php

namespace App\Filament\SystemAdmin\Resources\BeneficiaryReferrals\Pages;

use App\Filament\SystemAdmin\Resources\BeneficiaryReferrals\BeneficiaryReferralResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBeneficiaryReferral extends EditRecord
{
    protected static string $resource = BeneficiaryReferralResource::class;

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
