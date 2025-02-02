<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    public function states():HasMany
    {
        return $this->hasMany(State::class);
    }

    public function employees():HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
