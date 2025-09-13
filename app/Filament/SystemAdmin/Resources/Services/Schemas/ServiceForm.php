<?php

namespace App\Filament\SystemAdmin\Resources\Services\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('sector_id')
                    ->required(),
                TextInput::make('organization_id')
                    ->required(),
                TextInput::make('location_id')
                    ->required(),
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
