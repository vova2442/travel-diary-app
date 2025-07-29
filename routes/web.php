<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TravelController;
use Illuminate\Support\Facades\Route;
use App\Models\Travel; // Добавляем импорт модели Travel

Route::get('/', function () {
    return view('welcome');
});

// Новый маршрут для страницы сообщества
Route::get('/community', function () {
    // Получаем все путешествия от всех пользователей
    // with('user') - сразу подгружает информацию о связанном пользователе, чтобы избежать лишних запросов к БД (решение проблемы N+1)
    // latest() - это короткая запись для orderBy('created_at', 'desc')
    $travels = Travel::with('user')->latest()->get();

    // Возвращаем новый view и передаем в него данные
    return view('community', [
        'travels' => $travels,
    ]);
})->name('community'); // Даем маршруту имя 'community', чтобы на него было удобно ссылаться


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('travels', TravelController::class);
});

require __DIR__.'/auth.php';