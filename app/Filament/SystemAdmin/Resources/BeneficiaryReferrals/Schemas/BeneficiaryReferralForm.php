<?php

namespace App\Filament\SystemAdmin\Resources\BeneficiaryReferrals\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BeneficiaryReferralForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('beneficiary_id')
                    ->required(),
                TextInput::make('organization_id')
                    ->required(),
                TextInput::make('location_id')
                    ->required(),
                Textarea::make('services')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
