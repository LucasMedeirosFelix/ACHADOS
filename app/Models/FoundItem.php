<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'description', 'found_at', 'location', 'image_path'])]
class FoundItem extends Model
{
    protected function casts(): array
    {
        return [
            'found_at' => 'date',
        ];
    }
}