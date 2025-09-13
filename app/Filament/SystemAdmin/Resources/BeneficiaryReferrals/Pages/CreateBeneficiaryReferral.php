<?php

namespace App\Filament\SystemAdmin\Resources\BeneficiaryReferrals\Pages;

use App\Filament\SystemAdmin\Resources\BeneficiaryReferrals\BeneficiaryReferralResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBeneficiaryReferral extends CreateRecord
{
    protected static string $resource = BeneficiaryReferralResource::class;
}
