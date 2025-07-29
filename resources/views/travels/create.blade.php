<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Добавить новое путешествие') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- enctype="multipart/form-data" необходимо для загрузки файлов --}}
                    <form method="POST" action="{{ route('travels.store') }}" enctype="multipart/form-data">
                        @csrf  {{-- Обязательный токен для защиты от CSRF-атак --}}

                        {{-- Поле: Название --}}
                        <div>
                            <label for="title" class="block font-medium text-sm text-gray-700">Название</label>
                            <input id="title" name="title" type="text" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required autofocus>
                        </div>

                        {{-- Поле: Описание --}}
                        <div class="mt-4">
                            <label for="description" class="block font-medium text-sm text-gray-700">Описание</label>
                            <textarea id="description" name="description" rows="5" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required></textarea>
                        </div>

                        {{-- Поле: Изображение --}}
                        <div class="mt-4">
                            <label for="image" class="block font-medium text-sm text-gray-700">Изображение</label>
                            <input id="image" name="image" type="file" class="block mt-1 w-full">
                        </div>

                        {{-- Поле: Стоимость --}}
                        <div class="mt-4">
                            <label for="cost" class="block font-medium text-sm text-gray-700">Стоимость (в рублях)</label>
                            <input id="cost" name="cost" type="number" min="0" value="0" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        {{-- Поле: Места для посещения --}}
                        <div class="mt-4">
                            <label for="places_to_visit" class="block font-medium text-sm text-gray-700">Места для посещения (через запятую)</label>
                            <input id="places_to_visit" name="places_to_visit" type="text" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Сохранить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>