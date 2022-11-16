<?php 
use Illuminate\Support\Facades\Route;
use CT\Blog\BlogController;

// Route::get('/reportLeave',[App\Http\Controllers\LeaveController::class, 'detail']);

// Route::get('add_package',[CT\Blog\BlogController::class,'blog']);
// Route::post('add_package',[CT\Blog\BlogController::class,'add_package']);
/*Route::get('shows',[CT\Blog\BlogController::class,'shows']);
Route::post('shows',[CT\Blog\BlogController::class,'shows']);
*/

Route::resource('/blogs',BlogController::class);

Route::post('/update/{id}',[CT\Blog\BlogController::class,'update']);
Route::get('/publish/{id}',[CT\Blog\BlogController::class,'publish']);

Route::post('/delete',[CT\Blog\BlogController::class,'delete']);

Route::get('/category',[CT\Blog\BlogController::class,'category']);
Route::post('/add_category',[CT\Blog\BlogController::class,'add_category']);
Route::post('/add_sub_cat',[CT\Blog\BlogController::class,'add_sub_cat']);

Route::post('/draft',[CT\Blog\BlogController::class,'draft']);

Route::get('/blog_list',[CT\Blog\BlogController::class,'blog_list']);
Route::get('/blog',[CT\Blog\BlogController::class,'display']);
Route::post('/blog',[CT\Blog\BlogController::class,'display']);
Route::post('/blog_category',[CT\Blog\BlogController::class,'filter']);
Route::get('/blog_category/{cat}',[CT\Blog\BlogController::class,'cat_filter']);

Route::get('/blog/{slug}',[CT\Blog\BlogController::class,'detail']);
