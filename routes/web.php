<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers \ {
    HomeController,
    UserController,
    DataPasienController
};
use Symfony\Component\HttpFoundation\Request;

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

Route::get('/login', function () {
    return "login";
});

Route::view('/form', 'forms/google-form');
Route::view('result', 'forms/format1/result');
Route::get('/test', [HomeController::class, 'test']);


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('dashboard');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/pasien', [DataPasienController::class, 'index'])->name('pasien');
Route::get('/pasien/{id}/delete', [DataPasienController::class, 'deletePasien']);

Route::get('/export', [DataPasienController::class, 'export'])->name('export');
Route::get('/export/download', [DataPasienController::class, 'export_query']);

Route::get('/tambah-pasien', [DataPasienController::class, 'tambah'])->name('tambah');
Route::post('/tambah-pasien/save', [DataPasienController::class, 'save']);
Route::get('/edit-pasien/{id}', [DataPasienController::class, 'editPasien'])->name('edit');
Route::post('/edit-pasien/save', [DataPasienController::class, 'saveEditPasien']);
Route::get('/detail-pasien/{id}', [DataPasienController::class, 'detail'])->name('detail');

Route::get('/detail-pasien/{perawatan:id}/delete', [DataPasienController::class, 'deletePemeriksaan']);
Route::get('/detail-pasien/{id}/tambah-pemeriksaan', [DataPasienController::class, 'tambahPemeriksaan']);
Route::post('/detail-pasien/tambah-pemeriksaan/save', [DataPasienController::class, 'savePemeriksaan']);
Route::get('/detail-pasien/edit-pemeriksaan/{id}', [DataPasienController::class, 'editPemeriksaan']);
Route::post('/detail-pasien/edit-pemeriksaan/update', [DataPasienController::class, 'updatePemeriksaan']);


Route::get('/pasien', [DataPasienController::class, 'showPasien']);

//Form
Route::post('save-form', [DataPasienController::class, 'saveForm']);
Route::get('result-form', [DataPasienController::class, 'showForm']);
// Route::view('result-form', 'forms/result-form');



Route::group(['middleware' => ['role:admin']], function () {

    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/tambah', [UserController::class, 'tambah'])->name('tambah_user');
    Route::post('/user/save', [UserController::class, 'save']);
    Route::get('/user/{user:id}/delete', [UserController::class, 'delete']);
    Route::get('/user/{id}/ubah-password', [UserController::class, 'ubahPassword']);
    Route::post('/user/{id}/update-password', [UserController::class, 'updatePassword']);
});
