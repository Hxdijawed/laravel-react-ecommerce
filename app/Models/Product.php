<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function department():BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

