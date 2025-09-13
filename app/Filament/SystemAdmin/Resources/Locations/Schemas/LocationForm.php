<?php

namespace App\Filament\SystemAdmin\Resources\Locations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('country_id')
                    ->required(),
                TextInput::make('state_id')
                    ->required(),
                TextInput::make('local_government_area_id')
                    ->required(),
                TextInput::make('ward_id')
                    ->required(),
                TextInput::make('organization_id')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('active'),
            ]);
    }
}
