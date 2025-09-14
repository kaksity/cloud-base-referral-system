<?php

namespace App\Filament\SystemAdmin\Resources\LocalGovernmentAreas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LocalGovernmentAreaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('country_id')
                    ->required(),
                TextInput::make('state_id')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('active'),
            ]);
    }
}
