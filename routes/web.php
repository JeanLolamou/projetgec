<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');

Route::get('/Accueil-GEC', [App\Http\Controllers\HomeController::class, 'accueilGEC'])->name('accueilGEC'); 
Route::get('/Accueil-PAO', [App\Http\Controllers\HomeController::class, 'accueilPAO'])->name('accueilPAO'); 
Route::get('/Accueil-MANIF-BESOIN', [App\Http\Controllers\HomeController::class, 'accueilMANIFBESOIN'])->name('accueilMANIFBESOIN'); 


//auth route for both 
Route::group(['middleware' => ['auth']], function() { 
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
});

Route::get('addposte',[App\Http\Controllers\PosteController::class,'create'])->name('addposte');
Route::post('ajoutposte',[App\Http\Controllers\PosteController::class,'store'])->name('ajoutposte');
Route::get('editPoste/{id}',[App\Http\Controllers\PosteController::class,'edit'])->name('editPoste');
Route::put('posteupdate',[App\Http\Controllers\PosteController::class,'update'])->name('posteupdate');
Route::get('listeposte',[App\Http\Controllers\PosteController::class,'index'])->name('listeposte');
// Route::get('/createPoste', 'App\Http\Controllers\PosteController@create')->name('createPoste');
// Route::resource('/poste', PosteController::class);

Route::get('adduser',[App\Http\Controllers\UserController::class,'create'])->name('adduser');
Route::post('ajoutuser',[App\Http\Controllers\PosteController::class,'store'])->name('ajoutuser');

Route::get('/createUser', 'App\Http\Controllers\UserController@create')->name('createUser');
Route::resource('/user', UserController::class);

Route::get('/createDepartement', 'App\Http\Controllers\DepartementController@create')->name('createDepartement');


Route::get('/showPoste', 'App\Http\Controllers\PosteController@index')->name('showPoste');

Route::get('/showDepartement', 'App\Http\Controllers\DepartementController@index')->name('showDepartement');

Route::get('/showUser', 'App\Http\Controllers\UserController@index')->name('showUser');

Route::get('/createSousdepartement', 'App\Http\Controllers\SousdepartementController@create')->name('createSousdepartement');
Route::post('/addSousdepartement', 'App\Http\Controllers\SousdepartementController@store')->name('addSousdepartement');
Route::put('/Sousdepartementupdate', 'App\Http\Controllers\SousdepartementController@update')->name('Sousdepartementupdate');


Route::get('/showSousdepartement', 'App\Http\Controllers\SousdepartementController@index')->name('showSousdepartement');

Route::get('/ModifierPoste/{id}', 'App\Http\Controllers\PosteController@edit')->name('ModifierPoste');
Route::resource('/poste', PosteController::class);

Route::get('addmenu',[App\Http\Controllers\MenuController::class,'create'])->name('addmenu');
Route::post('ajoutmenu',[App\Http\Controllers\MenuController::class,'store'])->name('ajoutmenu');
Route::get('editMenu/{id}',[App\Http\Controllers\MenuController::class,'edit'])->name('editMenu');
Route::put('menuupdate',[App\Http\Controllers\MenuController::class,'update'])->name('menuupdate');
Route::get('listemenu',[App\Http\Controllers\MenuController::class,'index'])->name('listemenu');
Route::get('deleteMenu/{id}',[App\Http\Controllers\MenuController::class,'destroy'])->name('deleteMenu');


Route::get('addsousmenu',[App\Http\Controllers\SousmenuController::class,'create'])->name('addmenu');
Route::post('ajoutsousmenu',[App\Http\Controllers\SousmenuController::class,'store'])->name('ajoutmenu');
Route::get('sousmenu/{id}',[App\Http\Controllers\SousmenuController::class,'edit'])->name('sousmenu');
Route::put('Sousmenuupdate',[App\Http\Controllers\SousmenuController::class,'update'])->name('Sousmenuupdate');
Route::get('listesousmenu',[App\Http\Controllers\SousmenuController::class,'index'])->name('listesousmenu');
Route::get('deleteSousmenu/{id}',[App\Http\Controllers\MenuController::class,'destroy'])->name('deleteSousmenu');



//Route::get('/createMenu', 'App\Http\Controllers\MenuController@create')->name('createMenu');
//Route::post('ajoutmenu',[App\Http\Controllers\MenuController::class,'store'])->name('ajoutmenu');
//Route::resource('/menu', MenuController::class);

Route::get('/showMenu', 'App\Http\Controllers\MenuController@index')->name('showMenu');

Route::get('/createSousmenu', [App\Http\Controllers\SousmenuController::class,'create'])->name('createSousmenu');
Route::resource('sousmenu',App\Http\Controllers\SousmenuController::class);
// Route::resource('/sousmenu', SousmenuController::class);
Route::get('/showSousmenu', [App\Http\Controllers\SousmenuController::class,'index'])->name('showSousmenu');

Route::get('/ModifierSousdepartement/{id}', 'App\Http\Controllers\SousdepartementController@edit')->name('ModifierSousdepartement');
Route::resource('/sousdepartement', SousdepartementController::class);

Route::get('/ModifierDepartement/{id}', 'App\Http\Controllers\DepartementController@edit')->name('ModifierDepartement');


Route::get('/ModifierUser/{id}', 'App\Http\Controllers\UserController@edit')->name('ModifierUser');
Route::resource('/user', UserController::class);

