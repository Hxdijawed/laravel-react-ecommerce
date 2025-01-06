<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Correct namespace for BelongsTo relationship
use Spatie\MediaLibrary\HasMedia; // Import HasMedia
use Spatie\MediaLibrary\InteractsWithMedia; // Import InteractsWithMedia
use Spatie\MediaLibrary\MediaCollections\Models\Media; // Correct import for Media class

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

    /**
     * Register media conversions for the product.
     *
     * @param Media|null $media
     * @return void
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(100);
        $this->addMediaConversion('small')
            ->width(400);
        $this->addMediaConversion('large')
            ->width(1200);
    }

    /**
     * Get the department associated with the product.
     *
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class); // Define the relationship to the Department model
    }

    /**
     * Get the category associated with the product.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class); // Define the relationship to the Category model
    }
}
