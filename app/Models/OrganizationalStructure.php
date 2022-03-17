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
}