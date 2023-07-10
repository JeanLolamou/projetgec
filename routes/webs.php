<?php
use App\Http\Controllers\CourrierController;

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

Route::get('addRendez_vous', [App\Http\Controllers\VisiteurController::class, 'create'])->name('addRendez_vous');
Route::post('storeRendez_vous', [App\Http\Controllers\VisiteurController::class, 'store'])->name('storeRendez_vous');
Route::post('storeVisiteur', [App\Http\Controllers\VisiteurController::class, 'storevisiteur'])->name('storeVisiteur');

Route::get('editRendez_vous/{id}',[App\Http\Controllers\VisiteurController::class,'edit'])->name('editRendez_vous');
Route::put('present_rendez_vous_update',[App\Http\Controllers\VisiteurController::class,'validationRendez_vous'])->name('present_rendez_vous_update');

Route::put('rendez_vous_update',[App\Http\Controllers\VisiteurController::class,'update'])->name('rendez_vous_update');
Route::get('listeRendez_vous',[App\Http\Controllers\VisiteurController::class,'index'])->name('listeRendez_vous');
Route::get('presentRendez_vous',[App\Http\Controllers\VisiteurController::class,'present_rendez_vous'])->name('presentRendez_vous');

Route::get('tableauBord', [App\Http\Controllers\HomeController::class, 'index'])->name('tableauBord');
Route::get('home',[App\Http\Controllers\CourrierController::class,'accueil'])->name('home');

Route::get('detailCourriertraiteGroupe/{id}',[App\Http\Controllers\CourrierController::class,'DetailcourrierenTraiteGroupe'])->name('detailCourriertraiteGroupe');
Auth::routes();

Route::get('addCourrier/{id}', [App\Http\Controllers\CourrierController::class, 'create'])->name('addCourrier/{id}');
Route::post('courrierArriver', [App\Http\Controllers\CourrierController::class, 'store'])->name('ajout Courrier Arrivé');


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

Route::get('listeCourrierAffecterPresidence',[App\Http\Controllers\CourrierController::class,'liste_descourrierenAffectepresidence'])->name('listeCourrierAffecterPresidence');

Route::get('listeCourrierAffecterMine',[App\Http\Controllers\CourrierController::class,'liste_descourrierenAffecteMine'])->name('listeCourrierAffecterMine');

Route::get('listeCourrierTraite',[App\Http\Controllers\CourrierController::class,'liste_descourrierenTraite'])->name('listeCourrierTraite');
Route::post('EnregistrementDecharge',[App\Http\Controllers\CourrierController::class,'SauvegardeDecharge'])->name('EnregistrementDecharge');
Route::get('detailCourriertraite/{id}',[App\Http\Controllers\CourrierController::class,'DetailcourrierenTraite'])->name('detailCourriertraite');

Route::get('dechargeCourrier/{id}',[App\Http\Controllers\CourrierController::class,'dechargeCourrierDepart'])->name('dechargeCourrier');
Route::get('RepondreCourrier/{id}',[App\Http\Controllers\AffectationController::class,'reponseCourrier'])->name('RepondreCourrier');
Route::get('detailCourrier/{id}', [App\Http\Controllers\CourrierController::class,'detailCourrierA'])->name('detailCourrier');

Route::get('detailAnnotationCourrier/{id}',[App\Http\Controllers\AffectationController::class,'DetailcourrierenAffecte'])->name('detailAnnotationCourrier');

Route::post('/relanceannotation',[App\Http\Controllers\AffectationController::class,'relanceannotation'])->name('relanceannotation');

Route::post('reponseAuCourrier',[App\Http\Controllers\AffectationController::class,'transmission_Reponse'])->name('reponseAuCourrier');

Route::post('affectiondirection',[App\Http\Controllers\AffectationController::class,'store'])->name('affectiondirection');
Route::post('anotationdirection',[App\Http\Controllers\AffectationController::class,'anotationdirection'])->name('anotationdirection');

Route::post('affectionManager',[App\Http\Controllers\AffectationController::class,'storeManager'])->name('affectionManager');

Route::get('json-direction',[App\Http\Controllers\AffectationController::class,'direction'])->name('json-direction');

Route::get('/json_employe', [App\Http\Controllers\AffectationController::class,'employe'])->name('json_employe');



