<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\StockEntry;
use App\Models\StockExit;
use Carbon\Carbon;

class DashboardController extends Controller {
    public function index() {
        // Card 1: Total de Produtos Cadastrados
        $totalProducts = Product::count();

        // Card 2: Itens no Estoque (soma de todas as quantidades)
        $totalItemsInStock = Product::sum('stock_quantity');

        // Card 3: Produtos com Estoque Zerado
        $productsWithZeroStock = Product::where('stock_quantity', 0)->count();

        // Card 4: Produtos com Estoque Mínimo
        // Lógica: estoque atual <= estoque mínimo E estoque atual > 0
        $productsLowStock = Product::where('stock_quantity', '>', 0)
            ->whereColumn('stock_quantity', '<=', 'minimum_stock_quantity')
            ->count();

        // Card 5: Valor Total do Estoque (baseado no preço de venda)
        //  A forma mais simples de calcular um valor. O 'Investimento' real precisaria do preço de custo de cada item.
        $stockValue = Product::select(DB::raw('SUM(stock_quantity * sale_price) as total'))
            ->first()
            ->total;

        // --- LÓGICA NOVA PARA O GRÁFICO ---
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subDays(9); // 10 dias no total (hoje + 9 dias atrás)

        // Busca os dados de Entradas e agrupa por dia
        $entries = StockEntry::whereBetween('entry_date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get([
                DB::raw('DATE(entry_date) as date'),
                DB::raw('COUNT(*) as count')
            ])
            ->pluck('count', 'date');

        // Busca os dados de Saídas e agrupa por dia
        $exits = StockExit::whereBetween('exit_date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get([
                DB::raw('DATE(exit_date) as date'),
                DB::raw('COUNT(*) as count')
            ])
            ->pluck('count', 'date');

        // Prepara os arrays para o Chart.js, garantindo que todos os 10 dias estejam presentes
        $chartLabels = [];
        $entriesData = [];
        $exitsData = [];

        for ($i = 0; $i < 10; $i++) {
            $date = $startDate->copy()->addDays($i);
            $dateString = $date->format('Y-m-d');
            $chartLabels[] = $date->format('d/m');
            $entriesData[] = $entries[$dateString] ?? 0;
            $exitsData[] = $exits[$dateString] ?? 0;
        }

        // Envia todos os dados para a view
        return view('dashboard', [
            'totalProducts' => $totalProducts,
            'totalItemsInStock' => $totalItemsInStock,
            'productsWithZeroStock' => $productsWithZeroStock,
            'productsLowStock' => $productsLowStock,
            'stockValue' => $stockValue,
            // Dados do gráfico
            'chartLabels' => $chartLabels,
            'entriesData' => $entriesData,
            'exitsData' => $exitsData,
        ]);
    }
}
