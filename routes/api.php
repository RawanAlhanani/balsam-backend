<?php

use App\Http\Controllers\Api\StatsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function () {
    // No DB query, no middleware - the cheapest possible request to keep the
    // backend process warm on shared hosting via an external uptime pinger.
    Route::get('/ping', function () {
        return response()->json(['status' => 'ok']);
    });

    Route::get('/csrf-cookie', function () {
        return response()->json(['message' => 'CSRF cookie set']);
    })->middleware('web');

    Route::middleware('throttle:20,1')->group(function () {
        Route::post('/login', 'AuthController@login');
        Route::post('/admin-login', 'AuthController@adminLogin');
        Route::post('/register', 'AuthController@register');
    });
    Route::post('/logout', 'AuthController@logout')->middleware('auth:sanctum');
    Route::get('/profile', 'AuthController@profile')->middleware('auth:sanctum');
    Route::post('/update-profile', 'AuthController@updateProfile')->middleware('auth:sanctum');
    // Self-service profile update for the logged-in admin (any role) — kept
    // outside the role-gated /admin/... groups below since it only ever
    // touches the caller's own account.
    Route::put('/admin/my-profile', 'AuthController@updateAdminProfile')->middleware('auth:sanctum');
    Route::post('/refresh', 'AuthController@refresh');

    Route::get('/home-data', 'PublicController@getHomeData');
    Route::get('/about', 'PublicController@getAbout');
    Route::get('/projects', 'PublicController@getProjects');
    Route::get('/projects/{id}', 'PublicController@getProject');
    Route::get('/news', 'PublicController@getNews');
    Route::get('/news/{id}', 'PublicController@getSingleNews');
    Route::get('/activities/{id}', 'PublicController@getActivity'); // Public single activity route
    Route::get('/activities', 'PublicController@getActivities'); // Public activities route
    Route::get('/partenaires', 'PublicController@getPartenaires');
    Route::get('/photos', 'PublicController@getPhotos');
    Route::get('/autisme-pages', 'PublicController@getAutismePages');
    Route::get('/autisme-pages/{id}', 'PublicController@getAutismePage');
    Route::get('/registration-data', 'PublicController@getRegistrationData');
    Route::get('/generer/{id_activite}/{id_tuteur}', 'PublicController@genererPDF')->middleware('auth:sanctum');
    Route::post('/contact', 'PublicController@submitContact')->middleware('throttle:20,1');
    Route::get('/team', 'PublicController@getTeam');
    Route::get('/site-settings', 'PublicController@getSiteSettings');

    // Admin routes
    Route::middleware('auth:sanctum')->group(function () {
        // Staff-only content management. Requires a LoginAdmin with one of these roles —
        // a self-registered Tuteur (parent/volunteer/admin_request) has no `role` and is
        // rejected by CheckRole regardless of which role is passed here.
        Route::middleware('role:president,vice_president,secretary,vice_secretary,treasurer,vice_treasurer')->group(function () {
            Route::middleware('permission:view_tuteurs')->get('/admin/tuteurs', 'PublicController@getAdminTuteurs');
            Route::middleware('permission:delete_tuteurs')->delete('/admin/tuteurs/{id}', 'AdminController@deleteTuteur');
            Route::middleware('permission:edit_tuteurs')->get('/admin/tuteur-enfant/{enfantId}', 'AdminController@getTuteurForEdit');
            Route::middleware('permission:edit_tuteurs')->put('/admin/tuteur-enfant/{enfantId}', 'AdminController@updateTuteurEnfant');
            Route::middleware('permission:view_stats')->get('/admin/stats', 'AdminController@getStats');

            // Admin Activities routes
            Route::middleware('permission:view_activities')->get('/admin/activities', 'AdminController@getActivities');
            Route::middleware('permission:create_activities')->post('/admin/activities', 'AdminController@storeActivity');
            Route::middleware('permission:edit_activities')->put('/admin/activities/{id}', 'AdminController@updateActivity');
            Route::middleware('permission:delete_activities')->delete('/admin/activities/{id}', 'AdminController@deleteActivity');
            Route::middleware('permission:view_activities')->get('/admin/activities/{id}', 'AdminController@showActivity');
            // For News
            Route::middleware('permission:view_news')->get('/admin/news', 'AdminController@getNews');
            Route::middleware('permission:create_news')->post('/admin/news', 'AdminController@storeNews');
            Route::middleware('permission:edit_news')->put('/admin/news/{id}', 'AdminController@updateNews');
            Route::middleware('permission:delete_news')->delete('/admin/news/{id}', 'AdminController@deleteNews');
            Route::middleware('permission:view_news')->get('/admin/news/{id}', 'AdminController@showNews');

            // Partners
            Route::middleware('permission:view_partners')->get('/admin/partners', 'AdminController@getPartners');
            Route::middleware('permission:create_partners')->post('/admin/partners', 'AdminController@storePartner');
            Route::middleware('permission:edit_partners')->put('/admin/partners/{id}', 'AdminController@updatePartner');
            Route::middleware('permission:delete_partners')->delete('/admin/partners/{id}', 'AdminController@deletePartner');

            // Regions
            Route::middleware('permission:view_regions')->get('/admin/regions', 'AdminController@getRegions');
            Route::middleware('permission:create_regions')->post('/admin/regions', 'AdminController@storeRegion');
            Route::middleware('permission:edit_regions')->put('/admin/regions/{id}', 'AdminController@updateRegion');
            Route::middleware('permission:delete_regions')->delete('/admin/regions/{id}', 'AdminController@deleteRegion');

            // Doctors
            Route::middleware('permission:view_doctors')->get('/admin/doctors', 'AdminController@getDoctors');
            Route::middleware('permission:create_doctors')->post('/admin/doctors', 'AdminController@storeDoctor');
            Route::middleware('permission:edit_doctors')->put('/admin/doctors/{id}', 'AdminController@updateDoctor');
            Route::middleware('permission:delete_doctors')->delete('/admin/doctors/{id}', 'AdminController@deleteDoctor');

            // Types
            Route::middleware('permission:view_types')->get('/admin/types', 'AdminController@getTypes');
            Route::middleware('permission:create_types')->post('/admin/types', 'AdminController@storeType');
            Route::middleware('permission:edit_types')->put('/admin/types/{id}', 'AdminController@updateType');
            Route::middleware('permission:delete_types')->delete('/admin/types/{id}', 'AdminController@deleteType');

            // Sliders
            Route::middleware('permission:view_sliders')->get('/admin/sliders', 'AdminController@getSliders');
            Route::middleware('permission:create_sliders')->post('/admin/sliders', 'AdminController@storeSlider');
            Route::middleware('permission:edit_sliders')->put('/admin/sliders/{id}', 'AdminController@updateSlider');
            Route::middleware('permission:delete_sliders')->delete('/admin/sliders/{id}', 'AdminController@deleteSlider');

            // Gallery
            Route::middleware('permission:view_gallery')->get('/admin/gallery', 'AdminController@getGallery');
            Route::middleware('permission:create_gallery')->post('/admin/gallery', 'AdminController@storeGallery');
            Route::middleware('permission:edit_gallery')->put('/admin/gallery/{id}', 'AdminController@updateGallery');
            Route::middleware('permission:delete_gallery')->delete('/admin/gallery/{id}', 'AdminController@deleteGallery');

            // Static Pages
            Route::middleware('permission:view_static_pages')->get('/admin/static-pages', 'AdminController@getStaticPages');
            Route::middleware('permission:create_static_pages')->post('/admin/static-pages', 'AdminController@storeStaticPage');
            Route::middleware('permission:edit_static_pages')->put('/admin/static-pages/{type}/{id}', 'AdminController@updateStaticPage');
            Route::middleware('permission:view_static_pages')->get('/admin/static-pages/{type}/{id}', 'AdminController@getSingleStaticPage');
            Route::middleware('permission:delete_static_pages')->delete('/admin/static-pages/{type}/{id}', 'AdminController@deleteStaticPage');

            // Stagiaires
            Route::middleware('permission:view_stagiaires')->get('/admin/stagiaires', '\App\Http\Controllers\admin\StagiaireController@index');
            Route::middleware('permission:delete_stagiaires')->delete('/admin/stagiaires/{id}', '\App\Http\Controllers\admin\StagiaireController@destroy');

            // Volunteers
            Route::middleware('permission:view_volunteers')->get('/admin/volunteers', '\App\Http\Controllers\admin\VolunteerController@index');
            Route::middleware('permission:delete_volunteers')->delete('/admin/volunteers/{id}', '\App\Http\Controllers\admin\VolunteerController@destroy');

            // Contact Messages
            Route::middleware('permission:view_contact_messages')->get('/admin/contact-messages', 'AdminController@getContactMessages');
            Route::middleware('permission:delete_contact_messages')->delete('/admin/contact-messages/{id}', 'AdminController@deleteContactMessage');

            // Site Settings
            Route::middleware('permission:view_site_settings')->get('/admin/site-settings', 'AdminController@getSiteSettings');
            Route::middleware('permission:edit_site_settings')->put('/admin/site-settings', 'AdminController@updateSiteSettings');
        });

        // Restricted routes based on roles
        Route::middleware('role:president')->group(function () {
            Route::get('/admin/accounts', 'AdminController@getAdmins');
            Route::post('/admin/accounts', 'AdminController@storeAdmin');
            Route::put('/admin/accounts/{id}', 'AdminController@updateAdmin');
            Route::delete('/admin/accounts/{id}', 'AdminController@deleteAdmin');

            // Permission management routes (president only)
            Route::get('/admin/permissions', 'PermissionController@index');
            Route::get('/admin/permissions/modules', 'PermissionController@getPermissionsByModule');
            Route::get('/admin/users', 'PermissionController@getUsers');
            Route::get('/admin/users/{id}/permissions', 'PermissionController@getUserPermissions');
            Route::post('/admin/users/{id}/permissions', 'PermissionController@assignPermissions');
            Route::delete('/admin/users/{id}/permissions/{permissionId}', 'PermissionController@revokePermission');
        });

        // Get current user's permissions (for sidebar rendering)
        Route::get('/admin/me/permissions', 'PermissionController@getCurrentUserPermissions');

        Route::middleware('permission:view_activity_reports')->group(function () {
            Route::get('/admin/activity-reports', 'ReportController@getActivities');
        });
        Route::middleware('permission:create_activity_reports')->group(function () {
            Route::post('/admin/activity-reports', 'ReportController@storeActivity');
        });
        Route::middleware('permission:edit_activity_reports')->group(function () {
            Route::put('/admin/activity-reports/{id}', 'ReportController@updateActivity');
        });
        Route::middleware('permission:delete_activity_reports')->group(function () {
            Route::delete('/admin/activity-reports/{id}', 'ReportController@deleteActivity');
        });

        Route::middleware('permission:view_meetings')->group(function () {
            Route::get('/admin/meetings', 'ReportController@getMeetings');
        });
        Route::middleware('permission:create_meetings')->group(function () {
            Route::post('/admin/meetings', 'ReportController@storeMeeting');
        });
        Route::middleware('permission:edit_meetings')->group(function () {
            Route::put('/admin/meetings/{id}', 'ReportController@updateMeeting');
        });
        Route::middleware('permission:delete_meetings')->group(function () {
            Route::delete('/admin/meetings/{id}', 'ReportController@deleteMeeting');
        });

        Route::middleware('permission:view_finance')->group(function () {
            Route::get('/admin/finance', 'ReportController@getFinance');
        });
        Route::middleware('permission:create_finance')->group(function () {
            Route::post('/admin/finance', 'ReportController@storeTransaction');
        });
        Route::middleware('permission:edit_finance')->group(function () {
            Route::put('/admin/finance/{id}', 'ReportController@updateTransaction');
        });
        Route::middleware('permission:delete_finance')->group(function () {
            Route::delete('/admin/finance/{id}', 'ReportController@deleteTransaction');
        });
        Route::middleware('permission:manage_finance_categories')->group(function () {
            Route::get('/admin/finance-categories', 'ReportController@getCategories');
            Route::post('/admin/finance-categories', 'ReportController@storeCategory');
            Route::put('/admin/finance-categories/{id}', 'ReportController@updateCategory');
            Route::delete('/admin/finance-categories/{id}', 'ReportController@deleteCategory');
        });
    });
    Route::get('/stats', [StatsController::class, 'index']);
    Route::post('/register-stagiaire', '\App\Http\Controllers\admin\StagiaireController@register');
    Route::post('/register-volunteer', '\App\Http\Controllers\admin\VolunteerController@register');
});
