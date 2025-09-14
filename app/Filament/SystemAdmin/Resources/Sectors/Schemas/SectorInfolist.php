<?php

namespace App\Filament\SystemAdmin\Resources\Sectors\Schemas;

use App\Models\Sector;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SectorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('name'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Sector $record): bool => $record->trashed()),
            ]);
    }
}
