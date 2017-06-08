<?php

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

Route::get('Accueil', 'accueilController@index');
Route::get('Accueil/Contact','accueilController@index');
Route::post('Accueil/Contact','accueilController@validateformcontact');

Route::get('Connexion','connexionController@index');
Route::get('Connexion/Client','connexionController@index');
Route::post('Connexion/Client','connexionController@validateformcli');

Route::get('Connexion/Oublipasss','connexionController@index');
Route::post('Connexion/Oublipasss','connexionController@validateformoublipass');


Route::get('Inscription','inscriptionController@index');
Route::post('Inscription','inscriptionController@validateform');

Route::get('Plan-du-site','planDuSiteController@index');
Route::get('Deco','Controller@Deco');

Route::get('Detail-sur-un-client','detailSurUnClientController@index');

Route::get('Donnee-du-capteur','donneesDuCapteurController@index');
Route::get('Donnee-du-capteur/Format','donneesDuCapteurController@index');
Route::post('Donnee-du-capteur/Format','donneesDuCapteurController@validateformformat');


Route::get('planDuSiteController','Plan-du-site@index');


Route::get('Profil','profilController@index');
Route::get('Profil/Nom','profilController@index');
Route::post('Profil/Nom','profilController@validateformnom');

Route::get('Profil/Prenom','profilController@index@');
Route::post('Profil/Prenom','profilController@validateformprenom');

Route::get('Profil/Email','profilController@index');
Route::post('Profil/Email','profilController@validateformemail');

Route::get('Profil/Tel','profilController@index');
Route::post('Profil/Tel','profilController@validateformtel');

Route::get('Profil/avatar','profilController@index');
Route::post('Profil/avatar','profilController@validateformavatar');

Route::get('Profil/Pass','profilController@index');
Route::post('Profil/Pass','profilController@validateformpass');



Route::get('Gerer-les-capteurs','gererLesCapteursController@index');
Route::get('Gerer-les-capteurs/Ajouter','gererLesCapteursController@index');
Route::post('Gerer-les-capteurs/Ajouter','gererLesCapteursController@validateformajouter');

Route::get('Gerer-les-capteurs/Supprimer','gererLesCapteursController@index');
Route::post('Gerer-les-capteurs/Supprimer','gererLesCapteursController@validateformsupprimer');



Route::get('Gerer-les-clients','gererLesClientsController@index');
Route::get('Gerer-les-clients/Supprimer','gererLesClientsController@index');
Route::post('Gerer-les-clients/Supprimer','gererLesClientsController@validateformsupprimer');

Route::post('Gerer-les-clients','gererLesClientsController@validateformajouter');


Route::get('Gerer-les-sites','gererLesSitesController@index');
Route::get('Gerer-les-sites/Ajouter','gererLesSitesController@index');
Route::post('Gerer-les-sites/Ajouter','gererLesSitesController@validateformajouter');

Route::get('Gerer-les-sites/Supprimer','gererLesSitesController@index');
Route::post('Gerer-les-sites/Supprimer','gererLesSitesController@validateformsupprimer');


Route::get('Gerer-les-visiteurs','gererLesVisiteursController@index');
Route::get('Gerer-les-visiteurs/Reatribuer','gererLesVisiteursController@index');
Route::post('Gerer-les-visiteurs/Reatribuer','gererLesVisiteursController@validateformreatribuer');

Route::get('Gerer-les-visiteurs/Definir','gererLesVisiteursController@index');
Route::post('Gerer-les-visiteurs/Definir','gererLesVisiteursController@validateformdefinir');

Route::get('Gerer-les-visiteurs/Supprimer','gererLesVisiteursController@index');
Route::post('Gerer-les-visiteurs/Supprimer','gererLesVisiteursController@validateformsupprimer');


Route::get('Gerer-les-zones','gererLesZonesController@index');
Route::get('Gerer-les-zones/Ajouter','gererLesZonesController@index');
Route::post('Gerer-les-zones/Ajouter','gererLesZonesController@validateformreajouter');

Route::get('Gerer-les-zones/Supprimer','gererLesZonesController@index');
Route::post('Gerer-les-zones/Supprimer','gererLesZonesController@validateformsupprimer');



Route::get('Liste-des-capteurs','listeDesCapteursController@index');
Route::get('Liste-des-capteurs/Renommer','listeDesCapteursController@index');
Route::post('Liste-des-capteurs/Renommer','listeDesCapteursController@validateformrenommer');

Route::get('Liste-des-sites','listeDesSitesController@index');

Route::get('Liste-des-zones','listeDesZonesController@index');
Route::get('Liste-des-zones/Renommer','listeDesZonesController@index');
Route::post('Liste-des-zones/Renommer','listeDesZonesController@validateformrenommer');


Route::get('Liste-des-capteurs-ad','listDesCapteursAdController@index');
Route::get('Liste-des-capteurs-ad/Ajouter','listDesCapteursAdController@index');
Route::post('Liste-des-capteurs-ad/Ajouter','listDesCapteursAdController@validateformajouter');

Route::get('Liste-des-capteurs-ad/Supprimer','listDesCapteursAdController@index');
Route::post('Liste-des-capteurs-ad/Supprimer','listDesCapteursAdController@validateformsupprimer');


Route::get('Liste-des-sites-vi','listDesSiteViController@index');
Route::get('Liste-des-sites-vi/Ajouter','listDesSiteViController@index');
Route::post('Liste-des-sites-vi/Ajouter','listDesSiteViController@validateformajouter');

Route::get('Liste-des-sites-vi/Supprimer','listDesSiteViController@index');
Route::post('Liste-des-sites-vi/Supprimer','listDesSiteViController@validateformsupprimer');



Route::get('Conditions-gene-dutilisation','conditionsGeneralesdUtilisationController@index');
Route::get('Mentions-info-et-libertes','mentionsInformatiquesEtLibertesController@index');
Route::get('Mentions-legales','mentionsLegalesController@index');
Route::get('Politique-de-confidentialite','politiqueDeConfidentialiteController@index');

Route::get('500', function()
{
    abort(500);
});