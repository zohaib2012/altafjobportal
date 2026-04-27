<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'title', 'department', 'bps', 'vacancies',
        'age_limit', 'qualification_required', 'domicile',
        'fee_amount', 'is_active'
    ];

    protected $casts = [
        'fee_amount' => 'decimal:2',
        'is_active'  => 'boolean',
        'vacancies'  => 'integer',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
