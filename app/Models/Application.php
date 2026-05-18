<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    protected $fillable = [
        'application_id', 'user_id', 'full_name', 'father_name', 'cnic', 'date_of_birth',
        'mobile', 'email', 'address', 'qualification', 'position_id',
        'status', 'admin_notes'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'status' => 'string',
    ];

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function documents()
    {
        return $this->hasOne(Document::class);
    }

    public function challan()
    {
        return $this->hasOne(Challan::class);
    }

    public function statusHistory()
    {
        return $this->hasMany(ApplicationStatusHistory::class)->orderBy('changed_at', 'desc');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeFilterByDate($query, $fromDate = null, $toDate = null)
    {
        if ($fromDate) {
            $query->whereDate('created_at', '>=', $fromDate);
        }
        if ($toDate) {
            $query->whereDate('created_at', '<=', $toDate);
        }
        return $query;
    }
}