<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['name'];

    public function getFeatureNameAttribute()
    {
        return $this->name;
    }
    
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
