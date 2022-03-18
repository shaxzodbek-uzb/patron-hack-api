<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'classification_group_id', 'classifications', 'result'];
    protected $casts = [
        'classifications' => 'array',
    ];
}