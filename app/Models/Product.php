<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Correct namespace for BelongsTo relationship
use Spatie\MediaLibrary\HasMedia; // Import HasMedia
use Spatie\MediaLibrary\InteractsWithMedia; // Import InteractsWithMedia

class Product extends Model implements HasMedia
{
    use InteractsWithMedia; // Added missing semicolon

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class); // Define the relationship to the Department model
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class); // Define the relationship to the Category model
    }
}
