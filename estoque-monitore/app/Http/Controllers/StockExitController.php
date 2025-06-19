<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockExit;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\StockExitItem;
use Illuminate\Support\Facades\DB;
use Throwable;

class StockExitController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $exits = StockExit::latest()->paginate(15);
        return view('stock_exits.index', ['exits' => $exits]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        // Só precisamos da lista de produtos para o dropdown
        $products = Product::orderBy('name')->get();
        return view('stock_exits.create', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'responsible' => 'required|string|max:255',
            'exit_date' => 'required|date',
            'product_ids' => 'required|array',
            'product_ids.*' => 'required|exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $totalValue = 0;

            // Loop de verificação e cálculo
            foreach ($validated['product_ids'] as $index => $productId) {
                $product = Product::find($productId);
                $quantity = $validated['quantities'][$index];

                // VERIFICAÇÃO DE ESTOQUE
                if ($product->stock_quantity < $quantity) {
                    // Joga uma exceção que será capturada pelo bloco catch
                    throw new \Exception("Estoque insuficiente para o produto: " . $product->name);
                }
                $totalValue += $quantity * $product->sale_price;
            }

            // 1. Cria a saída principal
            $stockExit = StockExit::create([
                'type' => $validated['type'],
                'responsible' => $validated['responsible'],
                'exit_date' => $validated['exit_date'],
                'total_value' => $totalValue,
                'user_id' => 1, // Solução temporária
            ]);

            // 2. Itera novamente para salvar os itens e DECREMENTAR o estoque
            foreach ($validated['product_ids'] as $index => $productId) {
                $quantity = $validated['quantities'][$index];
                $product = Product::find($productId);

                StockExitItem::create([
                    'stock_exit_id' => $stockExit->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'sale_price' => $product->sale_price,
                ]);

                // DECREMENTA o estoque do produto
                $product->decrement('stock_quantity', $quantity);
            }

            DB::commit();

            return redirect()->route('saidas.index')
                ->with('success', 'Saída de estoque registrada com sucesso!');
        } catch (Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Ocorreu um erro: ' . $e->getMessage()])->withInput();
        }
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
    public function edit(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }
}
