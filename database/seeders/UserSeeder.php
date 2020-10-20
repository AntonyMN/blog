<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!User::where('email', 'admin@email.com')->first()){
            User::create([
                'name' => 'Admin Admin',
                'email' => 'admin@email.com',
                'password' => bcrypt('admin123'),
                'admin' => true,
            ]);
        }

        $faker = \Faker\Factory::create();

        for ($i=0; $i < 99; $i++) {
            User::create([
                'name' => $faker->unique->name,
                'email' => $faker->unique->email,
                'password' => bcrypt('admin123'),
                'admin' => false,
            ]);
        }
    }
}
