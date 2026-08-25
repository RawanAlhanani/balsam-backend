<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class LoginAdmin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'login_admins';

    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    protected $hidden = [
        'password',
    ];

    // Relationships
    public function permissions()
    {
        return $this->belongsToMany(\App\Permission::class, 'user_permissions', 'user_id', 'permission_id');
    }

    public function revokedPermissions()
    {
        return $this->belongsToMany(\App\Permission::class, 'revoked_permissions', 'user_id', 'permission_id')
            ->select('permissions.*', 'revoked_permissions.id as pivot_id');
    }

    // Check if user has a specific permission
    public function hasPermission($permissionName)
    {
        // President has all permissions automatically
        if ($this->role === 'president') {
            return true;
        }

        // Check if permission is revoked
        if ($this->revokedPermissions()->where('name', $permissionName)->exists()) {
            return false;
        }

        // Check direct user permissions
        if ($this->permissions()->where('name', $permissionName)->exists()) {
            return true;
        }

        // Check role-based permissions
        return \App\Permission::where('name', $permissionName)
            ->whereHas('roles', function($query) {
                $query->where('role_permissions.role', $this->role);
            })
            ->exists();
    }

    // Get all permissions for the user (role permissions + direct permissions - revoked permissions)
    public function getAllPermissions()
    {
        // President gets all permissions
        if ($this->role === 'president') {
            return \App\Permission::all();
        }

        // Get role-based permissions
        $rolePermissions = \App\Permission::whereHas('roles', function($query) {
            $query->where('role_permissions.role', $this->role);
        })->get();

        // Get direct user permissions
        $userPermissions = $this->permissions;

        // Get revoked permission IDs
        $revokedPermissionIds = $this->revokedPermissions()->pluck('id')->toArray();

        // Merge role and direct permissions
        $allPermissions = $rolePermissions->merge($userPermissions);

        // Return unique permissions, excluding revoked ones
        return $allPermissions->unique('id')
            ->reject(function ($permission) use ($revokedPermissionIds) {
                return in_array($permission->id, $revokedPermissionIds);
            })
            ->values();
    }

    // Assign a permission to this user
    public function givePermission($permissionName)
    {
        $permission = \App\Permission::where('name', $permissionName)->first();
        if ($permission) {
            $this->permissions()->syncWithoutDetaching([$permission->id]);
        }
    }

    // Revoke a permission from this user
    public function revokePermission($permissionName)
    {
        $permission = \App\Permission::where('name', $permissionName)->first();
        if ($permission) {
            $this->permissions()->detach($permission->id);
            $this->revokedPermissions()->syncWithoutDetaching([$permission->id]);
        }
    }

    // Check if user can assign permissions (only president)
    public function canAssignPermissions()
    {
        return $this->role === 'president';
    }
}
