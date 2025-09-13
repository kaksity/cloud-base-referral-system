<?php

namespace App\Filament\SystemAdmin\Resources\Beneficiaries\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BeneficiaryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('first_name')
                    ->required(),
                TextInput::make('middle_name'),
                TextInput::make('last_name')
                    ->required(),
                TextInput::make('gender')
                    ->required(),
                TextInput::make('added_by_case_worker_id')
                    ->required(),
                TextInput::make('location_id')
                    ->required(),
                TextInput::make('age_group')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('active'),
            ]);
    }
}