Route::get('/ModifierMenu/{id}', 'App\Http\Controllers\MenuController@edit')->name('ModifierMenu');
Route::resource('/menu', MenuController::class);

Route::get('/ModifierSousmenu/{id}', [App\Http\Controllers\SousmenuController::class,'edit'])->name('ModifierSousmenu');



//Lien courrier

Route::get('home',[App\Http\Controllers\CourrierController::class,'accueil'])->name('home');

Route::get('detailCourriertraiteGroupe/{id}',[App\Http\Controllers\CourrierController::class,'DetailcourrierenTraiteGroupe'])->name('detailCourriertraiteGroupe');


Route::get('addCourrier/{id}', [App\Http\Controllers\CourrierController::class, 'create'])->name('addCourrier/{id}');
Route::post('courrierArriver', [App\Http\Controllers\CourrierController::class, 'store'])->name('ajout Courrier Arrivé');


//  Route::post('courierArriv', [App\Http\Controllers\AffectationController::class, 'uploadteststore'])->name('courrierArriv');
//  Route::get('courrierArriv', [App\Http\Controllers\AffectationController::class, 'uploadtestcreate'])->name('courrierArriv');
//  Route::match(['get', 'post'], '/', uploadtestcreate() {
//     //
// });


Route::get('listeCourrierAttente',[App\Http\Controllers\CourrierController::class,'liste_descourrierenAttente'])->name('listeCourrierAttente');

Route::get('listeCourrierAttenteMinier',[App\Http\Controllers\CourrierController::class,'liste_descourrierenAttenteMinier'])->name('listeCourrierAttenteMinier');
Route::get('listeCourrierAttentepresidence',[App\Http\Controllers\CourrierController::class,'liste_descourrierenAttentePresidence'])->name('listeCourrierAttentepresidence');


Route::get('listeCourrierAffecterAugroupe',[App\Http\Controllers\CourrierController::class,'liste_descourrierenAffecteAuGroupe'])->name('listeCourrierAffecterAugroupe');

Route::get('listeCourrierTraiteAuGroupe',[App\Http\Controllers\CourrierController::class,'liste_descourrierTraiteAuGroupe'])->name('listeCourrierTraiteAuGroupe');

Route::get('listeCourrierASuivre',[App\Http\Controllers\CourrierController::class,'liste_descourrierenASuivre'])->name('listeCourrierASuivre');

Route::get('listeCourrierAttenteCollaborateur',[App\Http\Controllers\CourrierController::class,'liste_descourrierenAttenteCollaborateur'])->name('listeCourrierAttenteCollaborateur');

Route::get('listeCourrierArrive',[App\Http\Controllers\CourrierController::class,'liste_descourrierenArrive'])->name('listeCourrierArrive');
Route::get('listeCourrierArrivepresidence',[App\Http\Controllers\CourrierController::class,'liste_descourrierenArrivePresidence'])->name('listeCourrierArrivepresidence');
Route::get('listeCourrierArriveMine',[App\Http\Controllers\CourrierController::class,'liste_descourrierenArriveMine'])->name('listeCourrierArriveMine');

Route::get('listeCourrierDepart',[App\Http\Controllers\CourrierController::class,'liste_descourrierenDepart'])->name('listeCourrierDepart');

Route::get('listeCourrierAffecter',[App\Http\Controllers\CourrierController::class,'liste_descourrierenAffecte'])->name('listeCourrierAffecter');

Route::get('listeCourrierAffecterUrge',[App\Http\Controllers\CourrierController::class,'liste_descourrierenAffecteurge'])->name('listeCourrierAffecterUrge');



Route::get('listeCourrierAffecterPresidence',[App\Http\Controllers\CourrierController::class,'liste_descourrierenAffectepresidence'])->name('listeCourrierAffecterPresidence');

Route::get('listeCourrierAffecterMine',[App\Http\Controllers\CourrierController::class,'liste_descourrierenAffecteMine'])->name('listeCourrierAffecterMine');

Route::get('listeCourrierTraite',[App\Http\Controllers\CourrierController::class,'liste_descourrierenTraite'])->name('listeCourrierTraite');
Route::post('EnregistrementDecharge',[App\Http\Controllers\CourrierController::class,'SauvegardeDecharge'])->name('EnregistrementDecharge');
Route::get('detailCourriertraite/{id}',[App\Http\Controllers\CourrierController::class,'DetailcourrierenTraite'])->name('detailCourriertraite');

Route::get('dechargeCourrier/{id}',[App\Http\Controllers\CourrierController::class,'dechargeCourrierDepart'])->name('dechargeCourrier');
Route::get('RepondreCourrier/{id}',[App\Http\Controllers\AffectationController::class,'reponseCourrier'])->name('RepondreCourrier');
Route::get('detailCourrier/{id}', [App\Http\Controllers\CourrierController::class,'detailCourrierA'])->name('detailCourrier');

Route::get('detailAnnotationCourrier/{id}',[App\Http\Controllers\AffectationController::class,'DetailcourrierenAffecte'])->name('detailAnnotationCourrier');

Route::get('detailAnnotationCourrierGroupe/{id}',[App\Http\Controllers\AffectationController::class,'DetailcourrierenAffecteGroupe'])->name('detailAnnotationCourrierGroupe');


Route::post('/relanceannotation',[App\Http\Controllers\AffectationController::class,'relanceannotation'])->name('relanceannotation');

Route::post('reponseAuCourrier',[App\Http\Controllers\AffectationController::class,'transmission_Reponse'])->name('reponseAuCourrier');

