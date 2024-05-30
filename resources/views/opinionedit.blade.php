<x-app-layout>
    <div class="py-12 bg-gradient-to-bl from-white via-blue-200 to-white h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-500 bg-opacity-20 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('opinion.update', $opinion) }}" >
                        @csrf
                        @method('put')


                        <select name="calificacion" id="lang" class="cursor-pointer bg-transparent">
                            <option value="Excelente">Excelente</option>
                            <option value="Bueno">Bueno</option>
                            <option value="Aceptable">Aceptable</option>
                            <option value="Malo">Malo</option>
                            <option value="muy_malo">Muy malo</option>
                        </select>
                        
                        <x-input-error :messages="$errors->get('calificacion')" class="mt-2" />

                        <textarea
                            name="opinion_libro"
                            class="bg-transparent block mt-4 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-800 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >{{ old('opinion_libro', $opinion->opinion_libro) }}</textarea>
                        <x-input-error :messages="$errors->get('opinion_libro')" class="mt-2" />
                            
                            <x-primary-button class="m-3 bg-gradient-to-r from-blue-900 via-blue-700 to-blue-900">Actualizar</x-primary-button>
                            <a href="{{ route('libro.descripcion', $opinion->libro_id) }}" class="dark:text-gray-100 ">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
