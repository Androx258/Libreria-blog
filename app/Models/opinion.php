<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use SebastianBergmann\CodeCoverage\Node\Builder;

class opinion extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'libro_id', 'calificacion', 'opinion_libro', 'likes'];

    protected $casts = ['created-at' => 'datetime'];

    

    public function users()
{
    return $this->belongsToMany(User::class, 'opinion_user');
}

    public function libro(): BelongsTo
    {
        return $this->belongsTo(libro::class);
    }
    public function user(): BelongsTo   
    {
        return $this->belongsTo(User::class);
    }


}
