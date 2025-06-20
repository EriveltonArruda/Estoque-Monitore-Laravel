@extends('layouts.app')

@section('title', "Detalhes da Entrada #{$entry->id}")

@section('content')
  <h1>Detalhes da Entrada #{{ $entry->id }}</h1>
  <a href="{{ route('entradas.index') }}">Voltar para a Lista</a>
  <hr>

  <div class="card mb-3">
    <div class="card-header">Dados Gerais</div>
    <div class="card-body">
      <p><strong>Fornecedor:</strong> {{ $entry->supplier->fantasy_name }}</p>
      <p><strong>Número da Nota:</strong> {{ $entry->note_number ?? 'N/A' }}</p>
      <p><strong>Data de Emissão:</strong> {{ \Carbon\Carbon::parse($entry->emission_date)->format('d/m/Y') }}</p>
      <p><strong>Data da Entrada:</strong> {{ \Carbon\Carbon::parse($entry->entry_date)->format('d/m/Y') }}</p>
      <h5 class="card-title mt-3">Valor Total da Nota: R$ {{ number_format($entry->total_value, 2, ',', '.') }}</h5>
    </div>
  </div>

  <div class="card">
    <div class="card-header">Itens da Entrada</div>
    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Preço de Custo (un.)</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($entry->items as $item)
            <tr>
              <td>{{ $item->product->name }}</td>
              <td>{{ $item->quantity }}</td>
              <td>R$ {{ number_format($item->purchase_price, 2, ',', '.') }}</td>
              <td>R$ {{ number_format($item->quantity * $item->purchase_price, 2, ',', '.') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center">Nenhum item encontrado para esta entrada.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
