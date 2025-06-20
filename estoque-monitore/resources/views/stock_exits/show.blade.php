@extends('layouts.app')

@section('title', "Detalhes da Saída #{$exit->id}")

@section('content')
  <h1>Detalhes da Saída #{{ $exit->id }}</h1>
  <a href="{{ route('saidas.index') }}">Voltar para a Lista</a>
  <hr>

  <div class="card mb-3">
    <div class="card-header">Dados Gerais</div>
    <div class="card-body">
      <p><strong>Tipo de Saída:</strong> {{ $exit->type }}</p>
      <p><strong>Responsável:</strong> {{ $exit->responsible }}</p>
      <p><strong>Data da Saída:</strong> {{ \Carbon\Carbon::parse($exit->exit_date)->format('d/m/Y') }}</p>
      <h5 class="card-title mt-3">Valor Total da Saída (baseado no preço de venda): R$
        {{ number_format($exit->total_value, 2, ',', '.') }}</h5>
    </div>
  </div>

  <div class="card">
    <div class="card-header">Itens da Saída</div>
    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Valor (un.)</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($exit->items as $item)
            <tr>
              <td>{{ $item->product->name }}</td>
              <td>{{ $item->quantity }}</td>
              <td>R$ {{ number_format($item->sale_price, 2, ',', '.') }}</td>
              <td>R$ {{ number_format($item->quantity * $item->sale_price, 2, ',', '.') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center">Nenhum item encontrado para esta saída.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
