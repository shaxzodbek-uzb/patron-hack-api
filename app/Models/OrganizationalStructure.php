<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationalStructure extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(OrganizationalStructure::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(OrganizationalStructure::class, 'parent_id');
    }

    // employee_positions
    public function employee_positions()
    {
        return $this->hasMany(EmployeePosition::class);
    }

    // classification_groups
    public function classification_groups()
    {
        return $this->belongsToMany(ClassificationGroup::class);
    }
}