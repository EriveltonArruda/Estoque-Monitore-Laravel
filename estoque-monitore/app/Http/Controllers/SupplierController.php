<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        // Busca os fornecedores do banco, 10 por página
        $suppliers = Supplier::latest()->paginate(10);

        // Retorna a view, passando os dados
        return view('suppliers.index', ['suppliers' => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // Validação dos dados
        $request->validate([
            'fantasy_name' => 'required|string|max:255',
            'corporate_name' => 'required|string|max:255',
            'document' => 'required|string|max:20|unique:suppliers,document',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:2',
        ]);

        // Cria o fornecedor no banco de dados
        Supplier::create($request->all());

        // Redireciona com mensagem de sucesso
        return redirect()->route('fornecedores.index')
            ->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier) {
        return view('suppliers.edit', ['supplier' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier) {
        // Validação dos dados
        $request->validate([
            'fantasy_name' => 'required|string|max:255',
            'corporate_name' => 'required|string|max:255',
            // Ajuste na regra 'unique' para ignorar o próprio registro na verificação
            'document' => 'required|string|max:20|unique:suppliers,document,' . $supplier->id,
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:2',
        ]);

        // Atualiza o fornecedor no banco
        $supplier->update($request->all());

        // Redireciona com mensagem
        return redirect()->route('fornecedores.index')
            ->with('success', 'Fornecedor atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier) {
        // Apaga o fornecedor do banco de dados
        $supplier->delete();

        // Redireciona de volta para a lista com uma mensagem de sucesso
        return redirect()->route('fornecedores.index')
            ->with('success', 'Fornecedor apagado com sucesso!');
    }
}
