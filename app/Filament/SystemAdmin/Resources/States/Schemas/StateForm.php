<?php

namespace App\Filament\SystemAdmin\Resources\States\Schemas;

use App\Actions\Country\ListCountriesAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StateForm 
{
    public static function configure(Schema $schema): Schema
    {
        $listCountriesAction = app(ListCountriesAction::class);

        ['country_payload' => $countries] = $listCountriesAction->execute([]);
        return $schema
            ->components([
                Select::make('country_id')->label('Country')->required()->options($countries->pluck('name', 'id')),

                TextInput::make('name')
                    ->required(),
            ]);
    }
}
