<?php

namespace App\Filament\SystemAdmin\Resources\Organizations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class CreateOrganizationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('Organization')->schema([
                    TextInput::make('organization.name')
                        ->required(),
                    TextInput::make('organization.acronym')
                        ->required(),
                    Textarea::make('organization.description')
                        ->required()
                        ->columnSpanFull(),
                    TextInput::make('organization.office_address')
                        ->required(),
                    TextInput::make('organization.official_email')
                        ->email()
                        ->required(),
                    TextInput::make('organization.logo_url')
                        ->url(),
                ]),
                Fieldset::make('Organization Admin')
                    ->schema([
                        TextInput::make('organization_admin.first_name')
                            ->required(),
                        TextInput::make('organization_admin.middle_name'),
                        TextInput::make('organization_admin.last_name')
                            ->required(),
                        TextInput::make('organization_admin.mobile_number'),
                        TextInput::make('organization_admin.email')
                            ->email()
                            ->required(),
                    ])
            ]);
    }
}
