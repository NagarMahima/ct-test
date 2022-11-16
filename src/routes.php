<?php 
use Illuminate\Support\Facades\Route;
use myown\blog\BlogController;

// Route::get('/reportLeave',[App\Http\Controllers\LeaveController::class, 'detail']);

// Route::get('add_package',[BlogController::class,'blog']);
// Route::post('add_package',[BlogController::class,'add_package']);
/*Route::get('shows',[BlogController::class,'shows']);
Route::post('shows',[BlogController::class,'shows']);
*/

Route::resource('/blogs',BlogController::class);

Route::post('/update/{id}',[BlogController::class,'update']);
Route::get('/publish/{id}',[BlogController::class,'publish']);

Route::post('/delete',[BlogController::class,'delete']);

Route::get('/category',[BlogController::class,'category']);
Route::post('/add_category',[BlogController::class,'add_category']);
Route::post('/add_sub_cat',[BlogController::class,'add_sub_cat']);

Route::post('/draft',[BlogController::class,'draft']);

Route::get('/blog_list',[BlogController::class,'blog_list']);
Route::get('/blog',[BlogController::class,'display']);
Route::post('/blog',[BlogController::class,'display']);
Route::post('/blog_category',[BlogController::class,'filter']);
Route::get('/blog_category/{cat}',[BlogController::class,'cat_filter']);

Route::get('/blog/{slug}',[BlogController::class,'detail']);
