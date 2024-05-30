<x-app-layout>
    <div class="py-12 bg-gradient-to-bl from-white via-blue-200 to-white">
            <div class=" dark:bg-gray-800 overflow-hidden flex m-auto justify-center max-w-screen-2xl">
                        <!-- Contenedor del formulario -->
                        <div class="bg-slate-400 bg-opacity-30 p-5 rounded shadow-lg w-1/2 ">
                            <!-- Título del formulario -->
                            <h2 class="text-lg font-semibold mb-1 text-blue-900">Editar libro</h2>
                            <!-- Formulario -->
                            <form method="POST" action="{{ route('libro.actualizar', $libro->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label for="nombre" class="block text-sm font-medium text-black ">Nombre
                                        libro</label>
                                    <input type="text" id="nombre_libro" name="nombre_libro" value="{{ $libro->nombre_libro }}"
                                        class="bg-transparent mt-1 p-1 block w-full rounded border border-gray-800 focus:outline-none focus:border-blue-500">
                                        @error('nombre_libro')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-black">Nombre
                                        autor</label>
                                    <input type="text" id="nombre_autor" name="nombre_autor" value="{{ $libro->nombre_autor }}"
                                        class="bg-transparent mt-1 p-1 block w-full rounded border border-gray-800 focus:outline-none focus:border-blue-500">
                                        @error('nombre_autor')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                <div class="mb-3">
                                    <label 
                                        class="block text-sm font-medium text-black">Editorial</label>
                                    <input type="text" id="editorial" name="editorial" value="{{ $libro->editorial }}"
                                        class="bg-transparent mt-1 p-1 block w-full rounded border border-gray-800 focus:outline-none focus:border-blue-500">
                                        @error('editorial')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                    </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-black">Genero
                                        literrario</label>
                                    <input type="text" id="genero_literario" name="genero_literario" value="{{ $libro->genero_literario }}"
                                        class="bg-transparent mt-1 p-1 block w-full rounded border border-gray-800 focus:outline-none focus:border-blue-500">
                                        @error('genero_literario')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                    </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-black">Año de
                                        publicacion</label>
                                    <input type="number" id="ano_publicacion" name="ano_publicacion" value="{{ $libro->ano_publicacion }}"
                                        class="bg-transparent mt-1 p-1 block w-full rounded border border-gray-800 focus:outline-none focus:border-blue-500">
                                        @error('ano_publicacion')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                <div class="mb-3">
                                    <label
                                        class="block text-sm font-medium text-black">Descripcion del libro</label> 
                                        <textarea id="desc_libro" name="desc_libro" rows="4" class="bg-transparent block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-800 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."
                                            >{{ old('desc_libro', $libro->desc_libro) }}</textarea>
                                            @error('desc_libro')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                        </div>

                                <div class="row mb-3">
                                    <label
                                        class="block text-sm font-medium text-black">°Solo puedes añadir la portada en el momento que registras el libro por primera vez</label>
                                </div>
                                <div class="text-right">
                                    <!-- Botón para enviar el formulario -->
                                    <button type="submit" class="bg-gradient-to-r from-blue-900 via-blue-700 to-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Actualizar</button>
                                    <a href="{{ route('dashboard') }}" class="ml-7  dark:text-gray-100">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        
    
</x-app-layout>
