<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TravelController;
use Illuminate\Support\Facades\Route;
use App\Models\Travel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Здесь мы регистрируем маршруты для нашего веб-приложения.
|
*/

// Главная страница приложения. Теперь она показывает ленту сообщества.
Route::get('/', function () {
    $travels = Travel::with('user')->latest()->get();
    return view('community', [
        'travels' => $travels,
    ]);
})->name('home'); // Называем маршрут 'home'


// Маршрут для страницы сообщества. Он все еще работает, но главная ссылка будет вести на '/'.
Route::get('/community', function () {
    $travels = Travel::with('user')->latest()->get();
    return view('community', [
        'travels' => $travels,
    ]);
})->name('community');


// Этот маршрут теперь будет перехватывать все обращения к /dashboard
// и перенаправлять пользователя на страницу "Мои путешествия".
Route::get('/dashboard', function () {
    return redirect()->route('travels.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('travels', TravelController::class);
});

require __DIR__.'/auth.php';