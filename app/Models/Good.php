<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Good extends Model
{
    use HasFactory;

    public function unitOfGood(): BelongsTo
    {
        return $this->belongsTo(UnitOfGood::class);
    }

    public function scopeNotYetDeleted(Builder $query)
    {
        $query->whereNull('goods.deleted_at');
    }
}
