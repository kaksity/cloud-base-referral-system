<?php

namespace App\Filament\SystemAdmin\Resources\LocalGovernmentAreas\Schemas;

use App\Models\LocalGovernmentArea;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LocalGovernmentAreaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('country_id'),
                TextEntry::make('state_id'),
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
                    ->visible(fn (LocalGovernmentArea $record): bool => $record->trashed()),
            ]);
    }
}
