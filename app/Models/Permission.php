<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    const VIEWANY = "ViewAny";
    const VIEW = "View";
    const CREATE = "Create";
    const UPDATE = "Update";
    const DELETE = "Delete";
    
    protected $fillable = ['name', 'feature_id'];

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions', 'permission_id', 'role_id');
    }
}
