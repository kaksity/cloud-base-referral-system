<?php

namespace App\Filament\SystemAdmin\Resources\Beneficiaries\Schemas;

use App\Models\Beneficiary;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BeneficiaryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('first_name'),
                TextEntry::make('middle_name')
                    ->placeholder('-'),
                TextEntry::make('last_name'),
                TextEntry::make('gender'),
                TextEntry::make('added_by_case_worker_id'),
                TextEntry::make('location_id'),
                TextEntry::make('age_group'),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Beneficiary $record): bool => $record->trashed()),
            ]);
    }
}
