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
});
