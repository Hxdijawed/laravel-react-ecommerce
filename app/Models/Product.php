<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Correct namespace for BelongsTo relationship

class Product extends Model
{
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class); // Define the relationship to the Department model
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class); // Define the relationship to the Category model
    }
}