Route::post('affectiondirection',[App\Http\Controllers\AffectationController::class,'store'])->name('affectiondirection');
// Route::match(['get', 'post'], '/', function () {
//     //
// });
Route::match(['get', 'post'], '/anotationdirection','App\Http\Controllers\AffectationController@anotationdirection');


// Route::post('anotationdirection',[App\Http\Controllers\AffectationController::class,'anotationdirection'])->name('anotationdirection');

Route::post('affectionManager',[App\Http\Controllers\AffectationController::class,'storeManager'])->name('affectionManager');

Route::get('json-direction',[App\Http\Controllers\AffectationController::class,'direction'])->name('json-direction');

Route::get('/json_employe', [App\Http\Controllers\AffectationController::class,'employe'])->name('json_employe');


Route::get('addannotation',[App\Http\Controllers\AnnotationtypeController::class,'create'])->name('addannotation');
Route::post('ajoutannotation',[App\Http\Controllers\AnnotationtypeController::class,'store'])->name('ajoutannotation');
Route::get('editAnnotation/{id}',[App\Http\Controllers\AnnotationtypeController::class,'edit'])->name('editAnnotation');
Route::put('annotationupdate',[App\Http\Controllers\AnnotationtypeController::class,'update'])->name('annotationupdate');
Route::get('annotation',[App\Http\Controllers\AnnotationtypeController::class,'index'])->name('annotation');



Route::put('updateActif',[App\Http\Controllers\UtilisateurController::class,'updateActif'])->name('updateActif');

Route::get('editUser/{id}',[App\Http\Controllers\UtilisateurController::class,'edit'])->name('editUser');
Route::put('modifieruser',[App\Http\Controllers\UtilisateurController::class,'update'])->name('modifieruser');
Route::put('modifierprofil',[App\Http\Controllers\UtilisateurController::class,'updateprofil'])->name('modifierprofil');
Route::put('modifierpassword',[App\Http\Controllers\UtilisateurController::class,'updatepassword'])->name('modifierpassword');
Route::post('ajoutuser',[App\Http\Controllers\UtilisateurController::class,'store'])->name('ajoutuser');
Route::get('addutilisateur',[App\Http\Controllers\UtilisateurController::class,'create'])->name('addutilisateur');
Route::get('utilisateur',[App\Http\Controllers\UtilisateurController::class,'index'])->name('utilisateur');
Route::get('utilisateurshow/{id}',[App\Http\Controllers\UtilisateurController::class,'show'])->name('utilisateurshow');

Route::get('editUserMdp/{id}',[App\Http\Controllers\UtilisateurController::class,'editmdp'])->name('editUserMdp');
Route::put('modifieruserMdp',[App\Http\Controllers\UtilisateurController::class,'updatemdp'])->name('modifieruserMdp');
Route::post('mailModifiPW',[App\Http\Controllers\UtilisateurController::class,'envoiMail'])->name('mailModifiPW');

Route::get('motdepassoublier',[App\Http\Controllers\UtilisateurController::class,'emailverification'])->name('motdepassoublier');
Route::get('page',[App\Http\Controllers\UtilisateurController::class,'pagesucces'])->name('page');
Route::get('pageuser',[App\Http\Controllers\UtilisateurController::class,'pageuser'])->name('pageuser');



Route::get('addposte',[App\Http\Controllers\PosteController::class,'create'])->name('addposte');
Route::post('ajoutposte',[App\Http\Controllers\PosteController::class,'store'])->name('ajoutposte');
Route::get('editPoste/{id}',[App\Http\Controllers\PosteController::class,'edit'])->name('editPoste');
Route::put('posteupdate',[App\Http\Controllers\PosteController::class,'update'])->name('posteupdate');
Route::get('poste',[App\Http\Controllers\PosteController::class,'index'])->name('poste');

Route::get('adddepartement',[App\Http\Controllers\DepartementController::class,'create'])->name('adddepartement');
Route::post('ajoutdepartement',[App\Http\Controllers\DepartementController::class,'store'])->name('ajoutdepartement');
Route::get('editDirection/{id}',[App\Http\Controllers\DepartementController::class,'edit'])->name('editDirection');
Route::put('departementupdate',[App\Http\Controllers\DepartementController::class,'update'])->name('departementupdate');
Route::get('listedepartement',[App\Http\Controllers\DepartementController::class,'index'])->name('listedepartement');
Route::get('deleteDepartement/{id}',[App\Http\Controllers\DepartementController::class,'destroy'])->name('deleteDepartement');



Route::post('ajoutservice',[App\Http\Controllers\ServiceController::class,'store'])->name('ajoutservice');
Route::get('addservice',[App\Http\Controllers\ServiceController::class,'create'])->name('addservice');
Route::get('service',[App\Http\Controllers\ServiceController::class,'index'])->name('service');




Route::get('addgroupe',[App\Http\Controllers\GroupeController::class,'create'])->name('addgroupe');
Route::post('ajoutgroupe',[App\Http\Controllers\GroupeController::class,'store'])->name('ajoutgroupe');
Route::get('editGroupe/{id}',[App\Http\Controllers\GroupeController::class,'edit'])->name('editGroupe');
Route::put('groupeupdate',[App\Http\Controllers\GroupeController::class,'update'])->name('groupeupdate');
Route::get('groupe',[App\Http\Controllers\GroupeController::class,'index'])->name('groupe');
Route::get('element_groupe',[App\Http\Controllers\GroupeController::class,'elementgroupe'])->name('element_groupe');
 // Route::get('element_groupe/{id}',[App\Http\Controllers\GroupeController::class,'elementgroupe'])->name('element_groupe');

