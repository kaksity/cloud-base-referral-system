<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $country = Country::first();

        if(is_null($country)) {
            throw new Exception('Country does not exists');
        }

        $states = [];
        DB::transaction(function() use($country, $states) {
            foreach ($states as $state) {
                State::create(
                    array_merge(['country_id'], $state)
                );
            }
        });
    }
}
