<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::crate([
            'name'=>'Aashish Aryal',
            'email'=>'aashish@spellsms.com',
            'password'=>Hash::make(12345678),
        ]);
    }
}
