<?php

namespace App\Http\Controllers;

use App\Models\libro;
use Illuminate\Http\Request;
use App\Models\opinion;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class OpinionController extends Controller
{

    private $rules = [
        'calificacion' => 'required|string',
        'opinion_libro' => 'required|string|max:800|min:20',
    ];

    private $errorMessage = [
        'calificacion' => 'El campo descripcion es obligatorio.',
        'opinion_libro.required' => 'El campo descripcion es obligatorio.',
        'string' => 'Este campo debe ser tipo string.',
        'opinion_libro.max' => 'El campo descripcion no debe ser mayor a 800 caracteres.'
    ];

    public function libro_descr(Request $request, Libro $libro ): View //me trae la vista de base de datos del libro 
    {

        $libro->load('relacion_lc');

        return view('libro', ['libro' => $libro]);
    }


    public function store(Request $request, Libro $libro) //me trae la vista de base de datos del libro 
    {

        $validate = $request->validate($this->rules, $this->errorMessage);
            
        $libroId = $request->input('libro_id');
        $libroId = json_decode($libroId,true);
            
        opinion::create([
            'user_id' => auth()->user()->id,
            'libro_id' => $libroId["id"],
            'calificacion' => $validate['calificacion'],
            'opinion_libro' => $validate['opinion_libro']
        ]);

        session()->flash('message', 'Has publicado tu opinion!');

        return redirect(route('libro.descripcion', ['libro' => $libro]));
    }

    public function edit(Opinion $opinion): view
    {
        $this->authorize('update', $opinion);
        return view('opinionedit', ['opinion' => $opinion, 'libro_id ' => $opinion->libro_id ]);
    }

    public function update(Request $request, Opinion $opinion): RedirectResponse
    {

        $this->authorize('update', $opinion);
        // Obtener los datos de la solicitud
        $validate = $request->validate($this->rules, $this->errorMessage);

        // Actualizar los campos de la opinión
        $opinion->update([
            'calificacion' => $validate['calificacion'],
            'opinion_libro' => $validate['opinion_libro']
        ]);

        // Flash message y redirección
        session()->flash('message', 'Opinión actualizada correctamente!');
        return redirect(route('libro.descripcion', ['libro' => $opinion->libro_id]));
    }

    public function delete(Opinion $opinion)
    {
        $this->authorize('delete', $opinion);
        
        $opinion->delete();

        session()->flash('message', 'Has eliminado tu opinion!');

        return redirect(route('libro.descripcion', ['libro' => $opinion->libro_id]));
    }

    public function synchronizeLikes(Request $request, Opinion $opinion)
{
    $user = $request->user();
    $user->opinionesLiked()->toggle([$opinion->id]);

    // Actualiza el contador de likes
    $opinion->update(['likes' => $opinion->users()->count()]);

    return redirect()->route('libro.descripcion', ['libro' => $opinion->libro_id]);
}

    

}
