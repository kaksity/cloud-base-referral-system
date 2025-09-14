<?php

namespace App\Filament\SystemAdmin\Resources\Services\Schemas;

use App\Actions\Location\ListLocationsAction;
use App\Actions\Organization\ListOrganizationsAction;
use App\Actions\Sector\ListSectorsAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        $listOrganizationsAction = app(ListOrganizationsAction::class);

        $listSectorsAction = app(ListSectorsAction::class);

        $listLocationsAction = app(ListLocationsAction::class);

        ['organization_payload' => $organizations] = $listOrganizationsAction->execute([]);

        ['sector_payload' => $sectors] = $listSectorsAction->execute([]);

        return $schema
            ->components([
                Select::make('sector_id')
                    ->options($sectors->pluck('name', 'id'))->label('Sector')
                    ->required(),
                Select::make('organization_id')
                    ->options($organizations->pluck('name', 'id'))->label('Organization')
                    ->required()
                    ->live(),
                Select::make('location_id')->label('Location')
                    ->options(function (Get $get) use ($listLocationsAction) {
                        ['location_payload' => $locations] = $listLocationsAction->execute([
                            'filter_record_options_payload' => [
                                'organization_id' => $get('organization_id')
                            ]
                        ]);

                        return $locations->pluck('name', 'id');
                    })->default([]),
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
