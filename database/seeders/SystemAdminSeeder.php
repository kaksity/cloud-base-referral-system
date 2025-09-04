<?php

namespace Database\Seeders;

use App\Models\SystemAdmin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SystemAdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        SystemAdmin::create([
            'first_name' => 'System',
            'last_name' => 'Admin',
            'email' => 'sysadmin@vuetify.ng',
            'password' => Hash::make('password'),
        ]);
    }
}
