<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use Illuminate\Support\Facades\Route;

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

// index
Route::get('/', function () {
    return view('backend/admin/layouts/index');
});

// country
Route::any('/country/view', [CountryController::class, 'view'])->name('admin.country.view');
Route::any('/country/save', [CountryController::class, 'save'])->name('admin.country_save');
Route::any('/country/list', [CountryController::class, 'list'])->name('admin.list_country_data');
Route::any('/country/edit', [CountryController::class, 'edit'])->name('admin.edit_country_data');
Route::any('/country/delete', [CountryController::class, 'delete'])->name('admin.delete_country_data');

// state
Route::any('/state/view', [StateController::class, 'view'])->name('admin.state.view');
Route::any('/state/save', [stateController::class, 'save'])->name('admin.state_save');
Route::any('/state/list', [stateController::class, 'list'])->name('admin.list_state_data');
Route::any('/state/edit', [stateController::class, 'edit'])->name('admin.edit_state_data');
Route::any('/state/delete', [stateController::class, 'delete'])->name('admin.delete_state_data');
Route::any('/state/country_data', [StateController::class, 'country_data'])->name('admin.country_data');

// // city
Route::any('/city/view', [CityController::class, 'view'])->name('admin.city.view');
Route::any('/city/save', [CityController::class, 'save'])->name('admin.city_save');
Route::any('/city/list', [cityController::class, 'list'])->name('admin.list_city_data');
Route::any('/city/edit', [cityController::class, 'edit'])->name('admin.edit_city_data');
Route::any('/city/delete', [cityController::class, 'delete'])->name('admin.delete_city_data');
Route::any('/city/state_data', [CityController::class, 'state_data'])->name('admin.state_data');



// // area
Route::any('/area/view', [AreaController::class, 'view'])->name('admin.area.view');
Route::any('/area/save', [AreaController::class, 'save'])->name('admin.area_save');
Route::any('/area/list', [areaController::class, 'list'])->name('admin.list_area_data');
Route::any('/area/edit', [AreaController::class, 'edit'])->name('admin.edit_area_data');
Route::any('/area/delete', [AreaController::class, 'delete'])->name('admin.delete_area_data');
Route::any('/city/city_data', [AreaController::class, 'city_data'])->name('admin.city_data');





// state





// city




// area