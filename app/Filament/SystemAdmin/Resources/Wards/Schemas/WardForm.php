<?php

namespace App\Filament\SystemAdmin\Resources\Wards\Schemas;

use App\Actions\Country\ListCountriesAction;
use App\Actions\LocalGovernmentArea\ListLocalGovernmentAreasAction;
use App\Actions\State\ListStatesAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class WardForm
{
    public static function configure(Schema $schema): Schema
    {
        $listCountriesAction = app(ListCountriesAction::class);

        $listStatesAction = app(ListStatesAction::class);

        $listLocalGovernmentAreasAction = app(ListLocalGovernmentAreasAction::class);

        ['country_payload' => $countries] = $listCountriesAction->execute([]);

        return $schema
            ->components([
                Select::make('country_id')
                    ->options($countries->pluck('name', 'id'))->label('Country')
                    ->required()
                    ->live(),

                Select::make('state_id')->label('State')
                    ->options(function (Get $get) use ($listStatesAction) {
                        ['state_payload' => $states] = $listStatesAction->execute([
                            'filter_record_options_payload' => [
                                'country_id' => $get('country_id')
                            ]
                        ]);

                        return $states->pluck('name', 'id');
                    })->default([]),
                Select::make('local_government_area_id')->label('Local Government Area')
                    ->options(function (Get $get) use ($listLocalGovernmentAreasAction) {
                        ['local_government_area_payload' => $localGovernmentAreas] = $listLocalGovernmentAreasAction->execute([
                            'filter_record_options_payload' => [
                                'country_id' => $get('country_id'),
                                'state_id' => $get('state_id'),
                            ]
                        ]);

                        return $localGovernmentAreas->pluck('name', 'id');
                    })->default([]),
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
