<x-app-layout >
    <div class="py-12 bg-gradient-to-bl from-white via-blue-200 to-white {{-- bg-gray-700 --}}" > {{-- fondo --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-500 bg-opacity-25 p-3 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" >
                <div class="p-6 text-gray-900  dark:text-gray-100">

                    @if(session()->has('message'))
                    <div class="text-center bg-gray-100 rounded-md p-2 mb-5">
                        <span class="text-indigo-600 text-xl font-semibold">{{ session('message') }}</span>
                    </div>
                    @endif

                    <div class="block p-5">
                        <button id="openModalBtn" class="bg-gradient-to-r from-blue-900 via-blue-700 to-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">                   
                            <svg class="w-8 h-8 inline-block align-middle" data-slot="icon" fill="none" stroke-width="1.3" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                            </svg>
                            Agregar Libros
                        </button>
                    </div>
                    <!-- Modal -->
                    <div id="modal" class="modal z-50 hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center" style="overflow-y: auto;" 
                    @scroll.stop="">
                        <!-- Contenedor del formulario -->
                        <div class="p-8 bg-white rounded shadow-lg w-100 h-5/6 overflow-y-auto">
                            <!-- Título del formulario -->
                            <h2 class="text-lg font-semibold mb-1">Añadir libro</h2>
                            <!-- Formulario -->
                            <form method="POST" action="{{ route('libro.createBook') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre
                                        libro</label>
                                    <input type="text" id="nombre_libro" name="nombre_libro"
                                        class="mt-1 p-1 block w-full rounded border border-gray-300 focus:outline-none focus:border-blue-500" value="{{ old('nombre_libro') }}">
                                        @error('nombre_libro')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700">Nombre
                                        autor</label>
                                    <input type="text" id="nombre_autor" name="nombre_autor"
                                        class="mt-1 p-1 block w-full rounded border border-gray-300 focus:outline-none focus:border-blue-500" value="{{ old('nombre_autor') }}">
                                        @error('nombre_autor')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                <div class="mb-3">
                                    <label 
                                        class="block text-sm font-medium text-gray-700">Editorial</label>
                                    <input type="text" id="editorial" name="editorial"
                                        class="mt-1 p-1 block w-full rounded border border-gray-300 focus:outline-none focus:border-blue-500" value="{{ old('editorial') }}">
                                        @error('editorial')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700">Genero
                                        literrario</label>
                                    <input type="text" id="genero_literario" name="genero_literario"
                                        class="mt-1 p-1 block w-full rounded border border-gray-300 focus:outline-none focus:border-blue-500" value="{{ old('genero_literario') }}">
                                        @error('genero_literario')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700">Año de
                                        publicacion</label>
                                    <input type="number" id="ano_publicacion" name="ano_publicacion"
                                        class="mt-1 p-1 block w-full rounded border border-gray-300 focus:outline-none focus:border-blue-500" value="{{ old('ano_publicacion') }}">
                                        @error('ano_publicacion')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                <div class="mb-3">
                                    <label
                                        class="block text-sm font-medium text-gray-700">Descripcion del libro</label>
                                        <textarea name="desc_libro" id="desc_libro" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Añade una breve descripción del libro."
                                            >{{ old('desc_libro') }}</textarea>
                                            @error('desc_libro')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                    </div>

                                <div class="row mb-3">
                                    <label
                                        class="block text-sm font-medium text-gray-700">Sube la portada del libro</label>
                                    <input type="file" name="portada" id="portada">
                                    @error('portada')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="text-right">
                                    <!-- Botón para cerrar el modal -->
                                    <button id="closeModalBtn" type="button"
                                        class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded mr-2">Cancelar</button>
                                    <!-- Botón para enviar el formulario -->
                                    <button type="submit"
                                        class="bg-gradient-to-r from-blue-900 via-blue-700 to-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mb-4">

                    <div class="px-3 mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 ">
                    @foreach ($libros as $libro)
                            <div class="grid2-item max-w-sm bg-slate-400 bg-opacity-50 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex">
                                <div class="w-full p-5 flex flex-col justify-between">
                                    <h5 class="text-blue-900 text-2xl font-bold tracking-tight  dark:text-white">{{$libro->nombre_libro}}</h5>
                                    <p class="mb-3 font-normal text-black dark:text-gray-400"> {{$libro->nombre_autor}} </p>
                                    <p class="mb-3 font-normal text-black dark:text-gray-400"> {{$libro->editorial}} </p>
                                    <p class="mb-3 font-normal text-black dark:text-gray-400"> {{$libro->genero}} </p>
                                    <p class="mb-3 font-normal text-black dark:text-gray-400"> {{$libro->ano_publicacion}} </p>
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-800" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown-link :href="route('libro.edit', $libro)">
                                                Editar
                                            </x-dropdown-link>
                                            <form method="POST" action="{{ route('libro.delete', $libro->id) }}">
                                                @csrf
                                                @method('delete')
                                                <x-dropdown-link href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                                    Eliminar
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                    <a href=" {{ route('libro.descripcion', $libro) }} " class="w-9/12 inline-flex items-center justify-center py-2 px-3 text-sm font-medium text-white bg-gradient-to-r from-blue-900 via-blue-700 to-blue-900 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        descripción literaria
                                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                    @endforeach
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('resources/js/logic.js') }}"></script>