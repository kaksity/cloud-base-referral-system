<?php

namespace App\Filament\SystemAdmin\Resources\OrganizationAdmins\Schemas;

use App\Models\OrganizationAdmin;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrganizationAdminInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('organization_id'),
                TextEntry::make('added_by_system_admin_id'),
                TextEntry::make('first_name'),
                TextEntry::make('middle_name')
                    ->placeholder('-'),
                TextEntry::make('last_name'),
                TextEntry::make('mobile_number')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (OrganizationAdmin $record): bool => $record->trashed()),
            ]);
    }
}
