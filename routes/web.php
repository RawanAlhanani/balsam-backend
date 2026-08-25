
<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/connect', [
	'uses' => 'admin\AdminController@index',
	'as' => 'connexion'
]);

Route::post('/PostseConnect', [
	'uses' => 'admin\AdminController@seConnecter',
	'as' => 'PostConnect'
]);


Route::get('/sedeconnect', [
	'uses' => 'Admin\adminController@seDeconnecter',
	'as' => 'logout'
]);

/*********************Frontend*****************************/

Route::get('/', [
	'uses' => 'Frontend\PagesController@index',
	'as' => 'home'
]);


Route::get('partenaires','Frontend\PagesController@getPartenaires');
Route::get('contact','Frontend\ContactController@index');

Route::get('object','Frontend\AutismController@object');


Route::get('autisme','Frontend\PageAutismeController@index');
Route::get('getTitresPagesAutisme','Frontend\PageAutismeController@titres');
Route::get('page_autisme/{id}', [
	'uses' => 'Frontend\PageAutismeController@unePage',   /*     <---------*/
	'as' => 'getPage'
]);

Route::get('formation','Frontend\AutismController@formation');

Route::get('about','Frontend\AboutusController@index');
Route::get('projets','Frontend\ProjetController@index');

Route::get('aboutUs/{id}', [
	'uses' => 'Frontend\AboutusController@about',   /*     <---------*/
	'as' => 'anAbout'
]);

Route::get('projet/{id}', [
	'uses' => 'Frontend\ProjetController@projet',   /*     <---------*/
	'as' => 'unProjet'
]);

Route::get('nosPhotos', [
	'uses' => 'Frontend\PagesController@photos',
	'as' => 'lesPhotos'
]);



/*********************Backend*****************************/

Route::get('tuteur', [
	'uses' => 'admin\TuteurController@getTuteurs',   /*     <---------*/
	'as' => 'Tuteur'
]);


// AddInscription
Route::get('inscription', [
	'uses' => 'Backend\InscriptionController@index',
	'as' => 'addInscription'
]);
// PostInscription
Route::post('inscrire', [
	'uses' => 'Backend\InscriptionController@inscrire',
	'as' => 'PostInscription'
]);


/* partie Admin */ 
Route::get('admin/Tuteurs', [
	'uses' => 'admin\TuteurController@getTuteurs',
	'as' => 'tuteurs'
]);

//*******users
/*
Route::get('backend/dashbord1', [
	'uses' => 'Backend\TuteurController@dashbord1',
	'as' => 'Dashbord1'
]);
*/

//*******edit
Route::get('admin/editTuteur/{id}', [
	'uses' => 'admin\TuteurController@edit',
	'as' => 'Edit'
]);

Route::post('admin/postEditTuteur', [
	'uses' => 'admin\TuteurController@posteditTuteur',
	'as' => 'PostEditTuteur'
]);

// voir details tuteur
Route::get('admin/getDetailsTuteur/{id}', [
	'uses' => 'admin\TuteurController@detailsTuteur',
	'as' => 'getDetails'
]);

// supprimer tuteur
Route::get('admin/deleteTuteur/{id}', [
	'uses' => 'admin\TuteurController@supprimerTuteur',
	'as' => 'delTut'
]);

// -------------- Activites ------
// les activites
Route::get('admin/Activites', [
	'uses' => 'admin\ActiviteController@index',
	'as' => 'activites'
]);

// ajout activite 
Route::get('admin/ajoutActivite', [
	'uses' => 'admin\ActiviteController@addAct',
	'as' => 'addActivite'
]);

Route::post('admin/PostAjoutActivite', [
	'uses' => 'admin\ActiviteController@PostAddAct',
	'as' => 'PostAddActivite'
]);

// voir details activite
Route::get('admin/getDetailsActivite/{id}', [
	'uses' => 'admin\ActiviteController@detailsActivite',
	'as' => 'getDetailsAct'
]);

// modifier activite
Route::get('admin/editActivite/{id}', [
	'uses' => 'admin\ActiviteController@editAct',
	'as' => 'EditAct'
]);

Route::post('admin/posteditactivite', [
	'uses' => 'admin\ActiviteController@postEditActivite',
	'as' => 'PostEditAct'
]);

// supprimer activite
Route::get('admin/deleteActivite/{id}', [
	'uses' => 'admin\ActiviteController@supprimerActivite',
	'as' => 'delAct'
]);

// participants 
Route::get('admin/participants/{id}', [
	'uses' => 'admin\ActiviteController@participants',
	'as' => 'getParticipants'
]);

