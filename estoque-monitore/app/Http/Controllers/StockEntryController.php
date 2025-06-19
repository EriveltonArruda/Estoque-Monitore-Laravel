<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockEntry;
use App\Models\Supplier;
use App\Models\StockEntryItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Throwable;

class StockEntryController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        // Usamos with('supplier') para carregar os dados do fornecedor relacionado
        // de forma otimizada, evitando múltiplas consultas ao banco.
        $entries = StockEntry::with('supplier')->latest()->paginate(15);

        return view('stock_entries.index', ['entries' => $entries]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $suppliers = Supplier::orderBy('fantasy_name')->get();
        $products = Product::orderBy('name')->get();

        return view('stock_entries.create', [
            'suppliers' => $suppliers,
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'note_number' => 'nullable|string|max:255',
            'emission_date' => 'required|date',
            'entry_date' => 'required|date',
            'product_ids' => 'required|array',
            'product_ids.*' => 'required|exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
            'purchase_prices' => 'required|array',
            'purchase_prices.*' => 'required|numeric|min:0',
        ]);

        try {
            // Inicia uma transação. Se algo der errado, tudo é desfeito (rollback).
            DB::beginTransaction();

            $totalValue = 0;
            foreach ($validated['quantities'] as $index => $quantity) {
                $totalValue += $quantity * $validated['purchase_prices'][$index];
            }

            // 1. Cria a entrada principal
            $stockEntry = StockEntry::create([
                'supplier_id' => $validated['supplier_id'],
                'note_number' => $validated['note_number'],
                'emission_date' => $validated['emission_date'],
                'entry_date' => $validated['entry_date'],
                'total_value' => $totalValue,
                'user_id' => 1,
            ]);

            // 2. Itera sobre os itens e os salva, atualizando o estoque do produto
            foreach ($validated['product_ids'] as $index => $productId) {
                $quantity = $validated['quantities'][$index];
                $price = $validated['purchase_prices'][$index];

                // Cria o item da entrada
                StockEntryItem::create([
                    'stock_entry_id' => $stockEntry->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'purchase_price' => $price,
                ]);

                // Atualiza o estoque do produto
                $product = Product::find($productId);
                $product->increment('stock_quantity', $quantity);
            }

            // Se tudo correu bem, confirma a transação
            DB::commit();

            return redirect()->route('entradas.index')
                ->with('success', 'Entrada de estoque registrada com sucesso!');
        } catch (Throwable $e) {
            // Se algo deu errado, desfaz tudo
            DB::rollBack();
            // Retorna para a página anterior com o erro
            return back()->withErrors(['error' => 'Ocorreu um erro ao registrar a entrada: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(StockEntry $stock_entry) {
        // Usamos o método load() para carregar as relações DEPOIS que o objeto já foi encontrado.
        // A notação 'items.product' é uma relação aninhada. Estamos dizendo:
        // "Carregue os 'items' desta entrada e, para cada 'item', carregue também o 'product' relacionado".
        $stock_entry->load('supplier', 'items.product');

        return view('stock_entries.show', ['entry' => $stock_entry]);
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
