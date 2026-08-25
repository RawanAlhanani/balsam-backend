<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define all permissions by module
        $permissions = [
            // Activities module
            'activities' => [
                ['name' => 'view_activities', 'display_name' => 'عرض الأنشطة', 'description' => 'القدرة على عرض قائمة الأنشطة'],
                ['name' => 'create_activities', 'display_name' => 'إنشاء نشاط', 'description' => 'القدرة على إنشاء نشاط جديد'],
                ['name' => 'edit_activities', 'display_name' => 'تعديل النشاط', 'description' => 'القدرة على تعديل الأنشطة'],
                ['name' => 'delete_activities', 'display_name' => 'حذف النشاط', 'description' => 'القدرة على حذف الأنشطة'],
            ],
            // News module
            'news' => [
                ['name' => 'view_news', 'display_name' => 'عرض الأخبار', 'description' => 'القدرة على عرض قائمة الأخبار'],
                ['name' => 'create_news', 'display_name' => 'إنشاء خبر', 'description' => 'القدرة على إنشاء خبر جديد'],
                ['name' => 'edit_news', 'display_name' => 'تعديل الخبر', 'description' => 'القدرة على تعديل الأخبار'],
                ['name' => 'delete_news', 'display_name' => 'حذف الخبر', 'description' => 'القدرة على حذف الأخبار'],
            ],
            // Partners module
            'partners' => [
                ['name' => 'view_partners', 'display_name' => 'عرض الشركاء', 'description' => 'القدرة على عرض قائمة الشركاء'],
                ['name' => 'create_partners', 'display_name' => 'إضافة شريك', 'description' => 'القدرة على إضافة شريك جديد'],
                ['name' => 'edit_partners', 'display_name' => 'تعديل الشريك', 'description' => 'القدرة على تعديل الشركاء'],
                ['name' => 'delete_partners', 'display_name' => 'حذف الشريك', 'description' => 'القدرة على حذف الشركاء'],
            ],
            // Projects module
            'projects' => [
                ['name' => 'view_projects', 'display_name' => 'عرض المشاريع', 'description' => 'القدرة على عرض قائمة المشاريع'],
                ['name' => 'create_projects', 'display_name' => 'إنشاء مشروع', 'description' => 'القدرة على إنشاء مشروع جديد'],
                ['name' => 'edit_projects', 'display_name' => 'تعديل المشروع', 'description' => 'القدرة على تعديل المشاريع'],
                ['name' => 'delete_projects', 'display_name' => 'حذف المشروع', 'description' => 'القدرة على حذف المشاريع'],
            ],
            // Finance module
            'finance' => [
                ['name' => 'view_finance', 'display_name' => 'عرض التقارير المالية', 'description' => 'القدرة على عرض التقارير المالية'],
                ['name' => 'create_finance', 'display_name' => 'إضافة معاملة مالية', 'description' => 'القدرة على إضافة معاملة مالية جديدة'],
                ['name' => 'edit_finance', 'display_name' => 'تعديل المعاملة المالية', 'description' => 'القدرة على تعديل المعاملات المالية'],
                ['name' => 'delete_finance', 'display_name' => 'حذف المعاملة المالية', 'description' => 'القدرة على حذف المعاملات المالية'],
                ['name' => 'manage_finance_categories', 'display_name' => 'إدارة تصنيفات المالية', 'description' => 'القدرة على إدارة تصنيفات المالية'],
            ],
            // Activity Reports module
            'activity_reports' => [
                ['name' => 'view_activity_reports', 'display_name' => 'عرض تقارير الأنشطة', 'description' => 'القدرة على عرض تقارير الأنشطة'],
                ['name' => 'create_activity_reports', 'display_name' => 'إنشاء تقرير نشاط', 'description' => 'القدرة على إنشاء تقرير نشاط جديد'],
                ['name' => 'edit_activity_reports', 'display_name' => 'تعديل تقرير النشاط', 'description' => 'القدرة على تعديل تقارير الأنشطة'],
                ['name' => 'delete_activity_reports', 'display_name' => 'حذف تقرير النشاط', 'description' => 'القدرة على حذف تقارير الأنشطة'],
            ],
            // Meetings module
            'meetings' => [
                ['name' => 'view_meetings', 'display_name' => 'عرض الاجتماعات', 'description' => 'القدرة على عرض قائمة الاجتماعات'],
                ['name' => 'create_meetings', 'display_name' => 'إنشاء اجتماع', 'description' => 'القدرة على إنشاء اجتماع جديد'],
                ['name' => 'edit_meetings', 'display_name' => 'تعديل الاجتماع', 'description' => 'القدرة على تعديل الاجتماعات'],
                ['name' => 'delete_meetings', 'display_name' => 'حذف الاجتماع', 'description' => 'القدرة على حذف الاجتماعات'],
            ],
            // Tuteurs (Parents/Volunteers) module
            'tuteurs' => [
                ['name' => 'view_tuteurs', 'display_name' => 'عرض المسجلين', 'description' => 'القدرة على عرض قائمة المسجلين'],
                ['name' => 'edit_tuteurs', 'display_name' => 'تعديل بيانات المسجلين', 'description' => 'القدرة على تعديل بيانات المسجلين'],
                ['name' => 'delete_tuteurs', 'display_name' => 'حذف المسجلين', 'description' => 'القدرة على حذف المسجلين'],
            ],
            // Doctors module
            'doctors' => [
                ['name' => 'view_doctors', 'display_name' => 'عرض التخصصات', 'description' => 'القدرة على عرض التخصصات من إعدادات النظام'],
                ['name' => 'create_doctors', 'display_name' => 'إضافة تخصص', 'description' => 'القدرة على إضافة تخصص من إعدادات النظام'],
                ['name' => 'edit_doctors', 'display_name' => 'تعديل التخصصات', 'description' => 'القدرة على تعديل التخصصات من إعدادات النظام'],
                ['name' => 'delete_doctors', 'display_name' => 'حذف التخصصات', 'description' => 'القدرة على حذف التخصصات من إعدادات النظام'],
            ],
            // Regions module
            'regions' => [
                ['name' => 'view_regions', 'display_name' => 'عرض المناطق', 'description' => 'القدرة على عرض قائمة المناطق'],
                ['name' => 'create_regions', 'display_name' => 'إضافة منطقة', 'description' => 'القدرة على إضافة منطقة جديدة'],
                ['name' => 'edit_regions', 'display_name' => 'تعديل المنطقة', 'description' => 'القدرة على تعديل المناطق'],
                ['name' => 'delete_regions', 'display_name' => 'حذف المنطقة', 'description' => 'القدرة على حذف المناطق'],
            ],
            // Types (Activity Types) module
            'types' => [
                ['name' => 'view_types', 'display_name' => 'عرض الأنواع', 'description' => 'القدرة على عرض أنواع الأنشطة'],
                ['name' => 'create_types', 'display_name' => 'إضافة نوع', 'description' => 'القدرة على إضافة نوع نشاط جديد'],
                ['name' => 'edit_types', 'display_name' => 'تعديل النوع', 'description' => 'القدرة على تعديل أنواع الأنشطة'],
                ['name' => 'delete_types', 'display_name' => 'حذف النوع', 'description' => 'القدرة على حذف أنواع الأنشطة'],
            ],
            // Sliders module
            'sliders' => [
                ['name' => 'view_sliders', 'display_name' => 'عرض الشرائح', 'description' => 'القدرة على عرض الشرائح'],
                ['name' => 'create_sliders', 'display_name' => 'إضافة شريحة', 'description' => 'القدرة على إضافة شريحة جديدة'],
                ['name' => 'edit_sliders', 'display_name' => 'تعديل الشريحة', 'description' => 'القدرة على تعديل الشرائح'],
                ['name' => 'delete_sliders', 'display_name' => 'حذف الشريحة', 'description' => 'القدرة على حذف الشرائح'],
            ],
            // Gallery/Photos module
            'gallery' => [
                ['name' => 'view_gallery', 'display_name' => 'عرض المعرض', 'description' => 'القدرة على عرض معرض الصور'],
                ['name' => 'create_gallery', 'display_name' => 'إضافة صورة', 'description' => 'القدرة على إضافة صورة للمعرض'],
                ['name' => 'edit_gallery', 'display_name' => 'تعديل الصورة', 'description' => 'القدرة على تعديل صور المعرض'],
                ['name' => 'delete_gallery', 'display_name' => 'حذف الصورة', 'description' => 'القدرة على حذف صور المعرض'],
            ],
            // Static Pages module
            'static_pages' => [
                ['name' => 'view_static_pages', 'display_name' => 'عرض الصفحات الثابتة', 'description' => 'القدرة على عرض الصفحات الثابتة'],
                ['name' => 'create_static_pages', 'display_name' => 'إنشاء صفحة ثابتة', 'description' => 'القدرة على إنشاء صفحة ثابتة جديدة'],
                ['name' => 'edit_static_pages', 'display_name' => 'تعديل الصفحة الثابتة', 'description' => 'القدرة على تعديل الصفحات الثابتة'],
                ['name' => 'delete_static_pages', 'display_name' => 'حذف الصفحة الثابتة', 'description' => 'القدرة على حذف الصفحات الثابتة'],
            ],
            // Settings module
            'settings' => [
                ['name' => 'view_settings', 'display_name' => 'عرض الإعدادات', 'description' => 'القدرة على عرض إعدادات الموقع'],
                ['name' => 'edit_settings', 'display_name' => 'تعديل الإعدادات', 'description' => 'القدرة على تعديل إعدادات الموقع'],
            ],
            // Site Settings module
            'site_settings' => [
                ['name' => 'view_site_settings', 'display_name' => 'عرض إعدادات الموقع', 'description' => 'القدرة على عرض معلومات التواصل'],
                ['name' => 'edit_site_settings', 'display_name' => 'تعديل إعدادات الموقع', 'description' => 'القدرة على تعديل معلومات التواصل'],
            ],
            // Users/Accounts module
            'users' => [
                ['name' => 'view_users', 'display_name' => 'عرض حسابات الإدارة', 'description' => 'القدرة على عرض حسابات الإدارة'],
                ['name' => 'create_users', 'display_name' => 'إنشاء حساب إداري', 'description' => 'القدرة على إنشاء حساب إداري جديد'],
                ['name' => 'edit_users', 'display_name' => 'تعديل حسابات الإدارة', 'description' => 'القدرة على تعديل حسابات الإدارة'],
                ['name' => 'delete_users', 'display_name' => 'حذف حسابات الإدارة', 'description' => 'القدرة على حذف حسابات الإدارة'],
            ],
            // Permissions module (for assigning permissions)
            'permissions' => [
                ['name' => 'assign_permissions', 'display_name' => 'تعيين الصلاحيات', 'description' => 'القدرة على تعيين صلاحيات للمستخدمين'],
                ['name' => 'view_permissions', 'display_name' => 'عرض الصلاحيات', 'description' => 'القدرة على عرض الصلاحيات'],
            ],
            // Stats module
            'stats' => [
                ['name' => 'view_stats', 'display_name' => 'عرض الإحصائيات', 'description' => 'القدرة على عرض إحصائيات النظام'],
            ],
            // Contact Messages module
            'contact_messages' => [
                ['name' => 'view_contact_messages', 'display_name' => 'عرض رسائل التواصل', 'description' => 'القدرة على عرض رسائل التواصل'],
                ['name' => 'delete_contact_messages', 'display_name' => 'حذف رسالة التواصل', 'description' => 'القدرة على حذف رسائل التواصل'],
            ],
            // Volunteers module
            'volunteers' => [
                ['name' => 'view_volunteers', 'display_name' => 'عرض المتطوعين', 'description' => 'القدرة على عرض قائمة المتطوعين'],
                ['name' => 'delete_volunteers', 'display_name' => 'حذف المتطوع', 'description' => 'القدرة على حذف المتطوعين'],
            ],
            // Stagiaires module
            'stagiaires' => [
                ['name' => 'view_stagiaires', 'display_name' => 'عرض المتدربين', 'description' => 'القدرة على عرض قائمة المتدربين'],
                ['name' => 'delete_stagiaires', 'display_name' => 'حذف المتدربين', 'description' => 'القدرة على حذف المتدربين'],
            ],
        ];

        // Insert permissions
        foreach ($permissions as $module => $modulePermissions) {
            foreach ($modulePermissions as $perm) {
                Permission::firstOrCreate(
                    ['name' => $perm['name']],
                    [
                        'display_name' => $perm['display_name'],
                        'description' => $perm['description'],
                        'module' => $module,
                    ]
                );
            }
        }

        // Define role-permission mappings
        // President gets all permissions automatically via logic, no need to assign
        // Public content (activities, news, partners, photos, etc.) is managed ONLY by president
        $rolePermissions = [
            'vice_president' => [
                // Reports only
                'view_activity_reports', 'create_activity_reports', 'edit_activity_reports', 'delete_activity_reports',
                'view_meetings', 'create_meetings', 'delete_meetings',
                'edit_meetings',
                // Internal data view
                'view_tuteurs', 'edit_tuteurs',
                'view_doctors', 'create_doctors', 'edit_doctors',
                'view_regions', 'create_regions', 'edit_regions',
                'view_types', 'create_types', 'edit_types',
                'view_settings', 'edit_settings',
                'view_site_settings', 'edit_site_settings',
                'view_stats',
                'view_contact_messages', 'delete_contact_messages',
                'view_volunteers', 'delete_volunteers',
                'view_stagiaires', 'delete_stagiaires',
            ],
            'secretary' => [
                // Reports only
                'view_activity_reports', 'create_activity_reports', 'edit_activity_reports', 'delete_activity_reports',
                'view_meetings', 'create_meetings', 'delete_meetings',
                'edit_meetings',
                // Internal data view
                'view_tuteurs', 'edit_tuteurs',
                'view_doctors', 'create_doctors', 'edit_doctors',
                'view_regions', 'create_regions', 'edit_regions',
                'view_types', 'create_types', 'edit_types',
                'view_settings', 'edit_settings',
                'view_site_settings', 'edit_site_settings',
                'view_stats',
                'view_contact_messages', 'delete_contact_messages',
                'view_volunteers', 'delete_volunteers',
                'view_stagiaires', 'delete_stagiaires',
            ],
            'vice_secretary' => [
                // Reports only
                'view_activity_reports', 'create_activity_reports', 'edit_activity_reports', 'delete_activity_reports',
                'view_meetings', 'create_meetings', 'delete_meetings',
                'edit_meetings',
                // Internal data view
                'view_tuteurs', 'edit_tuteurs',
                'view_doctors', 'create_doctors', 'edit_doctors',
                'view_regions', 'create_regions', 'edit_regions',
                'view_types', 'create_types', 'edit_types',
                'view_settings', 'edit_settings',
                'view_site_settings', 'edit_site_settings',
                'view_stats',
                'view_contact_messages', 'delete_contact_messages',
                'view_volunteers', 'delete_volunteers',
                'view_stagiaires', 'delete_stagiaires',
            ],
            'treasurer' => [
                // Finance only
                'view_finance', 'create_finance', 'edit_finance', 'delete_finance',
                'manage_finance_categories',
                // Basic internal view
                'view_tuteurs',
                'view_doctors',
                'view_regions',
                'view_types',
                'view_settings',
                'view_site_settings',
                'view_stats',
                'view_contact_messages',
                'view_volunteers', 'view_stagiaires',
            ],
            'vice_treasurer' => [
                // Finance only
                'view_finance', 'create_finance', 'edit_finance', 'delete_finance',
                'manage_finance_categories',
                // Basic internal view
                'view_tuteurs',
                'view_doctors',
                'view_regions',
                'view_types',
                'view_settings',
                'view_site_settings',
                'view_stats',
                'view_contact_messages',
                'view_volunteers', 'view_stagiaires',
            ],
        ];

        // Assign permissions to roles
        foreach ($rolePermissions as $role => $permissionNames) {
            foreach ($permissionNames as $permissionName) {
                $permission = Permission::where('name', $permissionName)->first();
                if ($permission) {
                    DB::table('role_permissions')->updateOrInsert(
                        ['role' => $role, 'permission_id' => $permission->id],
                        ['created_at' => now(), 'updated_at' => now()]
                    );
                }
            }
        }

        $this->command->info('Permissions seeded successfully.');
    }
}
