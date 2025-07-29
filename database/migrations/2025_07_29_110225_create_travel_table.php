<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Эта функция создает таблицу 'travels' в базе данных
        Schema::create('travels', function (Blueprint $table) {
            $table->id(); // Уникальный номер для каждой записи (Primary Key)

            // Связь с таблицей пользователей. Каждое путешествие принадлежит одному пользователю.
            // constrained() - проверяет, что такой user_id существует в таблице 'users'
            // onDelete('cascade') - если пользователь будет удален, все его путешествия тоже удалятся
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('title'); // Название путешествия (короткая строка)
            $table->text('description'); // Описание путешествия (длинный текст)

            // Дополнительные поля по заданию
            $table->string('image')->nullable(); // Путь к изображению. nullable() означает, что поле может быть пустым.
            $table->unsignedInteger('cost')->default(0); // Стоимость путешествия. Целое неотрицательное число, по умолчанию 0.
            $table->text('places_to_visit')->nullable(); // Места для посещения. Длинный текст, может быть пустым.

            $table->timestamps(); // Автоматически создает поля created_at и updated_at (когда создано/обновлено)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Эта функция нужна для отката миграции, она просто удаляет созданную таблицу
        Schema::dropIfExists('travels');
    }
};