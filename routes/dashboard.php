<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoriesController;

Route::prefix('dashboard/categories/')
->middleware(['auth']) 
->middleware(['verified'])
->group( function () {

Route::get('', [CategoriesController::class, 'index'])
->name('categories.index');


Route::get('table', [CategoriesController::class, 'table'])
->name('categories.table');

Route::get('create', [CategoriesController::class, 'create'])
->name('categories.create')
->middleware(['password.confirm']);

Route::get('/{category}', [CategoriesController::class, 'show'])
->name('categories.show');
Route::post('', [CategoriesController::class, 'store'])
->name('categories.store');
Route::get('edit/{category}', [CategoriesController::class, 'edit'])
->name('categories.edit');
Route::put('{category}', [CategoriesController::class, 'update'])
->name('categories.update');
Route::delete('{category}', [CategoriesController::class, 'destroy'])
->name('categories.destroy');
});