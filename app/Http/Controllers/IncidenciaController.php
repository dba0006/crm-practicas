<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia;
use App\Models\Cliente;

/**
 * Controlador de Incidencias - Gestión de tickets de soporte
 */
class IncidenciaController extends Controller
{
    public function index()
    {
        $incidencias = Incidencia::with('cliente')->orderBy('id')->get();
        return view('incidencias.index', compact('incidencias'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('incidencias.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'titulo' => 'required|string|max:200',
            'descripcion' => 'required|string',
            'prioridad' => 'required|in:baja,media,alta',
            'estado' => 'required|in:abierta,en_proceso,resuelta,cerrada',
            'fecha' => 'required|date',
        ]);

        Incidencia::create($validated);

        return redirect()->route('incidencias.index')
            ->with('success', 'Incidencia creada exitosamente.');
    }

    public function show(Incidencia $incidencia)
    {
        $incidencia->load('cliente');
        return view('incidencias.show', compact('incidencia'));
    }

    public function edit(Incidencia $incidencia)
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('incidencias.edit', compact('incidencia', 'clientes'));
    }

    public function update(Request $request, Incidencia $incidencia)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'titulo' => 'required|string|max:200',
            'descripcion' => 'required|string',
            'prioridad' => 'required|in:baja,media,alta',
            'estado' => 'required|in:abierta,en_proceso,resuelta,cerrada',
            'fecha' => 'required|date',
        ]);

        $incidencia->update($validated);

        return redirect()->route('incidencias.show', $incidencia)
            ->with('success', 'Incidencia actualizada exitosamente.');
    }

    public function destroy(Incidencia $incidencia)
    {
        $incidencia->delete();

        return redirect()->route('incidencias.index')
            ->with('success', 'Incidencia eliminada exitosamente.');
    }
}