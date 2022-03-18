<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessProcess extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'payment_detail', 'payment_amount', 'classification_group_id', 'status'];

    public function classification_group()
    {
        return $this->belongsTo(ClassificationGroup::class);
    }

    public function classifications()
    {
        return $this->belongsToMany(Classification::class)->orderBy('code')->withPivot(
            'file',
            'date_start',
            'date_finish',
            'done',
            'time_rate',
            'quality_rate',
        );
    }
}