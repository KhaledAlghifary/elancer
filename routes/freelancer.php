<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Freelancer\ProfileController;

Route::group([
    'prefix'=> 'freelancer',
    'as'=>'freelancer.',
    'middleware'=>['auth','verified']
],
function(){

    Route::get('profile',[ProfileController::class,'edit'])->name('profile.edit');


    Route::put('profile',[ProfileController::class,'update'])->name('profile.update');


});