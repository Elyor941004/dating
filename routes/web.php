<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\LanguageController;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\TableTranslationController;
use \App\Http\Controllers\UserController;

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

Route::get('/', [UserController::class, 'userCreate'])->name('user_create');
Auth::routes();

Route::get('/admin', function (){
    return redirect()->route('users.index');
});
Route::group(['middleware'=>['isAdmin', 'language'], 'prefix'=>'admin'], function(){

    Route::resource('users', UserController::class);

    Route::post('change/status', [UserController::class, 'changeStatus'])->name('change_status');

    Route::get('/set-cities', [HomeController::class, 'setCities']);

    Route::group(['prefix' => 'table'], function () {
        Route::get('translation', [TableTranslationController::class, 'index'])->name('table.index');
        Route::get('show/{type}', [TableTranslationController::class, 'show'])->name('table.show');
        Route::get('table-show', [TableTranslationController::class, 'tableShow'])->name('table.tableShow');
        Route::post('/translation/save/', [TableTranslationController::class, 'translation_save'])->name('table_translation.save');
    });

    Route::group(['prefix' => 'language'], function () {
        Route::get('/', [LanguageController::class, 'index'])->name('language.index');
        Route::get('/language/show/{id}', [LanguageController::class, 'show'])->name('language.show');
        Route::post('/translation/save/', [LanguageController::class, 'translation_save'])->name('translation.save');
        Route::post('/language/change/', [LanguageController::class, 'changeLanguage'])->name('language.change');
        Route::post('/env_key_update', [LanguageController::class, 'env_key_update'])->name('env_key_update.update');
        Route::get('/language/create/', [LanguageController::class, 'create'])->name('languages.create');
        Route::post('/language/added/', [LanguageController::class, 'store'])->name('languages.store');
        Route::get('/language/edit/{id}', [LanguageController::class, 'languageEdit'])->name('language.edit');
        Route::put('/language/update/{id}', [LanguageController::class, 'update'])->name('language.update');
        Route::delete('/language/delete/{id}', [LanguageController::class, 'languageDestroy'])->name('language.destroy');
        Route::post('/language/update/value', [LanguageController::class, 'updateValue'])->name('languages.update_value');
    });
});

