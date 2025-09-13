<?php

namespace App\Filament\SystemAdmin\Resources\Services\Schemas;

use App\Models\Service;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ServiceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('sector_id'),
                TextEntry::make('organization_id'),
                TextEntry::make('location_id'),
                TextEntry::make('name'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Service $record): bool => $record->trashed()),
            ]);
    }
}
