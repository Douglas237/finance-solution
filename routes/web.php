<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarteController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompteBankController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\ModalCarteController;
use App\Http\Controllers\ModalClientController;
use App\Http\Controllers\ModalCompteController;
use App\Http\Controllers\BeneficiaireController;
use App\Http\Controllers\ModalEmployerController;
use App\Http\Controllers\ModalEntreprisController;

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

Route::get('/', function () {
    // return view('layout.welcome');
    return view('layouts.dashboard');
});
//Accueil
Route::get('/dasboard',[DashboardController::class, 'index'])->name('dashboard');
Route::get('/dasboard',[DashboardController::class, 'cal'])->name('dashboard');

Route::get('/compte/{id}',[CompteBankController::class, 'create'])->name('compte');
Route::post('/compte/{id}',[CompteBankController::class, 'store'])->name('compte');
Route::get('/list-compte', [CompteBankController::class, 'index'])->name('compte.list');
Route::get('/compte-entreprise', [CompteBankController::class, 'entreprise'])->name('compte.entreprise');
Route::resource('Client', ClientController::class);
Route::get('/entreprise', [EntrepriseController::class, 'create'])->name('entreprise');
Route::post('/entreprise', [EntrepriseController::class, 'store'])->name('entreprise');
Route::get('/carte/{id}', [CarteController::class, 'create'])->name('carte');
Route::post('/carte/{id}', [CarteController::class, 'store'])->name('carte');

// controller Modals client
Route::get('/client/{id}/edit', [ModalClientController::class, 'edit'])->name('edite');
Route::post('/client/modif', [ModalClientController::class, 'modif'])->name('modif');
Route::delete('/client/{id}/delete', [ModalClientController::class, 'destroy'])->name('delete');
Route::get('/client/{id}/toshow', [ModalClientController::class, 'toshow'])->name('toshow');
Route::get('/client/{id}/show', [ModalClientController::class, 'show'])->name('show');

// controller Modals compte
Route::get('/compte/edite/{id}',[ModalCompteController::class, 'editer'])->name('editer');
Route::post('/modifier/changer',[ModalCompteController::class, 'edition'])->name('charger');
Route::post('/modifier/changer/{id}',[ModalCompteController::class, 'update'])->name('update');
Route::delete('/delcompte/delet/{id}',[ModalCompteController::class, 'destroy'])->name('supprimer');
Route::get('/detcompte/toshow/{id}',[ModalCompteController::class, 'toshow']);
Route::get('/detcompte/show/{id}',[ModalCompteController::class, 'show']);

// controller Modals enreprise
Route::get('/entreprise/liste',[ModalEntreprisController::class, 'index'])->name('entreprise.list');
Route::get('/entreprise/toedit/{id}',[ModalEntreprisController::class, 'toedit'])->name('entreprise.toedit');
Route::post('/entreprise/edit',[ModalEntreprisController::class, 'edit'])->name('entreprise.edit');
Route::delete('/entreprise/delet/{id}',[ModalEntreprisController::class, 'destroy'])->name('entreprise.delet');
Route::get('/entreprise/toshow/{id}',[ModalEntreprisController::class, 'toshow'])->name('entreprise.toshow');
Route::get('/entreprise/show/{id}',[ModalEntreprisController::class, 'show'])->name('entreprise.show');

// controller pour employer
Route::get('/employer/liste',[ModalEmployerController::class, 'index'])->name('employer');
Route::get('/employer/toedite/{id}',[ModalEmployerController::class, 'toedite'])->name('employer.toedite');
Route::post('/employer/edite',[ModalEmployerController::class, 'edite'])->name('employer.edite');
Route::delete('/employer/delete/{id}',[ModalEmployerController::class, 'destroy'])->name('employer.destroy');
Route::get('/employer/toshow/{id}', [ModalEmployerController::class, 'toshow']);
Route::get('/employer/show/{id}', [ModalEmployerController::class, 'show']);

//manager carte modal
Route::get('/carte-liste',[ModalCarteController::class, 'index'])->name('carte.list');
Route::get('/carte-toedit/{id}',[ModalCarteController::class, 'toedit'])->name('carte.toedit');
Route::post('/carte-edit', [ModalCarteController::class, 'edit'])->name('carte.edit');
Route::delete('/carte-delete/{id}', [ModalCarteController::class, 'destroy'])->name('carte.delete');
Route::get('/carte-toshow/{id}', [ModalCarteController::class, 'toshow']);
Route::get('/carte-show/{id}', [ModalCarteController::class, 'show']);

//  manager beneficiaire
Route::get('/list-beneficiaire', [BeneficiaireController::class, 'index'])->name('beneficiaire.list');
Route::get('/create-beneficiaire/{id}', [BeneficiaireController::class, 'create'])->name('beneficiaire.create');
Route::post('/beneficiaire/{id}', [BeneficiaireController::class, 'store'])->name('beneficiaire.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
