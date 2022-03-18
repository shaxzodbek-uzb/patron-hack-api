<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['full_name', 'employee_position_id'];

    public function employee_position()
    {
        return $this->belongsTo(EmployeePosition::class);
    }

    public function organizational_structure()
    {
        return $this->belongsTo(OrganizationalStructure::class);
    }
}