Route::put('elementduGroupe',[App\Http\Controllers\GroupeController::class,'elementduGroupe'])->name('elementduGroupe');

Route::post('liste_groupe',[App\Http\Controllers\GroupeController::class,'liste_elementgroupe'])->name('liste_groupe');
/*Route::ressource('roles', 'App\Http\Controllers\Roles');*/

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/

//Priorite

Route::get('addpriorite',[App\Http\Controllers\PrioriteController::class,'create'])->name('addpriorite');
Route::post('ajoutpriorite',[App\Http\Controllers\PrioriteController::class,'store'])->name('ajoutpriorite');
Route::get('editPriorite/{id}',[App\Http\Controllers\PrioriteController::class,'edit'])->name('editPriorite');
Route::put('prioriteupdate',[App\Http\Controllers\PrioriteController::class,'update'])->name('prioriteupdate');
Route::get('listepriorite',[App\Http\Controllers\PrioriteController::class,'index'])->name('listepriorite');

//Couleur

Route::get('addcouleur',[App\Http\Controllers\CouleurController::class,'create'])->name('addcouleur');
Route::post('ajoutcouleur',[App\Http\Controllers\CouleurController::class,'store'])->name('ajoutcouleur');
Route::get('editCouleur/{id}',[App\Http\Controllers\CouleurController::class,'edit'])->name('editCouleur');
Route::put('couleurupdate',[App\Http\Controllers\CouleurController::class,'update'])->name('couleurupdate');
Route::get('listecouleur',[App\Http\Controllers\CouleurController::class,'index'])->name('listecouleur');

//Notification

Route::get('addnotification',[App\Http\Controllers\NotificationController::class,'create'])->name('addnotification');
Route::post('ajoutnotification',[App\Http\Controllers\NotificationController::class,'store'])->name('ajoutnotification');
Route::get('editNotification/{id}',[App\Http\Controllers\NotificationController::class,'edit'])->name('editNotification');
Route::put('notificationupdate',[App\Http\Controllers\NotificationController::class,'update'])->name('notificationupdate');
Route::get('listenotification',[App\Http\Controllers\NotificationController::class,'index'])->name('listenotification');


Route::get('/Liste-activités',[App\Http\Controllers\HomeController::class,'activite'])->name('Liste-activités');
Route::get('/Mon-profil',[App\Http\Controllers\HomeController::class,'profil'])->name('profil');
Route::get('/listeMenu',[App\Http\Controllers\PosteController::class,'paramenu'])->name('listeMenu');

Route::post('ajoutcouleur',[App\Http\Controllers\CouleurController::class,'store'])->name('ajoutcouleur');
Route::get('editCouleur/{id}',[App\Http\Controllers\CouleurController::class,'edit'])->name('editCouleur');
Route::put('couleurupdate',[App\Http\Controllers\CouleurController::class,'update'])->name('couleurupdate');
Route::get('listecouleur',[App\Http\Controllers\CouleurController::class,'index'])->name('listecouleur');


//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/Tableau-de-bord', 'HomeController@accueil')->name('accueil');

Route::get('/Personnel', 'HomeController@personnel')->name('personnel');

Route::get('/Ajout-Personnel', 'HomeController@inscription')->name('inscription');

//Route::get('/Mon-profil', 'HomeController@profil')->name('profil');

//Route::get('/Liste-Directions', 'HomeController@direction')->name('direction');

Route::resource('User',App\Http\Controllers\UserController::class);
// Route::resource('User','UserController');
Route::resource('Direction',App\Http\Controllers\DirectionController::class);
// Route::resource('Direction','DirectionController');
Route::resource('Activite',App\Http\Controllers\ActiviteController::class);
Route::resource('Sousactivite',App\Http\Controllers\SousactiviteController::class);
Route::resource('Reporting',App\Http\Controllers\ReportingController::class);


// Route::resource('Activite','ActiviteController');
Route::resource('Reunion',App\Http\Controllers\ReunionController::class);
Route::resource('Reuniondepartement',App\Http\Controllers\ReuniondepartementController::class);
Route::resource('Participant',App\Http\Controllers\ParticipantController::class);
Route::resource('Participantdepartement',App\Http\Controllers\ParticipantdepartementController::class);
// Route::resource('Participant','ParticipantController');
Route::resource('Expose',App\Http\Controllers\ExposeController::class);
Route::resource('Exposedepartement',App\Http\Controllers\ExposedepartementController::class);
// Route::resource('Expose','ExposeController');	
Route::resource('Recommandation',App\Http\Controllers\RecommandationController::class);
Route::resource('Recommandationdepartement',App\Http\Controllers\RecommandationdepartementController::class);
// Route::resource('Recommandation','RecommandationController');
Route::resource('Rapport',App\Http\Controllers\RapportController::class);
// Route::resource('Rapport','RapportController');
Route::resource('Parametre',App\Http\Controllers\ParametreController::class);
// Route::resource('Parametre','ParametreController');



//Route::post('/Liste-activités', 'HomeController@activite')->name('activite');


Route::get('dynamic_pdf/pdf-pao/{direction}/{statut}/{debut}/{fin}',[App\Http\Controllers\PdfController::class,'pdfactivite'])->name('pdfactivite');

