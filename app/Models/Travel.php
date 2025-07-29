<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Travel extends Model
{
    use HasFactory;

    /**
     * Имя таблицы, связанной с моделью.
     * Laravel по умолчанию ищет таблицу 'travels' для модели 'Travel'.
     * Но в ошибке видно, что он почему-то искал 'travel'.
     * Эта строка явно указывает правильное имя таблицы 'travels',
     * решая проблему "Table not found".
     *
     * @var string
     */
    protected $table = 'travels';

    /**
     * Атрибуты, которые можно массово присваивать.
     * Мы перечисляем здесь все поля из нашей таблицы,
     * которые пользователь будет заполнять через форму.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image',
        'cost',
        'places_to_visit',
    ];

    /**
     * Определяем обратную связь "один ко многим".
     * Каждая запись о путешествии принадлежит одному пользователю.
     * Это позволит нам легко получать информацию о владельце путешествия,
     * например: $travel->user->name
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}