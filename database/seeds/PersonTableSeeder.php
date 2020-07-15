<?php

use App\Person;
use Illuminate\Database\Seeder;

class PersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $people = [
            'Dean of Students',
            'Examination Officer',
            'Admission Officer',
            'System Administrator',
            'loan_officer',
            'dispensary',
            'warden',
            'mustso',
            'other',
        ];


        foreach ($people as $person) {
            Person::create([
                'name' => str_slug($person, '_')
            ]);
        }
    }
}