// supprimer participants 
Route::get('admin/deleteParticipant/{id}', [
	'uses' => 'admin\ActiviteController@supprimerParticipant',
	'as' => 'delPart'
]);


// -------------- Infos ------
// les Infos
Route::get('admin/Infos', [
	'uses' => 'admin\InfosController@index',
	'as' => 'infos'
]);

// ajout Info 
Route::get('admin/ajoutInfo', [
	'uses' => 'admin\InfosController@addInfo',
	'as' => 'addInf'
]);

Route::post('admin/PostAjoutInfo', [
	'uses' => 'admin\InfosController@PostAddInfo',
	'as' => 'PostAddInf'
]);

// voir details Info
Route::get('admin/getDetailsInfo/{id}', [
	'uses' => 'admin\InfosController@detailsInfo',
	'as' => 'getDetailsInf'
]);

// modifier Info
Route::get('admin/editInfo/{id}', [
	'uses' => 'admin\InfosController@editInfo',
	'as' => 'EditInf'
]);

Route::post('admin/posteditinfo', [
	'uses' => 'admin\InfosController@postEditInfo',
	'as' => 'PostEditInf'
]);

// supprimer Info
Route::get('admin/deleteInfo/{id}', [
	'uses' => 'admin\InfosController@supprimerInfo',
	'as' => 'delInf'
]);

// -------------- Partenaires ------
// les partenaires
Route::get('admin/Partenaires', [
	'uses' => 'admin\PartenaireController@index',
	'as' => 'partenaires'
]);

// ajout Info 
Route::get('admin/ajoutPartenaire', [
	'uses' => 'admin\PartenaireController@addPartenaire',
	'as' => 'addPartenaire'
]);

Route::post('admin/PostAjoutPartenaire', [
	'uses' => 'admin\PartenaireController@PostAddPartenaire',
	'as' => 'PostAddPartenaire'
]);

// voir details Info
Route::get('admin/getDetailsPartenaire/{id}', [
	'uses' => 'admin\PartenaireController@detailsPartenaire',
	'as' => 'getDetailsPartenaire'
]);

// modifier Info
Route::get('admin/editPartenaire/{id}', [
	'uses' => 'admin\PartenaireController@editPartenaire',
	'as' => 'EditPartenaire'
]);

Route::post('admin/posteditPartenaire', [
	'uses' => 'admin\PartenaireController@postEditPartenaire',
	'as' => 'PostEditPartenaire'
]);

// supprimer Info
Route::get('admin/deletePartenaire/{id}', [
	'uses' => 'admin\PartenaireController@supprimerPartenaire',
	'as' => 'delPartenaire'
]);

// ----------- Regions

// les regions
Route::get('admin/Regions', [
	'uses' => 'admin\RegionController@index',
	'as' => 'regions'
]);

// ajout region 
Route::get('admin/ajoutregion', [
	'uses' => 'admin\RegionController@addRegion',
	'as' => 'addRegion'
]);

Route::post('admin/PostAjoutregion', [
	'uses' => 'admin\RegionController@PostAddRegion',
	'as' => 'PostAddRegion'
]);

// modifier region
Route::get('admin/editregion/{id}', [
	'uses' => 'admin\RegionController@editRegion',
	'as' => 'EditRegion'
]);

Route::post('admin/posteditregion', [
	'uses' => 'admin\RegionController@postEditRegion',
	'as' => 'PostEditRegion'
]);

// supprimer region
Route::get('admin/deleteRegion/{id_reg}', [
	'uses' => 'admin\RegionController@supprimerRegion',
	'as' => 'delRegion'
]);

// ----------- Types

// les regions
Route::get('admin/Types', [
	'uses' => 'admin\TypeActiviteController@index',
	'as' => 'types'
]);

// ajout region 
Route::get('admin/ajouttype', [
	'uses' => 'admin\TypeActiviteController@addType',
	'as' => 'addType'
]);

Route::post('admin/PostAjouttype', [
	'uses' => 'admin\TypeActiviteController@PostAddType',
	'as' => 'PostAddType'
]);

// modifier region
Route::get('admin/edittype/{id}', [
	'uses' => 'admin\TypeActiviteController@editType',
	'as' => 'EditType'
]);

Route::post('admin/postedittype', [
	'uses' => 'admin\TypeActiviteController@postEditType',
	'as' => 'PostEditType'
]);

// supprimer region
Route::get('admin/deleteType/{id}', [
	'uses' => 'admin\TypeActiviteController@supprimerType',
	'as' => 'delType'
]);


// -------------- specialites ------
// les Infos
Route::get('admin/Doctors', [
	'uses' => 'admin\DoctorsController@index',
	'as' => 'doctors'
]);

