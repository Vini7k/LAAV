<?php

namespace App\Http\Controllers;

use App\Models\Aparelho;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class AparelhoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Aparelho $aparelhos)
    {
        $aparelhos = $aparelhos->all();
        
        return view('aparelhos/index', compact('aparelhos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aparelhos/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Aparelho $aparelhos)
    {
        $data = $request->all();
        $data['status'] = 'Disponível';

        if ($request->file('image'))
        {
            $file = $request->file('image');
            $file->store('public');
            $data['image'] = $file->hashName();
        }

        $aparelhos->create($data);

        return redirect()->route('aparelhos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string|int $id)
    {
        if (!$aparelho = Aparelho::find($id))
        {
            return back();
        }
        
        return view('aparelhos/show', compact('aparelho'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string|int $id)
    {
        if (!$aparelho = Aparelho::find($id))
        {
            return back();
        }

        return view('aparelhos/edit', compact('aparelho'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string|int $id)
    {
        if (!$aparelho = Aparelho::find($id))
        {
            return back();
        }

        $aparelho->update($request);

        return redirect()->route('aparelhos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string|int $id)
    {
        if (!$aparelho = Aparelho::find($id))
        {
            return back();
        }

        $aparelho->delete();

        return redirect()->route('aparelhos.index');
    }

    public function __invoke(Request $request)
    {
        return view('aparelhos/index', [
            'aparelhos' => Aparelho::query()
                ->where('categoria', 'like', '%' . request()->btnCategoria . '%')
                ->get()
        ]);
    }
}
