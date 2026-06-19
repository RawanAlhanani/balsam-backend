<?php

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

    // Sensitive routes restricted to President
    Route::middleware('president')->group(function () {
        Route::get('/admin/accounts', 'AdminController@getAdmins');
        Route::post('/admin/accounts', 'AdminController@storeAdmin');
        Route::delete('/admin/accounts/{id}', 'AdminController@deleteAdmin');
    });
    Route::get('/admin/stagiaires', '\App\Http\Controllers\admin\StagiaireController@index');
    Route::delete('/admin/stagiaires/{id}', '\App\Http\Controllers\admin\StagiaireController@destroy');

    Route::post('/register-stagiaire', '\App\Http\Controllers\admin\StagiaireController@register');
    Route::post('/register-volunteer', '\App\Http\Controllers\admin\VolunteerController@register');
    Route::get('/admin/volunteers', '\App\Http\Controllers\admin\VolunteerController@index');
    Route::delete('/admin/volunteers/{id}', '\App\Http\Controllers\admin\VolunteerController@destroy');    
});