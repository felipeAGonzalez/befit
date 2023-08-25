<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ResetOtherController as Reset;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SubsidiaryController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', [LoginController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/reset/password', [Reset::class, 'showResetForm'])->name('password.reset');
Route::post('/reset/password', [Reset::class, 'reset']);

Route::group(['middleware' => 'web'], function () {
    Route::get('/', function () {
        if (Auth::check()) {
            return redirect()->route('welcome');
        } else {
            return view('auth.login');
        }
    });
});
Route::group(['middleware'=>['auth']],function () {

                Route::get('/welcome', function () {
                            return view('welcome');
                        })->name('welcome');

    //rutas usuario
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');


    // Rutas para listar y crear productos
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
    Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');

    Route::resource('services', ServiceController::class)->except(['show']);

    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/new', [SaleController::class, 'create'])->name('sales.create');
    Route::post('/sales', [SaleController::class,'store'])->name('sales.store');
    Route::get('/element/search', [SaleController::class,'search'])->name('element.search');
    Route::get('/sale/{id}', [SaleController::class, 'ticket'])->name('sales.ticket');

    Route::resource('categories', CategoryController::class);

    Route::get('/subsidiaries', [SubsidiaryController::class, 'index'])->name('subsidiaries.index');
    Route::get('/subsidiaries/create', [SubsidiaryController::class, 'create'])->name('subsidiaries.create');
    Route::post('/subsidiaries', [SubsidiaryController::class, 'store'])->name('subsidiaries.store');
    Route::get('/subsidiaries/{subsidiary}/edit', [SubsidiaryController::class, 'edit'])->name('subsidiaries.edit');
    Route::put('/subsidiaries/{subsidiary}', [SubsidiaryController::class, 'update'])->name('subsidiaries.update');
    Route::delete('/subsidiaries/{subsidiary}', [BranchController::class, 'destroy'])->name('subsidiaries.destroy');


});

