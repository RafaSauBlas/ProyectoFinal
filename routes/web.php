<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;



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
Route::middleware('guest')->group(function (){
  Route::get('login', function (Request $request) {
    if($request->ip() == '127.0.0.1'){
        return view('login-view');
    }
    else{
        return "NECESITA ENTRAR POR VPN PUTO";
            
    }
    })->name('login');
});

Route::get('/register', function () {
    return view('register-view');
});

Route::get('home', [AuthController::class, 'index2'])->middleware('auth');

Route::get('code/{email}', function ($email) {
     return view('code-view')->with('email', $email);
    // return "entro aqui";
})->name('code');

Route::fallback(function () {
    return redirect('/login');
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::post('/register', [AuthController::class, 'register']);
Route::post('code/login-with-code', [AuthController::class, 'loginWithCode']);

Route::GET('/editarUser/{id}', [AuthController::class, 'vistaEditar']);

Route::PUT('/Editar', [AuthController::class, 'update']);

Route::DELETE('/Eliminar', [AuthController::class, 'eliminar']);


// Route::get('/register', function () {
//     return view('login')->with('user', Auth::user());
// })->middleware('auth');
