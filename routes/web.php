<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('dashboard',compact('users'));

    })->name('dashboard');
});

//Route::get('/category', function () {
  //  return view('admin.category.category');
//})->name('AllCat');


//Category routes
Route::get('add',  [CategoryController::class, 'index'])->name('AllCat');
Route::post('/all/category', [CategoryController::class, 'AddCat'])->name('add.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update'])->name('update.category');
Route::get('/category/delete/{id}', [CategoryController::class, 'Delete']);
Route::get('/category/remove/{id}', [CategoryController::class,'RemoveCat']);
Route::get('/category/restore/{id}', [CategoryController::class,'RestoreCat']);
Route::get('/category/delete/{id}', [CategoryController::class,'DeleteCat']);

//Brand Controller
Route::get('/all/brand', [BrandController::class, 'AllBrand'])->name('brand');
Route::post('/brand/add',[BrandController::class, 'AddBrand'])->name('add.brand');

Route::get('/brand/edit/{id}',[BrandController::class,'Edit']);
Route::post('/brand/update/{id}', [BrandController::class,'Update']);

Route::get('/brand/remove/{id}', [BrandController::class,'RemoveBrand']);
Route::get('/brand/restore/{id}', [BrandController::class,'RestoreBrand']);
Route::get('/brand/delete/{id}', [BrandController::class,'DeleteBrand']);