// ajout doctor 
Route::get('admin/ajoutDoctor', [
	'uses' => 'admin\DoctorsController@addDoctor',
	'as' => 'addDoctor'
]);

Route::post('admin/PostAjoutDoctor', [
	'uses' => 'admin\DoctorsController@PostAddDoctor',
	'as' => 'PostAddDoctor'
]);

// modifier doctor
Route::get('admin/editDoctor/{id}', [
	'uses' => 'admin\DoctorsController@editDoctor',
	'as' => 'EditDoctor'
]);

Route::post('admin/posteditDoctor', [
	'uses' => 'admin\DoctorsController@postEditDoctor',
	'as' => 'PostEditDoctor'
]);

// supprimer doctor
Route::get('admin/deleteDoctor/{id}', [
	'uses' => 'admin\DoctorsController@supprimerDoctor',
	'as' => 'delDoctor'
]);

// -------------- Images principales ------
// les partenaires
Route::get('admin/ImagesPrincipales', [
	'uses' => 'admin\ImagesPrincipalesController@index',
	'as' => 'imagesprincipales'
]);

// ajout Info 
Route::get('admin/ajoutImagesPrincipales', [
	'uses' => 'admin\ImagesPrincipalesController@addImagesPrincipales',
	'as' => 'addImagesPrincipales'
]);

Route::post('admin/PostAjoutImagesPrincipales', [
	'uses' => 'admin\ImagesPrincipalesController@PostAddImagesPrincipales',
	'as' => 'PostAddImagesPrincipales'
]);

// modifier Info
Route::get('admin/editImagesPrincipales/{id}', [
	'uses' => 'admin\ImagesPrincipalesController@editImagesPrincipales',
	'as' => 'EditImagesPrincipales'
]);

Route::post('admin/posteditImagesPrincipales', [
	'uses' => 'admin\ImagesPrincipalesController@postEditImagesPrincipales',
	'as' => 'PostEditImagesPrincipales'
]);

// supprimer Info
Route::get('admin/deleteImagesPrincipales/{id}', [
	'uses' => 'admin\ImagesPrincipalesController@supprimerImagesPrincipales',
	'as' => 'delImagesPrincipales'
]);

// -------------- Images expos ------
// les partenaires
Route::get('admin/ImageExpo', [
	'uses' => 'admin\ImageExpoController@index',
	'as' => 'imagesexpos'
]);

// ajout Info 
Route::get('admin/ajoutImageExpo', [
	'uses' => 'admin\ImageExpoController@addImageExpo',
	'as' => 'addImageExpo'
]);

Route::post('admin/PostAjoutImageExpo', [
	'uses' => 'admin\ImageExpoController@PostAddImageExpo',
	'as' => 'PostAddImageExpo'
]);

// modifier Info
Route::get('admin/editImageExpo/{id}', [
	'uses' => 'admin\ImageExpoController@editImageExpo',
	'as' => 'EditImageExpo'
]);

Route::post('admin/posteditImageExpo', [
	'uses' => 'admin\ImageExpoController@postEditImageExpo',
	'as' => 'PostEditImageExpo'
]);

// supprimer Info
Route::get('admin/deleteImageExpo/{id}', [
	'uses' => 'admin\ImageExpoController@supprimerImageExpo',
	'as' => 'delImageExpo'
]);


/* partie Login Admin*/
/*
Route::name('backend')->prefix('auth')->namespace('Backend')->group(function(){
    Route::get('Login', 'LoginController@LoginForm')->name('Login.get');
    Route::post('Login', 'LoginController@traitement')->name('Login.post');
});
*/





/* Tuteur*/

Route::get('se_connecter', [
    'uses' =>'Frontend\PagesController@seConnecter',
    'as' => 'Login'
]);

Route::post('postSe_connecter', [
    'uses' =>'Frontend\PagesController@postSeConnecter',
    'as' => 'postLogin'
]);

Route::get('se_deconnecter', [
    'uses' =>'Frontend\PagesController@seDeconnecter',
    'as' => 'Logout'
]);

Route::get('tuteur/{id}/modifier', [
    'uses' =>'Backend\InscriptionController@edit_profile',
    'as' => 'modifierProfile'
]);

Route::post('tuteur/postModifier', [
    'uses' =>'Backend\InscriptionController@postEdit_profile',
    'as' => 'postModifierProfile'
]);

Route::get('vouloirParticiper/{activite_id}/{tuteur_id?}', [
    'uses' =>'Frontend\PagesController@vouloirparticiper',
    'as' => 'Participation'
]);

/*Route::get('participe/{activite_id}/{tuteur_id?}', [
    'uses' =>'Frontend\PagesController@participer',
    'as' => 'participation'
]);
*/
Route::get('generer/{id_activite}/{id_tuteur}', [
    'uses' =>'Frontend\PagesController@genererPDF',
    'as' => 'generation'
]);

