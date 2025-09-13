<?php

namespace App\Filament\SystemAdmin\Resources\Organizations\Schemas;

use App\Models\Organization;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrganizationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('added_by_system_admin_id'),
                TextEntry::make('name'),
                TextEntry::make('acronym'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('office_address'),
                TextEntry::make('official_email'),
                TextEntry::make('logo_url')
                    ->placeholder('-'),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Organization $record): bool => $record->trashed()),
            ]);
    }
}
