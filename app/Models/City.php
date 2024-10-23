<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'state_id',
        'name',
    ];

    public function state():BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function employees():HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
