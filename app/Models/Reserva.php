<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_emprestimo',
        'horario_emprestimo',
        'devolucao_prevista',
        'horario_devolucao_emprestimo',
        'devolucao',
        'user_id'
    ];

    public function aparelhos(): BelongsToMany
    {
        return $this->belongsToMany(Aparelho::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
