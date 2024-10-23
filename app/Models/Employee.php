<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'country_id',
        'state_id',
        'city_id',
        'department_id',
        'first_name',
        'last_name',
        'address',
        'zip_code',
        'date_of_birth',
        'date_hired',
    ];

    protected $dates = [
        'date_of_birth',
        'date_hired',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'datetime',
            'date_hired' => 'datetime',
            
        ];
    }

    public function country():BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function state():BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function city():BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function department():BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
