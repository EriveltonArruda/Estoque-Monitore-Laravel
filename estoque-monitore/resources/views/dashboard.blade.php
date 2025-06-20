{{-- 1. Diz ao Blade para usar o nosso layout mestre --}}
@extends('layouts.app')

{{-- 2. Define o título específico para esta página --}}
@section('title', 'Página Inicial')

{{-- 3. Inicia a seção de conteúdo que será injetada no @yield('content') --}}
@section('content')
  <h1>Página Inicial</h1>
  <p>Visão Geral do Controle de Estoque</p>
  <hr>

  {{-- O código dos cards e do gráfico que já fizemos --}}
  {{-- (Vamos remover os estilos inline, pois o Bootstrap e nosso CSS principal cuidarão disso) --}}
  <div class="row">
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card text-white bg-primary">
        <div class="card-body">
          <h5 class="card-title">Produtos Cadastrados</h5>
          <p class="card-text fs-4 fw-bold">{{ $totalProducts }}</p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card text-white bg-info">
        <div class="card-body">
          <h5 class="card-title">Itens no Estoque</h5>
          <p class="card-text fs-4 fw-bold">{{ $totalItemsInStock }}</p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card text-white bg-danger">
        <div class="card-body">
          <h5 class="card-title">Estoque Zerado</h5>
          <p class="card-text fs-4 fw-bold">{{ $productsWithZeroStock }}</p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card text-white bg-warning">
        <div class="card-body">
          <h5 class="card-title">Estoque Baixo</h5>
          <p class="card-text fs-4 fw-bold">{{ $productsLowStock }}</p>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Entradas e Saídas (Últimos 10 Dias)</h5>
          <div class="chart-container"> {{-- <-- NOSSA "CAIXA" DE VOLTA --}}
            <canvas id="entriesExitsChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
    {{-- 1. Carrega a biblioteca Chart.js apenas nesta página --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- 2. Inicia o nosso gráfico --}}
    <script>
      const ctx = document.getElementById('entriesExitsChart');
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: @json($chartLabels),
          datasets: [{
              label: 'Entradas',
              data: @json($entriesData),
              borderColor: '#0d6efd',
              fill: false,
            },
            {
              label: 'Saídas',
              data: @json($exitsData),
              borderColor: '#198754',
              fill: false,
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
        }
      });
    </script>
  @endpush
@endsection
{{-- 4. Finaliza a seção de conteúdo --}}
