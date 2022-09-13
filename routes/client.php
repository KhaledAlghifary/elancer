<?php

use App\Http\Controllers\Client\ProjectController as ClientProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ProjectController;

// Route::prefix('projects/')
// ->middleware(['auth']) 
// ->middleware(['verified'])
// ->group( function () {

// Route::get('', [ProjectController::class, 'index'])
// ->name('projects.index');

// Route::get('create', [ProjectController::class, 'create'])
// ->name('projects.create')
// ->middleware(['password.confirm']);

// Route::get('/{id}', [ProjectController::class, 'show'])
// ->name('projects.show');
// Route::post('store', [ProjectController::class, 'store'])
// ->name('projects.store');
// Route::get('edit/{id}', [ProjectController::class, 'edit'])
// ->name('projects.edit');
// Route::put('{id}', [ProjectController::class, 'update'])
// ->name('projects.update');
// Route::delete('{od}', [ProjectController::class, 'destroy'])
// ->name('projects.destroy');
// });



Route::group([
   'prefix'=>'client',
   'as'=>'client.',
   'middleware'=>'auth'
   
],function(){

   Route::resource('projects',ProjectController::class);

});


//  ->names([
//    'index'=> 'client.projects.index',
//    'create'=> 'client.projects.create',
//    'edit'=> 'client.projects.edit',
   
// ])
