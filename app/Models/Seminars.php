<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminars extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'date', 'location'];

    // Scope to get upcoming seminars
    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now())->orderBy('date', 'asc');
    }
}
