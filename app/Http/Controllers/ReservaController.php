<?php

namespace App\Http\Controllers;

use App\Models\Aparelho;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function index(Aparelho $aparelhos)
    {
        $aparelhos = $aparelhos->all();

        return view('dashboard', compact('aparelhos'));
    }

    public function create()
    {

    }
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'horario_emprestimo' => 'required|date_format:H:i',
            'horario_devolucao_emprestimo' => 'required|date_format:H:i|after:horario_emprestimo',
            'aparelho_checkbox' => 'required|array',
            'data_emprestimo' => 'required|date',
        ]);
        //dd($request->validated());
        $user = Auth::user();

        $data = [
            'horario_emprestimo' => $request->input('horario_emprestimo'),
            'horario_devolucao_emprestimo' => $request->input('horario_devolucao_emprestimo'),
            'data_emprestimo' => $request->input('data_emprestimo'),
            'devolucao_prevista' => $request->input('data_emprestimo'),
            'user_id' => $user->id, 
        ];

        $novaReserva = Reserva::create($data);
        //dd($novaReserva);

        $novaReserva->aparelhos()->attach($request->input('aparelho_checkbox'));

        return redirect()->route('agendamentos');
    }



    public function show(Reserva $reserva)
    {

    }

    public function edit(Reserva $reserva)
    {

    }

    public function update(Request $request, Reserva $reserva)
    {

    }

    public function destroy(Reserva $reserva)
    {

    }
}