Route::get('/Ajout-Sous-Activite/{id}',[App\Http\Controllers\HomeController::class,'ajoutSousActivite'])->name('ajoutSousActivite');





Route::get('dynamic_pdf/pdf-reunion/{id}',[App\Http\Controllers\PdfController::class,'pdfreunion'])->name('pdfreunion');
Route::get('Edition-Parametre-Reunion/{id}',[App\Http\Controllers\HomeController::class,'parametrerReunion'])->name('parametrerReunion');


Route::get('dynamic_pdf/pdf-reuniondepartement/{id}',[App\Http\Controllers\PdfController::class,'pdfreuniondepartement'])->name('pdfreuniondepartement');
Route::get('Edition-Parametre-Reuniondepartement/{id}',[App\Http\Controllers\HomeController::class,'parametrerReuniondepartement'])->name('parametrerReuniondepartement');


Route::get('dynamic_pdf/pdf-rapport-unique/{id}',[App\Http\Controllers\PdfController::class,'pdfrapportunique'])->name('pdfrapportunique');

Route::get('dynamic_pdf/pdf-rapportmens-unique/{id}',[App\Http\Controllers\PdfController::class,'pdfrapportmensunique'])->name('pdfrapportmensunique');

Route::get('dynamic_pdf/pdf-globalrapportmens-unique/{id}',[App\Http\Controllers\PdfController::class,'globalpdfrapportmensunique'])->name('globalpdfrapportmensunique');


//rapport global mensuel par mois pour la directrice

Route::get('/dynamic_pdf/pdf-janglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'janglobalpdfrapportmensunique'])->name('janglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-fevglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'fevglobalpdfrapportmensunique'])->name('fevglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-marglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'marglobalpdfrapportmensunique'])->name('marglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-avrglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'avrglobalpdfrapportmensunique'])->name('avrglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-maiglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'maiglobalpdfrapportmensunique'])->name('maiglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-juinglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'juinglobalpdfrapportmensunique'])->name('juinglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-juilglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'juilglobalpdfrapportmensunique'])->name('juilglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-aoutglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'aoutglobalpdfrapportmensunique'])->name('aoutglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-septglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'septglobalpdfrapportmensunique'])->name('septglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-octglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'octglobalpdfrapportmensunique'])->name('octglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-novglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'novglobalpdfrapportmensunique'])->name('novglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-decglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'decglobalpdfrapportmensunique'])->name('decglobalpdfrapportmensunique');
//fin rapport global mensuel par mois pour la directrice



//rapport global mensuel par mois pour le manager

