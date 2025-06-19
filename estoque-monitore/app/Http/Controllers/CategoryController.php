<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        // Busca todas as categorias do banco, da mais nova para a mais antiga, com paginação
        $categories = Category::latest()->paginate(10);

        // Retorna a view, passando a variável 'categories' para ela
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        // Apenas mostra a página com o formulário
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // 1. Validação dos dados do formulário
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'nullable|string',
        ]);

        // 2. Se a validação passar, cria a categoria no banco
        Category::create($request->all());

        // 3. Redireciona o usuário de volta para a lista de categorias
        // com uma mensagem de sucesso
        return redirect()->route('categorias.index')
            ->with('success', 'Categoria criada com sucesso!');
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
    public function edit(Category $category) {
        // O Laravel já encontrou a categoria para nós graças ao Route Model Binding
        // Agora, apenas retornamos a view, passando a categoria encontrada
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category) {
        // 1. Validação (as mesmas regras da criação)
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'nullable|string',
        ]);

        // 2. Atualiza os dados da categoria no banco
        $category->update($request->all());

        // 3. Redireciona de volta para a lista com uma mensagem de sucesso
        return redirect()->route('categorias.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category) {
        // Apaga a categoria do banco de dados
        $category->delete();

        // Redireciona de volta para a lista com uma mensagem de sucesso
        return redirect()->route('categorias.index')
            ->with('success', 'Categoria apagada com sucesso!');
    }
}
