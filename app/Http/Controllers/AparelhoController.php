<?php

namespace App\Http\Controllers;

use App\Models\Aparelho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AparelhoController extends Controller
{
    /**
     * Apply authentication middleware.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aparelhos = Aparelho::all();

        return view('aparelhos.index', compact('aparelhos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aparelhos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Aparelho $aparelhos)
    {
        // Validação dos dados de entrada
        $data = $request->all();
        $data['status'] = 'Disponível';

        if ($request->file('image')) {
            $file = $request->file('image');
            // Garante que a pasta public/storage esteja acessível
            $fileName = $file->hashName();
            $file->move(public_path('storage'), $fileName);
            $data['image'] = $fileName;
        }

        $aparelhos->create($data);

        return redirect()->route('aparelhos.index')->with('success', 'Aparelho criado com sucesso.');    }

    /**
     * Display the specified resource.
     */
    public function show(string|int $id)
    {
        $aparelho = Aparelho::find($id);

        if (!$aparelho) {
            return redirect()->route('aparelhos.index')->with('error', 'Aparelho não encontrado.');
        }

        return view('aparelhos.show', compact('aparelho'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string|int $id)
    {
        $aparelho = Aparelho::find($id);

        if (!$aparelho) {
            return redirect()->route('aparelhos.index')->with('error', 'Aparelho não encontrado.');
        }

        return view('aparelhos.edit', compact('aparelho'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string|int $id)
    {
        $aparelho = Aparelho::find($id);

        if (!$aparelho) {
            return redirect()->route('aparelhos.index')->with('error', 'Aparelho não encontrado.');
        }

        // Validação dos dados de entrada
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload seguro de imagem, se fornecida
        if ($request->file('image')) {
            // Remove imagem antiga, se existir
            if ($aparelho->image) {
                Storage::disk('public')->delete($aparelho->image);
            }

            $data['image'] = $request->file('image')->store('images', 'public');
        }

        // Atualiza o registro
        $aparelho->update($data);

        return redirect()->route('aparelhos.index')->with('success', 'Aparelho atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string|int $id)
    {
        $aparelho = Aparelho::find($id);

        if (!$aparelho) {
            return redirect()->route('aparelhos.index')->with('error', 'Aparelho não encontrado.');
        }

        // Remove imagem associada, se existir
        if ($aparelho->image) {
            Storage::disk('public')->delete($aparelho->image);
        }

        $aparelho->delete();

        return redirect()->route('aparelhos.index')->with('success', 'Aparelho removido com sucesso.');
    }

    /**
     * Filter appliances by category.
     */
    public function __invoke(Request $request)
    {
        // Validação do parâmetro de filtro
        $validated = $request->validate([
            'btnCategoria' => 'nullable|string|max:255',
        ]);

        $aparelhos = Aparelho::query()
            ->when($validated['btnCategoria'] ?? null, function ($query, $categoria) {
                $query->where('categoria', 'like', '%' . $categoria . '%');
            })
            ->get();

        return view('aparelhos.index', compact('aparelhos'));
    }
}
