<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Import the Str class

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Electronics',
                'slug' => 'electronics',  // Fixed the slug method
                'active' => true,  // Corrected the boolean value
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
                'active' => true,  // Corrected the boolean value
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Home, Garden & Tools',
                'slug' => Str::slug('Home, Garden & Tools'),  // Fixed the slug method
                'active' => true,  // Corrected the boolean value
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Books & Audible',
                'slug' => Str::slug('Books & Audibles'),  // Fixed the slug method
                'active' => true,  // Corrected the boolean value
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Health & Beauty',
                'slug' => Str::slug('Health & Beauty'),  // Fixed the slug method
                'active' => true,  // Corrected the boolean value
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('departments')->insert($departments); 
    }
}
