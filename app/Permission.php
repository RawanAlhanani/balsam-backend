<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name', 'display_name', 'description', 'module'
    ];

    // Relationship with roles
    public function roles()
    {
        return $this->belongsToMany(\App\LoginAdmin::class, 'role_permissions', 'permission_id', 'role', 'id', 'role');
    }

    // Relationship with users
    public function users()
    {
        return $this->belongsToMany(\App\LoginAdmin::class, 'user_permissions', 'permission_id', 'user_id');
    }
}
