<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['found_item_id', 'student_name', 'email', 'contact_number', 'message', 'status'])]
class ItemRequest extends Model
{
    public function foundItem(): BelongsTo
    {
        return $this->belongsTo(FoundItem::class);
    }
}
