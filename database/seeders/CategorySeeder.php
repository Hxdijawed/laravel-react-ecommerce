<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'department_id' => 1,  // Assuming 'Books & Audibles' department has ID 1
                'parent_id' => null,    // No parent category
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fashion',
                'department_id' => 2,  // Assuming 'Books & Audibles' department has ID 1
                'parent_id' => null,    // No parent category
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Computers',
                'department_id' => 1,  // Assuming 'Shoes' department has ID 2
                'parent_id' => 1,    // No parent category
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Smart Phones',
                'department_id' => 1,  // Assuming 'Shoes' department has ID 2
                'parent_id' => 1,      // Parent category is 'Sports Shoes' (ID 3)
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laptops',
                'department_id' => 1,  // Assuming 'Shoes' department has ID 2
                'parent_id' => 1,      // Parent category is 'Sports Shoes' (ID 3)
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Androids',
                'department_id' => 1,  // Assuming 'Clothes' department has ID 3
                'parent_id' => 4,    // No parent category
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Iphones',
                'department_id' => 1,  // Assuming 'Clothes' department has ID 3
                'parent_id' => 4,    // No parent category
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sweaters',
                'department_id' => 2,  // Assuming 'Clothes' department has ID 3
                'parent_id' => 2,    // No parent category
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
       DB::table('Categories')->insert($categories);
    }

}
