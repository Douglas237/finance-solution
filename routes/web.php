<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\RetraitController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransfertController; 
use App\Http\Controllers\VersementController;
use App\Http\Controllers\CompteBankController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\ModalCarteController;
use App\Http\Controllers\ModalClientController;
use App\Http\Controllers\ModalCompteController;
use App\Http\Controllers\BeneficiaireController;
use App\Http\Controllers\ModalEmployerController;
use App\Http\Controllers\ModalEntreprisController;
use App\Http\Controllers\ModalBeneficiaireController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//return view('layouts.dashboard');
Route::group(['namespace' => 'App\Http\Controllers'], function () {
    // Route::get('/', function () {
    //     return view('login.show');
    // });

    // manager login
    Route::get('/', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login-perform', [LoginController::class, 'login'])->name('login.perform');

    // Route::group(['middleware' => ['guest']], function () {

    // });

    Route::group(['middleware' => ['auth']], function () {

        //manager register
        Route::get('/register-show', [RegisterController::class, 'show'])->name('register.show');
        Route::post('/register-perform', [RegisterController::class, 'register'])->name('register.perform');

        //Accueil
        Route::get('/dasboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dasboard', [DashboardController::class, 'cal'])->name('dashboard');

        Route::get('/compte-client', [CompteBankController::class, 'createclient'])->name('compte_client');
        Route::post('/compte', [CompteBankController::class, 'storeclient'])->name('compte.client');
        Route::get('/compte', [CompteBankController::class, 'createentreprise'])->name('compte_entreprise');
        Route::post('/compte-entreprise', [CompteBankController::class, 'storeentreprise'])->name('creation.entreprise');
        Route::get('/list-compte', [CompteBankController::class, 'index'])->name('compte.list');
        Route::get('/compte-entreprise', [CompteBankController::class, 'entreprise'])->name('compte.entreprise');
        Route::resource('Client', ClientController::class);
        Route::get('/entreprise', [EntrepriseController::class, 'create'])->name('entreprise');
        Route::post('/entreprise', [EntrepriseController::class, 'store'])->name('entreprise');
        Route::get('/carte', [CarteController::class, 'create'])->name('carte.create');
        Route::post('/carte', [CarteController::class, 'store'])->name('carte');

        // controller Modals client
        Route::get('/client/{id}/edit', [ModalClientController::class, 'edit'])->name('edite');
        Route::post('/client/modif', [ModalClientController::class, 'modif'])->name('modif');
        Route::delete('/client/{id}/delete', [ModalClientController::class, 'destroy'])->name('delete');
        Route::get('/client/{id}/toshow', [ModalClientController::class, 'toshow'])->name('toshow');
        Route::get('/client/{id}/show', [ModalClientController::class, 'show'])->name('show');

        // controller Modals compte
        Route::get('/compte/edite/{id}', [ModalCompteController::class, 'editer'])->name('editer');
        Route::post('/modifier/changer', [ModalCompteController::class, 'edition'])->name('charger');
        Route::post('/modifier/changer/{id}', [ModalCompteController::class, 'update'])->name('update');
        Route::delete('/delcompte/delet/{id}', [ModalCompteController::class, 'destroy'])->name('supprimer');
        Route::get('/detcompte/toshow/{id}', [ModalCompteController::class, 'toshow']);
        Route::get('/detcompte/show/{id}', [ModalCompteController::class, 'show']);

        // controller Modals entreprise
        Route::get('/entreprise/liste', [ModalEntreprisController::class, 'index'])->name('entreprise.list');
        Route::get('/entreprise/toedit/{id}', [ModalEntreprisController::class, 'toedit'])->name('entreprise.toedit');
        Route::post('/entreprise/edit', [ModalEntreprisController::class, 'edit'])->name('entreprise.edit');
        Route::delete('/entreprise/delet/{id}', [ModalEntreprisController::class, 'destroy'])->name('entreprise.delet');
        Route::get('/entreprise/toshow/{id}', [ModalEntreprisController::class, 'toshow'])->name('entreprise.toshow');
        Route::get('/entreprise/show/{id}', [ModalEntreprisController::class, 'show'])->name('entreprise.show');

        // controller pour employer
        Route::get('/employer/liste', [ModalEmployerController::class, 'index'])->name('employer');
        Route::get('/employer/toedite/{id}', [ModalEmployerController::class, 'toedite'])->name('employer.toedite');
        Route::post('/employer/edite', [ModalEmployerController::class, 'edite'])->name('employer.edite');
        Route::delete('/employer/delete/{id}', [ModalEmployerController::class, 'destroy'])->name('employer.destroy');
        Route::get('/employer/toshow/{id}', [ModalEmployerController::class, 'toshow']);
        Route::get('/employer/show/{id}', [ModalEmployerController::class, 'show']);

        // controller pour versements
        Route::get('/versements/list', [VersementController::class, 'index'])->name('versements');
        Route::post('/versement/edit', [VersementController::class, 'edit'])->name('versement.edit');
        Route::get('/versement/toedite/{id}', [VersementController::class, 'toedite'])->name('versement.toedite');
        Route::delete('/payment/delete/{id}', [VersementController::class, 'destroy'])->name('payment.destroy');
        Route::post('/versement/client', [VersementController::class, 'showclient'])->name('versement.client');

        //  controller pour transfert
        Route::get('/transfert/list', [TransfertController::class, 'index'])->name('transfert');
        Route::post('/transfert/edit', [TransfertController::class, 'edit'])->name('transfert.edit');
        Route::get('/transfert/toedite/{id}', [TransfertController::class, 'toedite'])->name('transfert.toedite');
        Route::delete('/transfert/delete/{id}', [TransfertController::class, 'destroy'])->name('transfert.destroy');
        Route::post('/transfert/client', [TransfertController::class, 'showtotransfert'])->name('transfert.client');

        // controller du retrait
        Route::get('/retrait/list', [RetraitController::class, 'index'])->name('retrait');
        Route::post('/retrait/edit', [RetraitController::class, 'edit'])->name('retrait.edit');
        Route::delete('/retrait/delete/{id}', [RetraitController::class, 'destroy'])->name('retrait.destroy');
        Route::post('retrai/client', [RetraitController::class, 'showtoredraw'])->name('retrait.client');

        //manager carte modal
        Route::get('/carte-liste', [ModalCarteController::class, 'index'])->name('carte.list');
        Route::get('/carte-toedit/{id}', [ModalCarteController::class, 'toedit'])->name('carte.toedit');
        Route::post('/carte-edit', [ModalCarteController::class, 'edit'])->name('carte.edit');
        Route::delete('/carte-delete/{id}', [ModalCarteController::class, 'destroy'])->name('carte.delete');
        Route::get('/carte-toshow/{id}', [ModalCarteController::class, 'toshow']);
        Route::get('/carte-show/{id}', [ModalCarteController::class, 'show']);

        //  manager beneficiaire
        Route::get('/list-beneficiaire', [BeneficiaireController::class, 'index'])->name('beneficiaire.entreprise');
        Route::get('/client-beneficiaire', [BeneficiaireController::class, 'list'])->name('beneficiaire.client');
        Route::get('/create-beneficiaire', [BeneficiaireController::class, 'create'])->name('beneficiaire.create');
        Route::post('/beneficiaire-store', [BeneficiaireController::class, 'store'])->name('beneficiaire.store');
        Route::get('/create-clientben', [BeneficiaireController::class, 'tocreate'])->name('clientben.tocreate');
        Route::post('store-clientbene', [BeneficiaireController::class, 'storebeneclient'])->name('clientben.storebeneclient');
        // Route::post('/beneficiaire', [BeneficiaireController::class, 'storebenentre'])->name('beneficiaire.storeentre');

        //manager beneficiaire modal
        Route::get('/beneficiaire/edit/{id}', [ModalBeneficiaireController::class, 'edit'])->name('beneficiaire.edit');
        Route::post('/beneficiaire/edition', [ModalBeneficiaireController::class, 'editer'])->name('beneficiaire.edition');
        Route::post('/beneficiaire/edition/{id}', [ModalBeneficiaireController::class, 'update'])->name('beneficiaire.update');
        Route::delete('/beneficiaire/delet/{id}', [ModalBeneficiaireController::class, 'destroy'])->name('beneficiaire.delete');
        Route::get('/beneficiaire/toshow/{id}', [ModalBeneficiaireController::class, 'toshow'])->name('beneficiaire.toshow');
        Route::get('/beneficiaire/show/{id}', [ModalBeneficiaireController::class, 'show'])->name('beneficiaire.show');

        // Auth::routes();

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::get('/logout-perform', [LogoutController::class, 'perform'])->name('logout.perform');
    });
});
