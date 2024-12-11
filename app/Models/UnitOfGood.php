<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UnitOfGood extends Model
{
    //
    protected $fillable = [
        'name',
    ];

    public function goods(): HasMany
    {
        return $this->hasMany(Good::class);
    }

    public function scopeNotYetDeleted(Builder $query)
    {
        $query->whereNull('deleted_at');
    }
}
