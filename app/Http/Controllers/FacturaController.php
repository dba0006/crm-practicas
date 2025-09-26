<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\Cliente;

/**
 * Controlador de Facturas - Gestión financiera del CRM
 */
class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::with('cliente')->orderBy('id')->get();
        return view('facturas.index', compact('facturas'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('facturas.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'numero' => 'required|string|max:50',
            'descripcion' => 'required|string|max:1000',
            'monto' => 'required|numeric|min:0',
            'impuesto' => 'nullable|numeric|min:0',
            'fecha' => 'required|date',
            'estado_pago' => 'required|in:pendiente,pagada,vencida'
        ]);

        $validated['impuesto'] = $validated['impuesto'] ?? 0;
        $validated['total'] = $validated['monto'] + $validated['impuesto'];

        Factura::create($validated);

        return redirect()->route('facturas.index')
            ->with('success', 'Factura creada exitosamente.');
    }

    public function show(Factura $factura)
    {
        $factura->load('cliente');
        return view('facturas.show', compact('factura'));
    }

    public function edit(Factura $factura)
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('facturas.edit', compact('factura', 'clientes'));
    }

    public function update(Request $request, Factura $factura)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'descripcion' => 'required|string|max:1000',
            'monto' => 'required|numeric|min:0',
            'impuesto' => 'nullable|numeric|min:0',
            'fecha' => 'required|date',
            'estado_pago' => 'required|in:pendiente,pagada,vencida'
        ]);

        $validated['impuesto'] = $validated['impuesto'] ?? 0;
        $validated['total'] = $validated['monto'] + $validated['impuesto'];

        $factura->update($validated);

        return redirect()->route('facturas.show', $factura)
            ->with('success', 'Factura actualizada exitosamente.');
    }

    public function destroy(Factura $factura)
    {
        $factura->delete();

        return redirect()->route('facturas.index')
            ->with('success', 'Factura eliminada exitosamente.');
    }
}