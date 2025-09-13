<?php

namespace App\Filament\SystemAdmin\Resources\Organizations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class EditOrganizationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('Organization')->schema([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('acronym')
                        ->required(),
                    Textarea::make('description')
                        ->required()
                        ->columnSpanFull(),
                    TextInput::make('office_address')
                        ->required(),
                    TextInput::make('official_email')
                        ->email()
                        ->required(),
                    TextInput::make('logo_url')
                        ->url(),
                ]),
            ]);
    }
}
