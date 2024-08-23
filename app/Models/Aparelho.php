<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Aparelho extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria',
        'marca',
        'modelo',
        'desc',
        'obs',
        'image',
        'status'
    ];

    public function reservas(): BelongsToMany
    {
        return $this->belongsToMany(Aparelho::class);
    }
}
