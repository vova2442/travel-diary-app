<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $travels = $user->travels()->orderBy('created_at', 'desc')->get();

        return view('travels.index', [
            'travels' => $travels,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Просто возвращает view с формой создания
        return view('travels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. Валидация данных. Laravel проверит, что поля заполнены и соответствуют правилам.
        // Если нет, пользователя вернет на форму с сообщениями об ошибках.
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // может быть пустым, должно быть картинкой, макс. 2МБ
            'cost' => 'nullable|integer|min:0',
            'places_to_visit' => 'nullable|string',
        ]);

        // 2. Добавляем ID текущего пользователя в массив данных.
        $validated['user_id'] = Auth::id();

        // 3. Обработка загрузки файла, если он есть
        if ($request->hasFile('image')) {
            // Сохраняем файл в папке public/images/travels.
            // store() вернет путь к файлу, например: 'images/travels/filename.jpg'
            $path = $request->file('image')->store('images/travels', 'public');
            // Записываем этот путь в массив для сохранения в БД
            $validated['image'] = $path;
        }

        // 4. Создаем новую запись в базе данных с помощью модели Travel
        Travel::create($validated);

        // 5. Перенаправляем пользователя обратно на страницу со списком его путешествий
        // with('status', ...) добавляет флеш-сообщение в сессию, которое мы можем показать на странице.
        return redirect()->route('travels.index')->with('status', 'Путешествие успешно добавлено!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function show(Travel $travel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function edit(Travel $travel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Travel $travel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Travel $travel)
    {
        //
    }
}