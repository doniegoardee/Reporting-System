<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;

    protected $table = "Reports";
    protected $fillable = [
        'user_id',
        'subject_type',
        'location',
        'zone',
        'status',
        'description',
        'severity',
        'num_affected',
        'needs',
        'image',
        'contact',
        'responding_agency',
        'resolved_time'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'resolved_time' => 'datetime',
    ];

    public function incidentType()
    {
        return $this->belongsTo(IncidentType::class, 'subject_type');
    }
}