Route::get('/dynamic_pdf/pdf-janmaglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'janmaglobalpdfrapportmensunique'])->name('janmaglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-fevmaglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'fevmaglobalpdfrapportmensunique'])->name('fevmaglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-marmaglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'marmaglobalpdfrapportmensunique'])->name('marmaglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-avrmaglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'avrmaglobalpdfrapportmensunique'])->name('avrmaglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-maimaglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'maimaglobalpdfrapportmensunique'])->name('maimaglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-juinmaglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'juinmaglobalpdfrapportmensunique'])->name('juinmaglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-juilmaglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'juilmaglobalpdfrapportmensunique'])->name('juilmaglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-aoutmaglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'aoutmaglobalpdfrapportmensunique'])->name('aoutmaglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-septmaglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'septmaglobalpdfrapportmensunique'])->name('septmaglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-octmaglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'octmaglobalpdfrapportmensunique'])->name('octmaglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-novmaglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'novmaglobalpdfrapportmensunique'])->name('novmaglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-decmaglobalrapportmens-unique',[App\Http\Controllers\PdfController::class,'decmaglobalpdfrapportmensunique'])->name('decmaglobalpdfrapportmensunique');
//fin rapport global mensuel par mois pour le manager





//rapport global hebdomadaire par mois pour la directrice

Route::get('/dynamic_pdf/pdf-janglobalrapport-unique',[App\Http\Controllers\PdfController::class,'janglobalpdfrapportunique'])->name('janglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-fevglobalrapport-unique',[App\Http\Controllers\PdfController::class,'fevglobalpdfrapportunique'])->name('fevglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-marglobalrapport-unique',[App\Http\Controllers\PdfController::class,'marglobalpdfrapportunique'])->name('marglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-avrglobalrapport-unique',[App\Http\Controllers\PdfController::class,'avrglobalpdfrapportunique'])->name('avrglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-maiglobalrapport-unique',[App\Http\Controllers\PdfController::class,'maiglobalpdfrapportunique'])->name('maiglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-juinglobalrapport-unique',[App\Http\Controllers\PdfController::class,'juinglobalpdfrapportunique'])->name('juinglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-juilglobalrapport-unique',[App\Http\Controllers\PdfController::class,'juilglobalpdfrapportunique'])->name('juilglobalpdfrapportmensunique');

Route::get('/dynamic_pdf/pdf-aoutglobalrapport-unique',[App\Http\Controllers\PdfController::class,'aoutglobalpdfrapportunique'])->name('aoutglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-septglobalrapport-unique',[App\Http\Controllers\PdfController::class,'septglobalpdfrapportunique'])->name('septglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-octglobalrapport-unique',[App\Http\Controllers\PdfController::class,'octglobalpdfrapportunique'])->name('octglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-novglobalrapport-unique',[App\Http\Controllers\PdfController::class,'novglobalpdfrapportunique'])->name('novglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-decglobalrapport-unique',[App\Http\Controllers\PdfController::class,'decglobalpdfrapportunique'])->name('decglobalpdfrapportunique');
//fin rapport global mensuel par mois pour la directrice



//rapport global hebdomadaire par mois pour le manager

Route::get('/dynamic_pdf/pdf-janmaglobalrapport-unique',[App\Http\Controllers\PdfController::class,'janmaglobalpdfrapportunique'])->name('janmaglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-fevmaglobalrapport-unique',[App\Http\Controllers\PdfController::class,'fevmaglobalpdfrapportunique'])->name('fevmaglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-marmaglobalrapport-unique',[App\Http\Controllers\PdfController::class,'marmaglobalpdfrapportunique'])->name('marmaglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-avrmaglobalrapport-unique',[App\Http\Controllers\PdfController::class,'avrmaglobalpdfrapportunique'])->name('avrmaglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-maimaglobalrapport-unique',[App\Http\Controllers\PdfController::class,'maimaglobalpdfrapportunique'])->name('maimaglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-juinmaglobalrapport-unique',[App\Http\Controllers\PdfController::class,'juinmaglobalpdfrapportunique'])->name('juinmaglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-juilmaglobalrapport-unique',[App\Http\Controllers\PdfController::class,'juilmaglobalpdfrapportunique'])->name('juilmaglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-aoutmaglobalrapport-unique',[App\Http\Controllers\PdfController::class,'aoutmaglobalpdfrapportunique'])->name('aoutmaglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-septmaglobalrapport-unique',[App\Http\Controllers\PdfController::class,'septmaglobalpdfrapportunique'])->name('septmaglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-octmaglobalrapport-unique',[App\Http\Controllers\PdfController::class,'octmaglobalpdfrapportunique'])->name('octmaglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-novmaglobalrapport-unique',[App\Http\Controllers\PdfController::class,'novmaglobalpdfrapportunique'])->name('novmaglobalpdfrapportunique');

Route::get('/dynamic_pdf/pdf-decmaglobalrapport-unique',[App\Http\Controllers\PdfController::class,'decmaglobalpdfrapportunique'])->name('decmaglobalpdfrapportunique');
//fin rapport global hebdomadaire par mois pour le manager





//Route::post('/Liste-rapports', 'HomeController@rapport')->name('rapport');



Route::get('addactivite',[App\Http\Controllers\ActiviteController::class,'create'])->name('addactivite');
Route::post('ajoutactivite',[App\Http\Controllers\ActiviteController::class,'store'])->name('ajoutactivite');
Route::get('editActivite/{id}',[App\Http\Controllers\ActiviteController::class,'edit'])->name('editActivite');
Route::put('activiteupdate/{id}',[App\Http\Controllers\ActiviteController::class,'update'])->name('activiteupdate');
Route::get('/Liste-activités',[App\Http\Controllers\ActiviteController::class,'index'])->name('activite');
Route::get('activiteshow/{id}',[App\Http\Controllers\ActiviteController::class,'show'])->name('activiteshow');
// Route::post('/Liste-activités',[App\Http\Controllers\ActiviteController::class,'activite'])->name('activite');
Route::get('/export_activite',[App\Http\Controllers\ActiviteController::class,'export_activite'])->name('export_activite');
Route::get('/export_rapportmens',[App\Http\Controllers\RapportmensController::class,'export_rapportmens'])->name('export_rapportmens');
Route::get('/export_rapport',[App\Http\Controllers\RapportController::class,'export_rapport'])->name('export_rapport');



Route::post('/import_excel/import', 'ImportExcelController@import')->name('importexcel');

Route::get('addreunion',[App\Http\Controllers\ReunionController::class,'create'])->name('addreunion');
Route::post('ajoutreunion',[App\Http\Controllers\ReunionController::class,'store'])->name('ajoutreunion');
Route::get('editReunion/{id}',[App\Http\Controllers\ReunionController::class,'edit'])->name('editReunion');
Route::put('reunionupdate/{id}',[App\Http\Controllers\ReunionController::class,'update'])->name('reunionupdate');
Route::get('/Liste-reunions',[App\Http\Controllers\ReunionController::class,'index'])->name('listereunion');
Route::get('reunionshow/{id}',[App\Http\Controllers\ReunionController::class,'show'])->name('reunionshow');
Route::get('deleteReunion/{id}',[App\Http\Controllers\ReunionController::class,'destroy'])->name('deleteReunion');


Route::get('addreuniondepartement',[App\Http\Controllers\ReuniondepartementController::class,'create'])->name('addreuniondepartement');
Route::post('ajoutreuniondepartement',[App\Http\Controllers\ReuniondepartementController::class,'store'])->name('ajoutreuniondepartement');
Route::get('editReuniondepartement/{id}',[App\Http\Controllers\ReuniondepartementController::class,'edit'])->name('editReuniondepartement');
Route::put('reuniondepartementupdate/{id}',[App\Http\Controllers\ReuniondepartementController::class,'update'])->name('reuniondepartementupdate');
Route::get('/Liste-reuniondepartements',[App\Http\Controllers\ReuniondepartementController::class,'index'])->name('listereuniondepartement');
Route::get('reuniondepartementshow/{id}',[App\Http\Controllers\ReuniondepartementController::class,'show'])->name('reuniondepartementshow');
Route::get('deleteReuniondepartement/{id}',[App\Http\Controllers\ReuniondepartementController::class,'destroy'])->name('deleteReuniondepartement');



Route::get('addrapport',[App\Http\Controllers\RapportController::class,'create'])->name('addreapport');
Route::post('ajoutrapport',[App\Http\Controllers\RapportController::class,'store'])->name('ajoutrapport');
Route::get('editRapport/{id}',[App\Http\Controllers\RapportController::class,'edit'])->name('editRapport');
Route::put('rapportupdate/{id}',[App\Http\Controllers\RapportController::class,'update'])->name('rapportupdate');
Route::get('/Liste-rapports',[App\Http\Controllers\RapportController::class,'index'])->name('rapport');
Route::get('rapportshow/{id}',[App\Http\Controllers\RapportController::class,'show'])->name('rapportshow');
Route::delete('rapportedelate/{id}',[App\Http\Controllers\RapportController::class,'destroy'])->name('rapportdelete');
Route::get('/search',[App\Http\Controllers\RapportController::class,'search'])->name('search');
Route::get('/Live_search',[App\Http\Controllers\LiveSearch::class,'index']);
Route::get('/Live_search/action',[App\Http\Controllers\LiveSearch::class,'action'])->name('Live_search.action');
Route::get('/globalrapport',[App\Http\Controllers\RapportController::class,'global'])->name('globalrapport');
Route::get('/manglobalrapport',[App\Http\Controllers\RapportController::class,'globalmanager'])->name('manglobalrapport');



Route::get('addrapportmen',[App\Http\Controllers\RapportmensController::class,'create'])->name('addrapportmen');
Route::post('ajoutrapportmen',[App\Http\Controllers\RapportmensController::class,'store'])->name('ajoutrapportmen');
Route::get('editRapportmen/{id}',[App\Http\Controllers\RapportmensController::class,'edit'])->name('editRapportmen');
Route::put('rapportupdatemen/{id}',[App\Http\Controllers\RapportmensController::class,'update'])->name('rapportupdatemen');
Route::get('/Liste-rapportmens',[App\Http\Controllers\RapportmensController::class,'index'])->name('rapportmen');
Route::get('rapportshowmen/{id}',[App\Http\Controllers\RapportmensController::class,'show'])->name('rapportshowmen');
Route::delete('rapportdelatemen/{id}',[App\Http\Controllers\RapportmensController::class,'destroy'])->name('rapportdeletement');
Route::get('/search',[App\Http\Controllers\RapportmensController::class,'search'])->name('search');
Route::get('/Live_search',[App\Http\Controllers\LiveSearch::class,'index']);
Route::get('/Live_search/action',[App\Http\Controllers\LiveSearch::class,'action'])->name('Live_search.action');
Route::get('/Liste-globalrapportmens',[App\Http\Controllers\RapportmensController::class,'globalmens'])->name('globalrapportmen');
Route::get('/globalrapportmens',[App\Http\Controllers\RapportmensController::class,'global'])->name('globalrapportmens');
Route::get('/manglobalrapportmens',[App\Http\Controllers\RapportmensController::class,'globalmanager'])->name('manglobalrapportmens');


Route::get('addparticipant',[App\Http\Controllers\ParticipantController::class,'create'])->name('addparticipant');
Route::post('ajoutparticipant',[App\Http\Controllers\ParticipantController::class,'store'])->name('ajoutparticipant');
Route::get('editParticipant/{id}',[App\Http\Controllers\ParticipantController::class,'edit'])->name('editParticipant');
Route::put('participantupdate/{id}',[App\Http\Controllers\ParticipantController::class,'update'])->name('participantupdate');
Route::get('/Liste-participants',[App\Http\Controllers\ParticipantController::class,'index'])->name('listeparticipant');
Route::get('participantshow/{id}',[App\Http\Controllers\ParticipantController::class,'show'])->name('participantshow');


Route::get('addparticipantdepartement',[App\Http\Controllers\ParticipantdepartementController::class,'create'])->name('addparticipantdepartement');
Route::post('ajoutparticipantdepartement',[App\Http\Controllers\ParticipantdepartementController::class,'store'])->name('ajoutparticipantdepartement');
Route::get('editParticipantdepartement/{id}',[App\Http\Controllers\ParticipantdepartementController::class,'edit'])->name('editParticipantdepartement');
Route::put('participantdepartementupdate/{id}',[App\Http\Controllers\ParticipantdepartementController::class,'update'])->name('participantdepartementupdate');
Route::get('/Liste-participantdepartements',[App\Http\Controllers\ParticipantdepartementController::class,'index'])->name('listeparticipantdepartement');
Route::get('participantdepartementshow/{id}',[App\Http\Controllers\ParticipantdepartementController::class,'show'])->name('participantdepartementshow');






Route::get('addrecommandation',[App\Http\Controllers\RecommandationController::class,'create'])->name('addrecommandation');
Route::post('ajoutrecommandation',[App\Http\Controllers\RecommandationController::class,'store'])->name('ajoutrecommandation');
Route::get('editRecommandation/{id}',[App\Http\Controllers\RecommandationController::class,'edit'])->name('editRecommandation');
Route::put('recommandationupdate/{id}',[App\Http\Controllers\RecommandationController::class,'update'])->name('recommandationupdate');
Route::get('/Liste-recommandations',[App\Http\Controllers\RecommandationController::class,'index'])->name('listerecommandation');
Route::get('recommandationshow/{id}',[App\Http\Controllers\RecommandationController::class,'show'])->name('recommandationshow');




Route::get('addrecommandationdepartement',[App\Http\Controllers\RecommandationdepartementController::class,'create'])->name('addrecommandation');
Route::post('ajoutrecommandationdepartement',[App\Http\Controllers\RecommandationdepartementController::class,'store'])->name('ajoutrecommandationdepartement');
Route::get('editRecommandationdepartement/{id}',[App\Http\Controllers\RecommandationdepartementController::class,'edit'])->name('editRecommandationdepartement');
Route::put('recommandationdepartementupdate/{id}',[App\Http\Controllers\RecommandationdepartementController::class,'update'])->name('recommandationdepartementupdate');
Route::get('/Liste-recommandationdepartements',[App\Http\Controllers\RecommandationdepartementController::class,'index'])->name('listerecommandationdepartement');
Route::get('recommandationshow/{id}',[App\Http\Controllers\RecommandationdepartementController::class,'show'])->name('recommandationdepartementshow');




Route::get('addexpose',[App\Http\Controllers\ExposeController::class,'create'])->name('addexpose');
Route::post('ajoutexpose',[App\Http\Controllers\ExposeController::class,'store'])->name('ajoutexpose');
Route::get('editExpose/{id}',[App\Http\Controllers\ExposeController::class,'edit'])->name('editExpose');
Route::put('exposeupdate/{id}',[App\Http\Controllers\ExposeController::class,'update'])->name('exposeupdate');
Route::get('/Liste-exposes',[App\Http\Controllers\ExposeController::class,'index'])->name('listexpose');
Route::get('exposeshow/{id}',[App\Http\Controllers\ExposeController::class,'show'])->name('exposeshow');


Route::get('addaction',[App\Http\Controllers\ActionController::class,'create'])->name('addaction');
Route::post('ajoutaction',[App\Http\Controllers\ActionController::class,'store'])->name('ajoutaction');
Route::get('editAction/{id}',[App\Http\Controllers\ActionController::class,'edit'])->name('editAction');
Route::put('actionupdate/{id}',[App\Http\Controllers\ActionController::class,'update'])->name('actionupdate');
Route::get('/Liste-actions',[App\Http\Controllers\ActionController::class,'index'])->name('listaction');
Route::get('actionshow/{id}',[App\Http\Controllers\ActionController::class,'show'])->name('actionshow');





Route::get('addexposedepartement',[App\Http\Controllers\ExposedepartementController::class,'create'])->name('addexposedepartement');
Route::post('ajoutexposedepartement',[App\Http\Controllers\ExposedepartementController::class,'store'])->name('ajoutexposedepartement');
Route::get('editExposedepartement/{id}',[App\Http\Controllers\ExposedepartementController::class,'edit'])->name('editExposedepartement');
Route::put('exposedepartementupdate/{id}',[App\Http\Controllers\ExposedepartementController::class,'update'])->name('exposedepartementupdate');
Route::get('/Liste-exposedepartements',[App\Http\Controllers\ExposedepartementController::class,'index'])->name('listexposedepartement');
Route::get('exposedepartementshow/{id}',[App\Http\Controllers\ExposedepartementController::class,'show'])->name('exposedepartementshow');





Route::get('adddirection',[App\Http\Controllers\DirectionController::class,'create'])->name('adddirection');
Route::post('ajoutdirection',[App\Http\Controllers\DirectionController::class,'store'])->name('ajoutdirection');
Route::get('editDirection/{id}',[App\Http\Controllers\DirectionController::class,'edit'])->name('editDirection');
Route::put('directionupdate/{id}',[App\Http\Controllers\DirectionController::class,'update'])->name('directionupdate');
Route::get('/Liste-directions',[App\Http\Controllers\DirectionController::class,'index'])->name('listedirection');
Route::get('exposeshow/{id}',[App\Http\Controllers\DirectionController::class,'show'])->name('exposeshow');

Route::get('relancecourrier',[App\Http\Controllers\CourrierController::class,'relance'])->name('relancecourrier');



// Route::get('dynamic_pdf/pdf-rapport/{direction}/{debut}/{fin}', 'PdfController@pdfrapport')->name('pdfrapport');
Route::get('dynamic_pdf/pdf-rapport/{direction}/{debut}/{fin}',[App\Http\Controllers\PdfController::class,'pdfrapport'])->name('pdfrapport');


Route::get('/Statistiques',[App\Http\Controllers\HomeController::class,'statistique'])->name('statistique');
Route::get('/Statistiquecourriers',[App\Http\Controllers\HomeController::class,'statistiquecourrier'])->name('statistiquecourrier');
// Route::get('/Statistiques', 'HomeController@statistique')->name('statistique');

Route::post('/Statistiques',[App\Http\Controllers\HomeController::class,'filtrestatistique'])->name('filtrestatistique');
// Route::post('/Statistiques', 'HomeController@filtrestatistique')->name('filtrestatistique');

Route::get('/Statistiques-Globale',[App\Http\Controllers\HomeController::class,'statistiqueglob'])->name('statistiqueGlob');
// Route::get('/Statistiques-Globale', 'HomeController@statistiqueglob')->name('statistiqueGlob');

Route::post('/Statistiques-Globale',[App\Http\Controllers\HomeController::class,'filtrestatistiqueglob'])->name('filtrestatistiqueGlob');
// Route::post('/Statistiques-Globale', 'HomeController@filtrestatistiqueglob')->name('filtrestatistiqueGlob');

//Route::get('dynamic_pdf/pdf-rapport-unique/{id}', 'PdfController@pdfrapportunique')->name('pdfrapportunique');







require __DIR__.'/auth.php';
