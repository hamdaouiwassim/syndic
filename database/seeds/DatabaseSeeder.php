<?php

use Illuminate\Database\Seeder;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        User::create([
            'name' => 'admin',
            'role' => 'ADMIN',
            'app_id' => 0,
            'password' => Hash::make('admin'),
        ]);
    }
}
