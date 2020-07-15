<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::findByName('super-admin')->delete();
        
        Role::updateOrCreate([
            'name' => 'super-admin'
        ]);

        User::updateOrCreate([
            'name' => 'Charles Kauta',
            'email' => 'admin@test.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('super-admin');
    }
}
