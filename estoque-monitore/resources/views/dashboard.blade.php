<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Dashboard - Controle de Estoque</title>
  {{-- 1. INCLUIR A BIBLIOTECA CHART.JS --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: sans-serif;
      background-color: #f4f6f9;
    }

    .main-content {
      /* <-- NOSSO NOVO CONTÊINER */
      max-width: 1400px;
      margin: 20px auto;
      /* 20px de margem em cima/embaixo, auto nas laterais para centralizar */
      padding: 20px;
    }

    .card-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      font-family: sans-serif;
    }

    .card {
      border-radius: 8px;
      padding: 20px;
      color: white;
      width: 220px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card h3 {
      margin-top: 0;
    }

    .card p {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 0;
    }

    .bg-blue {
      background-color: #007bff;
    }

    .bg-red {
      background-color: #dc3545;
    }

    .bg-yellow {
      background-color: #ffc107;
    }

    .bg-green {
      background-color: #28a745;
    }
  </style>
</head>

<body>
  <div class="main-content">
    <h1>Página Inicial</h1>
    <p>Visão Geral do Controle de Estoque</p>
    <hr>

    <div class="card-container">
      <div class="card bg-blue">
        <h3>Produtos Cadastrados</h3>
        <p>{{ $totalProducts }}</p>
      </div>
      <div class="card bg-blue">
        <h3>Total de Itens no Estoque</h3>
        <p>{{ $totalItemsInStock }}</p>
      </div>
      <div class="card bg-red">
        <h3>Produtos com Estoque Zerado</h3>
        <p>{{ $productsWithZeroStock }}</p>
      </div>
      <div class="card bg-yellow">
        <h3>Produtos com Estoque Baixo</h3>
        <p>{{ $productsLowStock }}</p>
      </div>
      <div class="card bg-green">
        <h3>Valor do Estoque (Venda)</h3>
        <p>R$ {{ number_format($stockValue, 2, ',', '.') }}</p>
      </div>
    </div>

    {{-- os gráficos virão aqui --}}
    <hr style="margin-top: 40px;">

    {{-- 2. ADICIONAR A ÁREA DO GRÁFICO --}}
    <div style="width: 80%; margin-top: 20px;">
      <h3>Entradas e Saídas (Últimos 10 Dias)</h3>
      <canvas id="entriesExitsChart"></canvas>
    </div>
  </div>

  {{-- 3. ADICIONAR O SCRIPT PARA INICIAR O GRÁFICO --}}
  <script>
    // Pega o contexto do canvas
    const ctx = document.getElementById('entriesExitsChart');

    // Cria o gráfico
    new Chart(ctx, {
      type: 'line', // Tipo de gráfico
      data: {
        labels: @json($chartLabels),
        datasets: [{
            label: 'Entradas',
            data: @json($entriesData),
            borderColor: 'blue',
            backgroundColor: 'rgba(0, 0, 255, 0.1)',
            fill: true,
            tension: 0.1
          },
          {
            label: 'Saídas',
            data: @json($exitsData),
            borderColor: 'green',
            backgroundColor: 'rgba(0, 255, 0, 0.1)',
            fill: true,
            tension: 0.1
          }
        ]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

</body>

</html>
