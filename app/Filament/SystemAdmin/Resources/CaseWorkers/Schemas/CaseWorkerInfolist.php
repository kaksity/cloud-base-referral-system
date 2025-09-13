<?php

namespace App\Filament\SystemAdmin\Resources\CaseWorkers\Schemas;

use App\Models\CaseWorker;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CaseWorkerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('current_organization_id'),
                TextEntry::make('added_by_organization_admin_id'),
                TextEntry::make('current_location_id'),
                TextEntry::make('first_name'),
                TextEntry::make('middle_name'),
                TextEntry::make('last_name'),
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
                    ->visible(fn (CaseWorker $record): bool => $record->trashed()),
            ]);
    }
}
