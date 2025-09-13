<?php

namespace App\Filament\SystemAdmin\Resources\CaseWorkers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CaseWorkerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('current_organization_id')
                    ->required(),
                TextInput::make('added_by_organization_admin_id')
                    ->required(),
                TextInput::make('current_location_id')
                    ->required(),
                TextInput::make('first_name')
                    ->required(),
                TextInput::make('middle_name')
                    ->required(),
                TextInput::make('last_name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('active'),
            ]);
    }
}
