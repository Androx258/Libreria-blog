<?php

use App\Models\User;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


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

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::post('/dashboard', [LibroController::class, 'createBook'])->name('libro.createBook');
Route::get('/dashboard', [LibroController::class, 'getBooks'])->middleware(['auth', 'verified'])->name('dashboard');
Route::delete('/libro/{libro}', [LibroController::class, 'delete'])->name('libro.delete');

Route::get('/libro/{libro}', [LibroController::class, 'edit_libro'])->name('libro.edit');
Route::put('/libro/actualizar/{libro}', [LibroController::class, 'actualizar'])->name('libro.actualizar');

/* Crear opinion */
Route::post('/dashboard/libro/{libro}', [OpinionController::class, 'store'])->name('opinion.store');
/************* */ 

Route::get('/dashboard/libro/{libro}',[OpinionController::class, 'libro_descr'])->name('libro.descripcion');


Route::get('/opiniones/editar/{opinion}', [OpinionController::class, 'edit'])->name('opinion.edit');
Route::put('/opiniones/actualizar/{opinion}', [OpinionController::class, 'update'])->name('opinion.update');
Route::delete('/opiniones/actualizar/{opinion}', [OpinionController::class, 'delete'])->name('opinion.delete');

Route::put('/dashboard/opinion/{opinion}', [OpinionController::class, 'synchronizeLikes'])->name('opinion.like');

Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();
    
    $userExists = User::where('external_id', $user->id)->where('external_auth', 'google')->first();

    if($userExists)
    {
        Auth::login($userExists);
    }else
    {
        $userNew = User::create([
            'name'=> $user->name,
            'email'=> $user->email,
            'avatar'=> $user->avatar,
            'external_id'=> $user->id,
            'external_auth'=> 'google',
        ]);
        Auth::login($userNew);
    }
    // $user->token

    return redirect('/dashboard');
});