<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassificationGroup extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code'];
}