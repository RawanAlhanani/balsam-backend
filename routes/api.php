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
    Route::post('/login', 'AuthController@login');
    Route::post('/admin-login', 'AuthController@adminLogin');
    Route::post('/register', 'AuthController@register');
    Route::post('/logout', 'AuthController@logout')->middleware('auth:sanctum');
    Route::get('/profile', 'AuthController@profile')->middleware('auth:sanctum');
    Route::post('/update-profile', 'AuthController@updateProfile')->middleware('auth:sanctum');

    Route::get('/home-data', 'PublicController@getHomeData');
    Route::get('/about', 'PublicController@getAbout');
    Route::get('/projects', 'PublicController@getProjects');
    Route::get('/projects/{id}', 'PublicController@getProject');
    Route::get('/news', 'PublicController@getNews');
    Route::get('/news/{id}', 'PublicController@getSingleNews');
    Route::get('/activities', 'PublicController@getActivities');
    Route::get('/activities/{id}', 'PublicController@getActivity');
    Route::get('/partenaires', 'PublicController@getPartenaires');
    Route::get('/photos', 'PublicController@getPhotos');
    Route::get('/autisme-pages', 'PublicController@getAutismePages');
    Route::get('/autisme-pages/{id}', 'PublicController@getAutismePage');
    Route::get('/registration-data', 'PublicController@getRegistrationData');
    Route::get('/generer/{id_activite}/{id_tuteur}', 'PublicController@genererPDF');

    // Admin routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/admin/tuteurs', 'PublicController@getAdminTuteurs');
        Route::delete('/admin/tuteurs/{id}', 'AdminController@deleteTuteur');
        Route::get('/admin/stats', 'AdminController@getStats');

        Route::get('/admin/activities', 'AdminController@getActivities');
        Route::post('/admin/activities', 'AdminController@storeActivity');
        Route::delete('/admin/activities/{id}', 'AdminController@deleteActivity');

        Route::get('/admin/tuteurs', 'PublicController@getAdminTuteurs');
        Route::delete('/admin/tuteurs/{id}', 'AdminController@deleteTuteur');
        Route::get('/admin/stats', 'AdminController@getStats');

        Route::get('/admin/activities', 'AdminController@getActivities');
        Route::post('/admin/activities', 'AdminController@storeActivity');
        Route::delete('/admin/activities/{id}', 'AdminController@deleteActivity');

        Route::get('/admin/news', 'AdminController@getNews');
        Route::post('/admin/news', 'AdminController@storeNews');
        Route::delete('/admin/news/{id}', 'AdminController@deleteNews');

        Route::get('/admin/partners', 'AdminController@getPartners');
        Route::post('/admin/partners', 'AdminController@storePartner');
        Route::delete('/admin/partners/{id}', 'AdminController@deletePartner');

        Route::get('/admin/regions', 'AdminController@getRegions');
        Route::get('/admin/doctors', 'AdminController@getDoctors');
        Route::get('/admin/types', 'AdminController@getTypes');

        Route::get('/admin/sliders', 'AdminController@getSliders');
        Route::post('/admin/sliders', 'AdminController@storeSlider');
        Route::delete('/admin/sliders/{id}', 'AdminController@deleteSlider');

        Route::get('/admin/gallery', 'AdminController@getGallery');
        Route::post('/admin/gallery', 'AdminController@storeGallery');
        Route::delete('/admin/gallery/{id}', 'AdminController@deleteGallery');

        Route::get('/admin/static-pages', 'AdminController@getStaticPages');
        Route::post('/admin/static-pages', 'AdminController@storeStaticPage');
        Route::delete('/admin/static-pages/{type}/{id}', 'AdminController@deleteStaticPage');

        // Restricted routes based on roles
        Route::middleware('role:president')->group(function () {
            Route::get('/admin/accounts', 'AdminController@getAdmins');
            Route::post('/admin/accounts', 'AdminController@storeAdmin');
            Route::delete('/admin/accounts/{id}', 'AdminController@deleteAdmin');
        });

        Route::middleware('role:president,secretary')->group(function () {
            Route::get('/admin/activity-reports', 'ReportController@getActivities');
            Route::post('/admin/activity-reports', 'ReportController@storeActivity');
            Route::delete('/admin/activity-reports/{id}', 'ReportController@deleteActivity');

            Route::get('/admin/meetings', 'ReportController@getMeetings');
            Route::post('/admin/meetings', 'ReportController@storeMeeting');
            Route::delete('/admin/meetings/{id}', 'ReportController@deleteMeeting');
        });

        Route::middleware('role:president,treasurer')->group(function () {
            Route::get('/admin/finance', 'ReportController@getFinance');
            Route::post('/admin/finance', 'ReportController@storeTransaction');
            Route::put('/admin/finance/{id}', 'ReportController@updateTransaction');
            Route::delete('/admin/finance/{id}', 'ReportController@deleteTransaction');

            Route::get('/admin/finance-categories', 'ReportController@getCategories');
            Route::post('/admin/finance-categories', 'ReportController@storeCategory');
            Route::delete('/admin/finance-categories/{id}', 'ReportController@deleteCategory');
        });
    });
    Route::get('/stats', [StatsController::class, 'index']);
    Route::post('/register-stagiaire', '\App\Http\Controllers\admin\StagiaireController@register');
    Route::post('/register-volunteer', '\App\Http\Controllers\admin\VolunteerController@register');
    Route::get('/admin/volunteers', '\App\Http\Controllers\admin\VolunteerController@index');
    Route::delete('/admin/volunteers/{id}', '\App\Http\Controllers\admin\VolunteerController@destroy');
});


