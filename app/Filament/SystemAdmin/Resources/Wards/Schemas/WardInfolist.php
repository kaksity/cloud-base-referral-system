<?php

namespace App\Filament\SystemAdmin\Resources\Wards\Schemas;

use App\Models\Ward;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class WardInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('country_id'),
                TextEntry::make('state_id'),
                TextEntry::make('local_government_area_id'),
                TextEntry::make('name'),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Ward $record): bool => $record->trashed()),
            ]);
    }
}
