<?php

namespace App\Filament\SystemAdmin\Resources\Locations\Schemas;

use App\Models\Location;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LocationInfolist
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
                TextEntry::make('ward_id'),
                TextEntry::make('organization_id'),
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
                    ->visible(fn (Location $record): bool => $record->trashed()),
            ]);
    }
}
