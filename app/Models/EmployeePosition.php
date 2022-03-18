<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'salary', 'organizational_structure_id'];

    public function organizational_structure()
    {
        return $this->belongsTo(OrganizationalStructure::class);
    }

    //employees
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}