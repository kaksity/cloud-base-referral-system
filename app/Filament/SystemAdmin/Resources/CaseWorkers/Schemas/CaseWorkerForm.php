<?php

namespace App\Filament\SystemAdmin\Resources\CaseWorkers\Schemas;

use App\Actions\Location\ListLocationsAction;
use App\Actions\Organization\ListOrganizationsAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class CaseWorkerForm
{
    public static function configure(Schema $schema): Schema
    {
        $listOrganizationsAction = app(ListOrganizationsAction::class);

        $listLocationsAction = app(ListLocationsAction::class);

        ['organization_payload' => $organizations] = $listOrganizationsAction->execute([]);

        return $schema
            ->components([
                Select::make('current_organization_id')
                    ->options($organizations->pluck('name', 'id'))->label('Organization')
                    ->required()
                    ->live(),
                Select::make('current_location_id')->label('Location')
                    ->options(function (Get $get) use ($listLocationsAction) {
                        ['location_payload' => $locations] = $listLocationsAction->execute([
                            'filter_record_options_payload' => [
                                'organization_id' => $get('current_organization_id')
                            ]
                        ]);

                        return $locations->pluck('name', 'id');
                    })->default([]),
                TextInput::make('first_name')
                    ->required(),
                TextInput::make('middle_name'),
                TextInput::make('last_name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive'
                    ])->default('active')
                    ->required(),
            ]);
    }
}