Route::get('addposte',[App\Http\Controllers\PosteController::class,'create'])->name('addposte');
Route::post('ajoutposte',[App\Http\Controllers\PosteController::class,'store'])->name('ajoutposte');
Route::get('editPoste/{id}',[App\Http\Controllers\PosteController::class,'edit'])->name('editPoste');
Route::put('posteupdate',[App\Http\Controllers\PosteController::class,'update'])->name('posteupdate');
Route::get('poste',[App\Http\Controllers\PosteController::class,'index'])->name('poste');

Route::get('adddepartement',[App\Http\Controllers\DepartementController::class,'create'])->name('adddepartement');
Route::post('ajoutdepartement',[App\Http\Controllers\DepartementController::class,'store'])->name('ajoutdepartement');
Route::get('editDirection/{id}',[App\Http\Controllers\DepartementController::class,'edit'])->name('editDirection');
Route::put('departementupdate',[App\Http\Controllers\DepartementController::class,'update'])->name('departementupdate');
Route::get('departement',[App\Http\Controllers\DepartementController::class,'index'])->name('departement');


Route::put('updateActif',[App\Http\Controllers\UtilisateurController::class,'updateActif'])->name('updateActif');

Route::get('editUser/{id}',[App\Http\Controllers\UtilisateurController::class,'edit'])->name('editUser');
Route::put('modifieruser',[App\Http\Controllers\UtilisateurController::class,'update'])->name('modifieruser');
Route::post('ajoutuser',[App\Http\Controllers\UtilisateurController::class,'store'])->name('ajoutuser');
Route::get('addutilisateur',[App\Http\Controllers\UtilisateurController::class,'create'])->name('addutilisateur');
Route::get('utilisateur',[App\Http\Controllers\UtilisateurController::class,'index'])->name('utilisateur');

Route::post('ajoutservice',[App\Http\Controllers\ServiceController::class,'store'])->name('ajoutservice');
Route::get('addservice',[App\Http\Controllers\ServiceController::class,'create'])->name('addservice');
Route::get('service',[App\Http\Controllers\ServiceController::class,'index'])->name('service');


Route::get('addannotation',[App\Http\Controllers\AnnotationtypeController::class,'create'])->name('addannotation');
Route::post('ajoutannotation',[App\Http\Controllers\AnnotationtypeController::class,'store'])->name('ajoutannotation');
Route::get('editAnnotation/{id}',[App\Http\Controllers\AnnotationtypeController::class,'edit'])->name('editAnnotation');
Route::put('annotationupdate',[App\Http\Controllers\AnnotationtypeController::class,'update'])->name('annotationupdate');
Route::get('annotation',[App\Http\Controllers\AnnotationtypeController::class,'index'])->name('annotation');



Route::get('editUserMdp/{id}',[App\Http\Controllers\UtilisateurController::class,'editmdp'])->name('editUserMdp');
Route::put('modifieruserMdp',[App\Http\Controllers\UtilisateurController::class,'updatemdp'])->name('modifieruserMdp');
Route::post('mailModifiPW',[App\Http\Controllers\UtilisateurController::class,'envoiMail'])->name('mailModifiPW');

Route::get('motdepassoublier',[App\Http\Controllers\UtilisateurController::class,'emailverification'])->name('motdepassoublier');
Route::get('page',[App\Http\Controllers\UtilisateurController::class,'pagesucces'])->name('page');







Route::get('addgroupe',[App\Http\Controllers\GroupeController::class,'create'])->name('addgroupe');
Route::post('ajoutgroupe',[App\Http\Controllers\GroupeController::class,'store'])->name('ajoutgroupe');
Route::get('editGroupe/{id}',[App\Http\Controllers\GroupeController::class,'edit'])->name('editGroupe');
Route::put('groupeupdate',[App\Http\Controllers\GroupeController::class,'update'])->name('groupeupdate');
Route::get('groupe',[App\Http\Controllers\GroupeController::class,'index'])->name('groupe');
Route::get('element_groupe',[App\Http\Controllers\GroupeController::class,'elementgroupe'])->name('element_groupe');

Route::put('elementduGroupe',[App\Http\Controllers\GroupeController::class,'elementduGroupe'])->name('elementduGroupe');

Route::post('liste_groupe',[App\Http\Controllers\GroupeController::class,'liste_elementgroupe'])->name('liste_groupe');