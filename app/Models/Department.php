<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;  // Import the HasMany class

class Department extends Model
{           
    public function categories(): HasMany
        {
            return $this->hasMany(Category::class);
        }
}
