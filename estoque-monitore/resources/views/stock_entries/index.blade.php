@extends('layouts.app')

@section('title', 'Entradas no Estoque')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Entradas no Estoque</h1>
    <a href="{{ route('entradas.create') }}" class="btn btn-primary">Nova Entrada</a>
  </div>

  <hr>

  @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <table class="table table-striped table-hover">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nota</th>
        <th>Fornecedor</th>
        <th>Valor Total</th>
        <th>Data da Entrada</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($entries as $entry)
        <tr>
          <td>{{ $entry->id }}</td>
          <td>{{ $entry->note_number ?? 'N/A' }}</td>
          <td>{{ $entry->supplier->fantasy_name ?? 'N/A' }}</td>
          <td>R$ {{ number_format($entry->total_value, 2, ',', '.') }}</td>
          <td>{{ \Carbon\Carbon::parse($entry->entry_date)->format('d/m/Y') }}</td>
          <td>
            <a href="{{ route('entradas.show', $entry) }}" class="btn btn-sm btn-info">Ver Itens</a>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center">Nenhuma entrada registrada.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div>
    {{ $entries->links() }}
  </div>
@endsection
