<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Client;
use App\Models\Organization;
use App\Models\Project;
use App\Models\Recrutment;
use App\Models\User;
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
        User::factory(3)->create();
        Client::create([
            'name' => 'Hamzah',
            'address' => 'sana sini',
            'email' => 'test@example.com',
        ]);
        Organization::factory(1)->create();
        Recrutment::factory(3)->create();
        Project::factory(3)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
