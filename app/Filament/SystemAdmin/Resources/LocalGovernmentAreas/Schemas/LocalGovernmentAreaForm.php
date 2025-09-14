<?php

namespace App\Filament\SystemAdmin\Resources\LocalGovernmentAreas\Schemas;

use App\Actions\Country\ListCountriesAction;
use App\Actions\State\ListStatesAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class LocalGovernmentAreaForm
{
    public static function configure(Schema $schema): Schema
    {
        $listCountriesAction = app(ListCountriesAction::class);

        $listStatesAction = app(ListStatesAction::class);

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
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
