<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;

    protected $table = "Reports";
    protected $fillable = [
        'subject_type',
        'location',
        'status',
        'description',
        'severity',
        'num_affected',
        'needs',
        'image',
    ];

    public function incidentType()
    {
        return $this->belongsTo(IncidentType::class, 'subject_type');
    }
}