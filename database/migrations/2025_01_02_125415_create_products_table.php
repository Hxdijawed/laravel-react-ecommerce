<?php

namespace App\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID for the product
            $table->string('title', 200); // Title of the product
            $table->string('slug', 200); // Slug for the product
            $table->longText('description'); // Description of the product
            $table->foreignId('department_id')
                ->index()
                ->constrained('departments') // Foreign key to 'departments' table
                ->onDelete('cascade'); // Optional: Define the action when the department is deleted
            $table->foreignId('category_id')
                ->index()
                ->constrained('categories') // Foreign key to 'categories' table
                ->onDelete('cascade'); // Optional: Define the action when the category is deleted
            $table->decimal('price', 20, 4); // Price of the product
            $table->string('status')->index(); // Status of the product (indexed for fast queries)
            $table->integer('quantity')->nullable(); // Quantity (nullable field)
            $table->foreignIdFor(User::class, 'created_by'); // Foreign key to 'users' table (creator)
            $table->foreignIdFor(User::class, 'updated_by'); // Foreign key to 'users' table (updater)
            $table->timestamp('deleted_at')->nullable(); // Soft delete timestamp
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products'); // Drop the products table if it exists
    }
};
