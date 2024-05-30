<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\libro;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LibroController extends Controller
{
   
    

    public function getBooks(): View
    {
        $libros = libro::get();    
        return view('dashboard', ['libros' => $libros]);
    }

    public function createBook(Request $request)
    {

        $validatedData = $request->validate([
            'nombre_libro' => 'required|string|max:255',
            'nombre_autor' => 'required|string|max:255',
            'editorial' => 'required|string|max:255',
            'genero_literario' => 'required|string|max:255',
            'ano_publicacion' => 'required|integer|min:1000|max:'.(date('Y') + 1),  // Por ejemplo, entre el año 1000 y el siguiente año
            'desc_libro' => 'required|string|min:20|max:800',
            'portada' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
       /*  dd($request); */
        //validacion de campos
    
        //almacena en la base de datos, en este caso vamos a usar el modelo
        //se le envian todos los datos validados, y adicional el user_id se obtiene de otra manera
        $libro = new libro();
        $libro->nombre_libro = $validatedData['nombre_libro'];
        $libro->nombre_autor = $validatedData['nombre_autor'];
        $libro->editorial = $validatedData['editorial'];
        $libro->genero_literario = $validatedData['genero_literario'];
        $libro->ano_publicacion = $validatedData['ano_publicacion'];
        $libro->desc_libro = $validatedData['desc_libro'];
        $libro->id_usuario = $request->user()->id;

        if($request->hasFile("portada")){
            $imagen = $request->file("portada");
            $nombreimagen = Str::slug($request->nombre_libro).".".$imagen->guessExtension();
            $ruta = public_path("img/post/");
            $imagen->move($ruta,$nombreimagen);
            $libro->portada =  $nombreimagen;
        }

        $libro->save();

        session()->flash('message', 'Has creado un libro!');
    
        return redirect()->route('dashboard');
    }

    //me envia a la vista de editar libro
    public function edit_libro(libro $libro): view
    {

        return view('libroedit')->with('libro', $libro);
    }

    public function actualizar(Request $request, libro $libro): RedirectResponse
    {
        $validatedData = $request->validate([
            'nombre_libro' => 'required|string|max:255',
            'nombre_autor' => 'required|string|max:255',
            'editorial' => 'required|string|max:255',
            'genero_literario' => 'required|string|max:255',
            'ano_publicacion' => 'required|integer|min:1000|max:'.(date('Y') + 1),  // Por ejemplo, entre el año 1000 y el siguiente año
            'desc_libro' => 'required|string|min:20|max:800',
            'portada' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $libro->nombre_libro = $validatedData['nombre_libro'];
        $libro->nombre_autor = $validatedData['nombre_autor'];
        $libro->editorial = $validatedData['editorial'];
        $libro->genero_literario = $validatedData['genero_literario'];
        $libro->ano_publicacion = $validatedData['ano_publicacion'];
        $libro->desc_libro = $validatedData['desc_libro'];

        $libro->save();

        session()->flash('message', 'Has editado un libro!');

        return redirect(route('dashboard'));
    }

    public function delete(libro $libro): RedirectResponse
    {
        $libro->delete();

        session()->flash('message', 'Has eliminado un libro!');

        return redirect()->route('dashboard',['libro' => $libro]);
    }
}
