<x-app-layout>
    <div class="py-12  bg-gradient-to-bl from-white via-blue-200 to-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-500 bg-opacity-25 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session()->has('message'))
                    <div class="text-center bg-gray-100 rounded-md p-2 mb-5">
                        <span class="text-indigo-600 text-xl font-semibold">{{ session('message') }}</span>
                    </div>
                    @endif

                    <a href="{{ route('dashboard') }}" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none from-gray-400 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Regresar</a>
                
                    <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class=" max-h-full bg-slate-400 bg-opacity-50 border border-gray-200 rounded-lg shadow flex p-5 flex-col ">
                            <h5 class="text-5xl font-bold tracking-tight text-blue-900 dark:text-white">{{$libro->nombre_libro}}</h5>
                            <p class="mt-10 mb-3 font-normal text-black dark:text-gray-400"><b>Autor: </b>{{$libro->nombre_autor}}</p>
                            <p class="mt-2 mb-3 font-normal text-black dark:text-gray-400"><b>Editorial: </b>{{$libro->editorial}}</p>
                            <p class="mt-2 mb-3 font-normal text-black dark:text-gray-400"><b>Genero literario: </b>{{$libro->genero_literario}}</p>
                            <p class="mt-2 mb-3 font-normal text-black dark:text-gray-400"><b>Año de publicacion: </b>{{$libro->ano_publicacion}}</p>
                            <p class="mt-7 text-left mb-3 font-normal text-black dark:text-gray-400"><b>Descripcion: </b><br>{{$libro->desc_libro}}</p>
                        </div> 
                    
                        <div class="flex flex-col">
                            @if($libro->portada)
                                <img class="h-auto w-full md:w-4/5 rounded-lg" src="../../img/post/{{$libro->portada}}" alt="">
                            @else
                                <img class="h-auto w-full md:w-4/5 rounded-lg" src="../../img/post/sin_portada.jpg" alt="">
                            @endif
                        </div>
                    </div>
                </div>
            
                <div class="p-6 text-gray-900 dark:text-gray-100s space-x-8">
                    <h2 class="text-2xl font-bold pl-8 text-blue-900">¿Leiste el libro?</h2> 
                    <p class="text-black"> Comparte tu opinion aquí:</p> <br>
                    <form method="POST" action="{{ route('opinion.store', ['libro' => $libro]) }}">
                        @csrf
                        <input type="hidden" name="libro_id" value="{{ $libro }}"> 
                        
                         <select name="calificacion" id="lang" class="cursor-pointer bg-transparent ">
                            <option value="Excelente">Excelente</option>
                            <option value="Bueno">Bueno</option>
                            <option value="Aceptable">Aceptable</option>
                            <option value="Malo">Malo</option>
                            <option value="muy_malo">Muy malo</option>
                          </select>
                          <p id="char-count" class="mt-5 text-yellow-800">0/800 caracteres</p>
                            <textarea name="opinion_libro" id="opinion_libro" cols="30" rows="10" class="block my-3 p-5 w-3/4 text-sm text-gray-900 bg-transparent rounded-lg border border-gray-800 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escribe aquí"></textarea>
                            @error('opinion_libro')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                            <input type="submit" value="Agregar" class="px-4 py-4 bg-gradient-to-r from-blue-900 via-blue-700 to-blue-900 dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-sm text-white dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">   
                    </form>
                </div>
            
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                        {{--for--}}
                        @forelse ($libro->relacion_lc as $comentario)
    <div class="mb-4 p-6 flex space-x-2 bg-slate-400 bg-opacity-50 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex-1 pl-3">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-gray-800 dark:text-gray-100">{{ $comentario->user->name }}</span>
                    <small class="ml-2 text-sm text-yellow-800 dark:text-gray-100">{{ $comentario->created_at->format('d-m-Y') }}</small>
                    @unless($comentario->created_at->eq($comentario->updated_at))
                        <small class="text-sm text-yellow-800"> &middot; editado </small>
                    @endunless
                </div>
                
                @can( 'update', $comentario )
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-800" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('opinion.edit', $comentario)">
                                Editar
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('opinion.delete', $comentario) }}">
                                @csrf
                                @method('delete')
                                <x-dropdown-link href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                    Eliminar
                                </x-dropdown-link>
                            </form>
                        </x-slot>    
                    </x-dropdown>
                    @endcan

            </div>
            <p class="mt-3 text-2xl text-blue-900 dark:text-gray-100">
               <b> {{ $comentario->calificacion }} </b>
            </p>
            <p class="mt-3 text-lg text-black dark:text-gray-100">
                {{ $comentario->opinion_libro }}
            </p>

            {{-- AQUI VA LA FUNCIONALIDAD DE LIKES --}}
            <form method="POST" action="{{ route('opinion.like', $comentario->id) }}">
                @csrf
                @method('put')
                <div class="mt-4 ">
                    
                    @cannot('update', $comentario)
                    @if(!auth()->user()->iLikeIt($comentario->id))
                    <div class="text-right">    
                    <x-primary-button class="bg-gradient-to-r from-blue-900 via-blue-700 to-blue-900">
                            <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="30" height="30">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z"></path>
                            </svg>
                            <span class="ml-5">Me gusta</span>
                        </x-primary-button>
                    </div>
                    @else
                    <div class="text-right">
                        <x-secondary-button class="bg-gradient-to-r from-gray-400 via-neutral-300 to-gray-400">
                            <svg class="text-yellow-800" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="30" height="30">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54"></path>
                            </svg>
                            <span class="ml-5 text-yellow-800">Ya no me gusta</span>
                        </x-secondary-button>
                    </div>
                    @endif
                    @endcannot

                    <div class="">
                        <span class="text-yellow-800"> @if(  $comentario->likes != 1 ) A {{ $comentario->likes }} personas les gusta esta opinión. @else A {{ $comentario->likes }} persona le gusta esta opinión. @endif </span>
                        </div>
                </div>
                
            </form>

            
            
        </div>
    </div>
@empty
    <h2 class="text-xl p-4">No hay opiniones</h2>
@endforelse

                    {{--endfor--}}
                </div>
            </div>   
        </div>
    </div>
    </div>

</x-app-layout>

<!-- Aquí comienza la sección de JavaScript -->
<script>
    // Tu código JavaScript va aquí
    document.getElementById("opinion_libro").addEventListener("input", function() {
        var charCount = this.value.length;
        document.getElementById("char-count").textContent = charCount + "/800 caracteres";
    });
</script>

