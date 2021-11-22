<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'Aashish Aryal','phone'=>'9867182424','message'=>"This is message"],
            ['name'=>'Aashish Aryal','phone'=>'9848048781','message'=>"This is message"],
        ];

        foreach($data as $d){
            Student::create($d);
        }
    }
}
