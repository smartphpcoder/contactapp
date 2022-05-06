<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            User::factory()->count(5)->create(),
            Company::factory()->hasContacts(5)->count(50)->create(),
            CompaniesTableSeeder::class,
            ContactsTableSeeder::class,
        ]);
    }
}
