<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Student;
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
        
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        // User::create([
        //     'name' => 'SMA Negeri 1 Padang',
        //     'email' => 'sman1pdg@gmail.com',
        //     'password' => bcrypt('sman1')
        // ]);

        // User::create([
        //     'name' => 'SMA Negeri 3 Padang',
        //     'email' => 'sman3pdg@gmail.com',
        //     'password' => bcrypt('sman3')
        // ]);

        // User::create([
        //     'name' => 'SMA Negeri 5 Padang',
        //     'email' => 'sman5pdg@gmail.com',
        //     'password' => bcrypt('sman5')
        // ]);
        
        User::factory(6)->create();
        
        Category::create([
            'name' => 'Rendah',
            'slug' => 'rendah'
        ]);

        Category::create([
            'name' => 'Normal',
            'slug' => 'normal'
        ]);
        Category::create([
            'name' => 'Tinggi',
            'slug' => 'tinggi'
        ]);

        Student::factory(20)->create();


        // Student::create([
        //     'name' => 'Karinda Najla Shahira',
        //     'slug' => 'karinda-najla-shahira',
        //     'sch_name' => 'SMAN 1 Padang',
        //     'user_id' => 1,
        //     'class' => 'XII IPA 8',
        //     'gender' => 'P',
        //     'age' => 17,
        //     'category_id' => 1
        // ]);

        // Student::create([
        //     'name' => 'Alya Damayanti Rivani',
        //     'slug' => 'alya-damayanti-rivani',
        //     'sch_name' => 'SMAN 1 Padang',
        //     'user_id' => 1,
        //     'class' => 'XII IPA 8',
        //     'gender' => 'P',
        //     'age' => 17,
        //     'category_id' => 2
        // ]);

        // Student::create([
        //     'name' => 'Dzikri Gemilang',
        //     'slug' => 'dzikri-gemilang',
        //     'sch_name' => 'SMAN 3 Padang',
        //     'user_id' => 2,
        //     'class' => 'X E.7',
        //     'gender' => 'L',
        //     'age' => 15,
        //     'category_id' => 3
        // ]);

        // Student::create([
        //     'name' => 'Rahma Fadilla',
        //     'slug' => 'rahma-fadilla',
        //     'sch_name' => 'SMAN 5 Padang',
        //     'user_id' => 3,
        //     'class' => 'XII MIPA 1',
        //     'gender' => 'P',
        //     'age' => 17,
        //     'category_id' => 3
        // ]);
    }
}
