<?php

namespace App\Filament\SystemAdmin\Resources\BeneficiaryReferrals\Schemas;

use App\Models\BeneficiaryReferral;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BeneficiaryReferralInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('beneficiary_id'),
                TextEntry::make('organization_id'),
                TextEntry::make('location_id'),
                TextEntry::make('services')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (BeneficiaryReferral $record): bool => $record->trashed()),
            ]);
    }
}
