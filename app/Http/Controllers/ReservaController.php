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
    public function obterAparelhosDisponiveis(Request $request)
{
    // Receber os parâmetros de horário de empréstimo e devolução via AJAX
    $horarioEmprestimo = $request->input('horario_emprestimo');
    $horarioDevolucao = $request->input('horario_devolucao_emprestimo');
    
    // Consultar os agendamentos existentes no banco de dados
    $reservas = Reserva::where(function($query) use ($horarioEmprestimo, $horarioDevolucao) {
        $query->where('horario_emprestimo', '=', $horarioEmprestimo)
              ->orWhere('horario_devolucao_emprestimo', '=', $horarioDevolucao);
    })
    ->get();
    
    // Pegar os IDs dos aparelhos que estão reservados
    $aparelhosReservados = $reservas->flatMap(function($reserva) {
        return $reserva->aparelhos->pluck('id');
    })->unique();

    // Pegar todos os aparelhos disponíveis
    $aparelhosDisponiveis = Aparelho::whereNotIn('id', $aparelhosReservados)->get();

    return response()->json($aparelhosDisponiveis);
}

    public function store(Request $request)
    {
        
        $request->validate([
            'horario_emprestimo' => 'required|date_format:H:i',
            'horario_devolucao_emprestimo' => 'required|date_format:H:i|after:horario_emprestimo',
            'aparelho_checkbox' => 'required|array',
            'data_emprestimo' => 'required|date',
        ]);
        
        $user = Auth::user();

        $data = [
            'horario_emprestimo' => $request->input('horario_emprestimo'),
            'horario_devolucao_emprestimo' => $request->input('horario_devolucao_emprestimo'),
            'data_emprestimo' => $request->input('data_emprestimo'),
            'devolucao_prevista' => $request->input('data_emprestimo'),
            'user_id' => $user->id, 
        ];

        $novaReserva = Reserva::create($data);

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
