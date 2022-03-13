<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessProcess extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'payment_detail', 'payment_amount', 'classification_group_id'];
}