Route::get('nosActivites', [
    'uses' =>'Frontend\PagesController@activites',
    'as' => 'NosActivites'
]);

Route::get('uneActivite/{id}', [
    'uses' =>'Frontend\PagesController@uneActivite',
    'as' => 'uneAct'
]);

Route::get('nosInfos', [
    'uses' =>'Frontend\PagesController@infos',
    'as' => 'NosInfos'
]);

Route::get('Information/{id}', [
    'uses' =>'Frontend\PagesController@uneInfo',
    'as' => 'uneInf'
]);

Route::get('getLastNews', [
    'uses' =>'Frontend\PagesController@getLastNews',
    'as' => 'lastNews'
]);

// -------------- Pages autisme ------
// les pages autisme
Route::get('admin/PageAutisme', [
	'uses' => 'admin\PageAutismeController@index',
	'as' => 'pagesautisme'
]);

// ajout activite 
Route::get('admin/ajoutPageAutisme', [
	'uses' => 'admin\PageAutismeController@addPageAutisme',
	'as' => 'addPageAutisme'
]);


Route::post('admin/PostAjoutPageAutisme', [
	'uses' => 'admin\PageAutismeController@PostAddPageAutisme',
	'as' => 'PostAddPageAutisme'
]);

// voir details activite
Route::get('admin/getDetailsPageAutisme/{id}', [
	'uses' => 'admin\PageAutismeController@detailsPageAutisme',
	'as' => 'getDetailsPageAutisme'
]);

// modifier activite
Route::get('admin/editPageAutisme/{id}', [
	'uses' => 'admin\PageAutismeController@editPageAutisme',
	'as' => 'EditPageAutisme'
]);

Route::post('admin/posteditPageAutisme', [
	'uses' => 'admin\PageAutismeController@postEditPageAutisme',
	'as' => 'PostEditPageAutisme'
]);

// supprimer activite
Route::get('admin/deletePageAutisme/{id}', [
	'uses' => 'admin\PageAutismeController@supprimerPageAutisme',
	'as' => 'delPageAutisme'
]);


// -------------- About us ------
// les pages autisme
Route::get('admin/AboutUs', [
	'uses' => 'admin\AboutUsController@index',
	'as' => 'aboutuses'
]);

// ajout  
Route::get('admin/ajoutAboutUs', [
	'uses' => 'admin\AboutUsController@addAboutUs',
	'as' => 'addAboutUs'
]);


Route::post('admin/PostAjoutAboutUs', [
	'uses' => 'admin\AboutUsController@PostAddAboutUs',
	'as' => 'PostAddAboutUs'
]);

// voir details 
Route::get('admin/getDetailsAboutUs/{id}', [
	'uses' => 'admin\AboutUsController@detailsAboutUs',
	'as' => 'getDetailsAboutUs'
]);

// modifier 
Route::get('admin/editAboutUs/{id}', [
	'uses' => 'admin\AboutUsController@editAboutUs',
	'as' => 'EditAboutUs'
]);

Route::post('admin/posteditAboutUs', [
	'uses' => 'admin\AboutUsController@postEditAboutUs',
	'as' => 'PostEditAboutUs'
]);

// supprimer 
Route::get('admin/deleteAboutUs/{id}', [
	'uses' => 'admin\AboutUsController@supprimerAboutUs',
	'as' => 'delAboutUs'
]);



// -------------- nosProjets ------
// les pages autisme
Route::get('admin/Projets', [
	'uses' => 'admin\ProjetController@index',
	'as' => 'projets'
]);

// ajout  
Route::get('admin/ajoutProjet', [
	'uses' => 'admin\ProjetController@addProjet',
	'as' => 'addProjet'
]);


Route::post('admin/PostAjoutProjet', [
	'uses' => 'admin\ProjetController@PostAddProjet',
	'as' => 'PostAddProjet'
]);

// voir details 
Route::get('admin/getDetailsProjet/{id}', [
	'uses' => 'admin\ProjetController@detailsProjet',
	'as' => 'getDetailsProjet'
]);

// modifier 
Route::get('admin/editProjet/{id}', [
	'uses' => 'admin\ProjetController@editProjet',
	'as' => 'EditProjet'
]);

Route::post('admin/posteditProjet', [
	'uses' => 'admin\ProjetController@postEditProjet',
	'as' => 'PostEditProjet'
]);

// supprimer 
Route::get('admin/deleteProjet/{id}', [
    'uses' => 'admin\ProjetController@supprimerProjet',
    'as' => 'delProjet'
]);
