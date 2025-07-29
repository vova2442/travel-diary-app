<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Путешествия сообщества') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <p class="mb-6">Здесь вы можете увидеть последние путешествия, добавленные другими пользователями.</p>

                    {{-- Контейнер для карточек путешествий --}}
                    <div class="space-y-6">
                        @forelse ($travels as $travel)
                            <div class="p-6 bg-gray-50 rounded-lg shadow">
                                <div class="flex items-start space-x-4">
                                    {{-- Аватарка автора --}}
                                    <div class="flex-shrink-0">
                                        {{-- Мы используем сервис gravatar для аватарок, он автоматически генерирует картинку по email --}}
                                        <img class="h-10 w-10 rounded-full" src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($travel->user->email))) }}?d=mp" alt="{{ $travel->user->name }}">
                                    </div>

                                    <div class="flex-grow">
                                        <div class="flex justify-between items-center">
                                            {{-- Имя автора и название путешествия --}}
                                            <div>
                                                <span class="font-bold">{{ $travel->user->name }}</span>
                                                <h3 class="text-xl font-semibold text-gray-800">{{ $travel->title }}</h3>
                                            </div>
                                            {{-- Дата добавления --}}
                                            <div class="text-sm text-gray-500">
                                                {{ $travel->created_at->diffForHumans() }} {{-- Показывает дату в формате "2 дня назад" --}}
                                            </div>
                                        </div>

                                        {{-- Изображение путешествия --}}
                                        @if ($travel->image)
                                            <div class="mt-4">
                                                {{-- asset('storage/' . $travel->image) - генерирует правильный URL к файлу в папке public/storage --}}
                                                <img src="{{ asset('storage/' . $travel->image) }}" alt="{{ $travel->title }}" class="max-w-md w-full h-auto rounded-lg">
                                            </div>
                                        @endif

                                        <p class="mt-4 text-gray-700">{{ $travel->description }}</p>

                                        {{-- Дополнительная информация --}}
                                        <div class="mt-4 text-sm text-gray-600 space-y-2">
                                            @if ($travel->cost > 0)
                                                <p><strong>Стоимость:</strong> {{ number_format($travel->cost, 0, ',', ' ') }} руб.</p>
                                            @endif
                                            @if ($travel->places_to_visit)
                                                <p><strong>Места для посещения:</strong> {{ $travel->places_to_visit }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Пока что никто не добавил ни одного путешествия. Будьте первым!</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>