<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'classification_group_id',
        'min_rate',
        'max_rate',
        'high_rate',
        'low_rate',
        'middle_rate',
    ];

    public function classification_group()
    {
        return $this->belongsTo(ClassificationGroup::class);
    }
}
