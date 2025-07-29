<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Мои путешествия') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Сообщение об успешном добавлении (флеш-сообщение) --}}
                    @if (session('status'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('travels.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Добавить путешествие
                    </a>

                    {{-- Обновленный контейнер для карточек --}}
                    <div class="mt-6 space-y-6">
                        @forelse ($travels as $travel)
                            <div class="p-6 bg-gray-50 rounded-lg shadow">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-xl font-semibold text-gray-800">{{ $travel->title }}</h3>
                                        <div class="text-sm text-gray-500">
                                            Добавлено: {{ $travel->created_at->format('d.m.Y H:i') }}
                                        </div>
                                    </div>
                                    {{-- Здесь можно будет добавить кнопки редактирования/удаления в будущем --}}
                                </div>

                                @if ($travel->image)
                                    <div class="mt-4">
                                        <img src="{{ asset('storage/' . $travel->image) }}" alt="{{ $travel->title }}" class="max-w-md w-full h-auto rounded-lg">
                                    </div>
                                @endif

                                <p class="mt-4 text-gray-700">{{ $travel->description }}</p>

                                <div class="mt-4 text-sm text-gray-600 space-y-2">
                                    @if ($travel->cost > 0)
                                        <p><strong>Стоимость:</strong> {{ number_format($travel->cost, 0, ',', ' ') }} руб.</p>
                                    @endif
                                    @if ($travel->places_to_visit)
                                        <p><strong>Места для посещения:</strong> {{ $travel->places_to_visit }}</p>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p>Вы еще не добавили ни одного путешествия. Начните прямо сейчас!</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>