<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

/**
 * Controlador de Clientes - CRUD completo para gestión de clientes
 */
class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy('id')->get();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes|max:255',
            'telefono' => 'nullable|string|regex:/^[\d\s\+\-\(\)]{9,15}$/',
            'direccion' => 'nullable|string|max:500',
        ], [
            'telefono.regex' => 'El teléfono debe contener entre 9 y 15 dígitos. Ejemplo: 666777888 o +34666777888',
        ]);

        Cliente::create($validated);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente creado correctamente.');
    }

    public function show(Cliente $cliente)
    {
        $cliente->load(['incidencias', 'facturas']);
        return view('clientes.show', compact('cliente'));
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $id . '|max:255',
            'telefono' => 'nullable|string|regex:/^[\d\s\+\-\(\)]{9,15}$/',
            'direccion' => 'nullable|string|max:500',
        ], [
            'telefono.regex' => 'El teléfono debe contener entre 9 y 15 dígitos. Ejemplo: 666777888 o +34666777888',
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($validated);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente eliminado correctamente.');
    }
}