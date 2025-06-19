<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        // Usamos with('category') para carregar os dados da categoria relacionada
        // Isso evita o "problema de N+1 queries" e torna a consulta muito mais rápida.
        $products = Product::with('category')->latest()->paginate(10);

        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        // Busca todas as categorias no banco, ordenadas por nome
        $categories = Category::orderBy('name')->get();

        // Retorna a view, passando a lista de categorias para ela
        return view('products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'reference' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'unit' => 'required|string|max:10',
            'minimum_stock_quantity' => 'required|integer|min:0',
            'sale_price' => 'required|numeric|min:0',
        ]);

        // SOLUÇÃO TEMPORÁRIA: Atribui o produto ao primeiro usuário.
        // TODO: Substituir por Auth::id() quando o sistema de login estiver pronto.
        $validatedData['user_id'] = 1;
        // Define o estoque inicial como 0
        $validatedData['stock_quantity'] = 0;

        Product::create($validatedData);

        return redirect()->route('produtos.index')
            ->with('success', 'Produto cadastrado com sucesso!');
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
    public function edit(Product $product) {
        // Buscamos todas as categorias para popular o dropdown
        $categories = Category::orderBy('name')->get();

        // Passamos tanto o produto a ser editado quanto a lista de categorias para a view
        return view('products.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'reference' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'unit' => 'required|string|max:10',
            'minimum_stock_quantity' => 'required|integer|min:0',
            'sale_price' => 'required|numeric|min:0',
        ]);

        $product->update($validatedData);

        return redirect()->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product) {
        // Apaga o produto do banco de dados
        $product->delete();

        // Redireciona de volta para a lista com uma mensagem de sucesso
        return redirect()->route('produtos.index')
            ->with('success', 'Produto apagado com sucesso!');
    }
}
