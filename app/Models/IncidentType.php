<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'color','agency','contact','email'];

    public function reports()
    {
        return $this->hasMany(Reports::class, 'subject_type');
    }
}
