<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['payment_detail', 'amount', 'business_process_id', 'payment_type_id', 'date', 'payment_status'];

    public function business_process()
    {
        return $this->belongsTo(BusinessProcess::class);
    }

    public function payment_type()
    {
        return $this->belongsTo(PaymentType::class);
    }
}