<?php
use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\Products\ProductCreate;
use App\Livewire\Admin\Products\ProductEdit;
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

Route::name('store.')
    ->namespace('App\Livewire\Store')
    ->group(function() {
        Route::get('/', Home::class)->name('home');
        Route::get('/cart', Cart\CartIndex::class)->name('cart');
        Route::get('/checkout', Checkout::class)
            ->middleware('auth')
            ->name('checkout');
    });

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->namespace('App\Livewire\Admin\Products')
    ->group(function() {

    Route::get('/products', ProductList::class)->name('product.index');
    Route::get('/products/create', ProductCreate::class)->name('product.create');
    Route::get('/products/{product}/edit', ProductEdit::class)->name('product.edit');
});

//Breeze Routes...
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
