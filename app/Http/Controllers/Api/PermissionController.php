<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Permission;
use App\LoginAdmin;

class PermissionController extends Controller
{
    /**
     * Get current user's permissions
     */
    public function getCurrentUserPermissions()
    {
        $user = auth()->user();
        
        if (!$user) {
            return response()->json(['message' => 'غير مسموح لك بالدخول.'], 401);
        }

        if (!($user instanceof LoginAdmin)) {
            return response()->json(['message' => 'غير مسموح لك بالدخول. هذه الخدمة مخصصة لحسابات الإدارة فقط.'], 403);
        }

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ],
            'permissions' => $user->getAllPermissions()->pluck('name')->toArray(),
        ]);
    }

    /**
     * Get all available permissions
     */
    public function index()
    {
        $user = auth()->user();
        
        if (!($user instanceof LoginAdmin) || !$user->canAssignPermissions()) {
            return response()->json(['message' => 'غير مسموح لك بالدخول.'], 403);
        }

        $permissions = Permission::all();
        return response()->json($permissions);
    }

    /**
     * Get all admin users with their roles and permissions
     */
    public function getUsers()
    {
        $user = auth()->user();
        
        if (!($user instanceof LoginAdmin) || !$user->canAssignPermissions()) {
            return response()->json(['message' => 'غير مسموح لك بالدخول.'], 403);
        }

        $users = LoginAdmin::with('permissions', 'revokedPermissions')->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'permissions' => $user->getAllPermissions(),
                'direct_permissions' => $user->permissions,
                'revoked_permissions' => $user->revokedPermissions,
            ];
        });

        return response()->json($users);
    }

    /**
     * Get permissions for a specific user
     */
    public function getUserPermissions($userId)
    {
        $currentUser = auth()->user();
        
        if (!($currentUser instanceof LoginAdmin) || !$currentUser->canAssignPermissions()) {
            return response()->json(['message' => 'غير مسموح لك بالدخول.'], 403);
        }

        $user = LoginAdmin::with('permissions')->findOrFail($userId);
        
        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ],
            'permissions' => $user->getAllPermissions(),
            'direct_permissions' => $user->permissions,
            'revoked_permissions' => $user->revokedPermissions,
        ]);
    }

    /**
     * Assign permissions to a user
     */
    public function assignPermissions(Request $request, $userId)
    {
        $currentUser = auth()->user();
        
        if (!($currentUser instanceof LoginAdmin) || !$currentUser->canAssignPermissions()) {
            return response()->json(['message' => 'غير مسموح لك بالدخول.'], 403);
        }

        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ], [
            'permissions.array' => 'يجب أن تكون الصلاحيات مصفوفة.',
            'permissions.*.exists' => 'بعض الصلاحيات غير موجودة.',
        ]);

        $user = LoginAdmin::findOrFail($userId);

        // Cannot modify president's permissions (they have all automatically)
        if ($user->role === 'president') {
            return response()->json(['message' => 'لا يمكن تعديل صلاحيات الرئيس.'], 403);
        }

        try {
            // Get the user's role permissions
            $rolePermissionIds = \App\Permission::whereHas('roles', function($query) use ($user) {
                $query->where('role_permissions.role', $user->role);
            })->pluck('id')->toArray();

            // Separate selected permissions into role permissions and extra permissions
            $selectedRolePermissions = array_intersect($request->permissions, $rolePermissionIds);
            $selectedExtraPermissions = array_diff($request->permissions, $rolePermissionIds);

            // Sync direct permissions (extra permissions only)
            $user->permissions()->sync($selectedExtraPermissions);

            // Handle revoked role permissions
            // Any role permission NOT selected should be revoked
            $revokedRolePermissions = array_diff($rolePermissionIds, $selectedRolePermissions);
            
            // Only revoke role permissions, not direct permissions
            // Remove any direct permissions from revoked list
            $revokedRolePermissions = array_diff($revokedRolePermissions, $selectedExtraPermissions);
            
            // Sync revoked permissions
            $user->revokedPermissions()->sync($revokedRolePermissions);
            
            Log::info('Permissions assigned to user', [
                'target_user_id' => $userId,
                'assigned_by' => $currentUser->email,
                'direct_permissions' => $selectedExtraPermissions,
                'revoked_role_permissions' => $revokedRolePermissions,
            ]);

            return response()->json([
                'message' => 'تم تعيين الصلاحيات بنجاح.',
                'permissions' => $user->getAllPermissions(),
            ]);
        } catch (\Exception $e) {
            Log::error('Error assigning permissions', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
            ]);
            return response()->json(['message' => 'خطأ أثناء تعيين الصلاحيات.'], 500);
        }
    }

    /**
     * Revoke a specific permission from a user
     */
    public function revokePermission($userId, $permissionId)
    {
        $currentUser = auth()->user();
        
        if (!($currentUser instanceof LoginAdmin) || !$currentUser->canAssignPermissions()) {
            return response()->json(['message' => 'غير مسموح لك بالدخول.'], 403);
        }

        $user = LoginAdmin::findOrFail($userId);

        // Cannot modify president's permissions
        if ($user->role === 'president') {
            return response()->json(['message' => 'لا يمكن تعديل صلاحيات الرئيس.'], 403);
        }

        try {
            $user->permissions()->detach($permissionId);
            $user->revokedPermissions()->syncWithoutDetaching([$permissionId]);
            
            Log::info('Permission revoked from user', [
                'target_user_id' => $userId,
                'permission_id' => $permissionId,
                'revoked_by' => $currentUser->email,
            ]);

            return response()->json([
                'message' => 'تم إلغاء الصلاحية بنجاح.',
                'permissions' => $user->getAllPermissions(),
            ]);
        } catch (\Exception $e) {
            Log::error('Error revoking permission', [
                'user_id' => $userId,
                'permission_id' => $permissionId,
                'error' => $e->getMessage(),
            ]);
            return response()->json(['message' => 'خطأ أثناء إلغاء الصلاحية.'], 500);
        }
    }

    /**
     * Get permissions grouped by module
     */
    public function getPermissionsByModule()
    {
        $user = auth()->user();
        
        if (!($user instanceof LoginAdmin) || !$user->canAssignPermissions()) {
            return response()->json(['message' => 'غير مسموح لك بالدخول.'], 403);
        }

        $permissions = Permission::all()->groupBy('module');
        return response()->json($permissions);
    }
}
