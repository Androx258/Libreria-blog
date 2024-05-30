<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class libro extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_libro','nombre_autor','editorial', 'genero_literario', 'ano_publicacion', 'portada','desc_libro'];

    public function relacion_lc()
    {
        return $this->hasMany(Opinion::class);
    }




    public function user()
    {
        return $this->belongsTo(User::class);
    }


}



