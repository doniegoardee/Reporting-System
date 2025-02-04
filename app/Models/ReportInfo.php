<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportInfo extends Model
{
    use HasFactory;

    protected $fillable = ['report_id', 'details'];

    public function report()
    {
        return $this->belongsTo(Reports::class);
    }
}
