@extends('layouts.app')

@section('title', 'Saídas no Estoque')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Saídas no Estoque</h1>
    <a href="{{ route('saidas.create') }}" class="btn btn-primary">Nova Saída</a>
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
        <th>Tipo</th>
        <th>Responsável</th>
        <th>Valor Total</th>
        <th>Data da Saída</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($exits as $exit)
        <tr>
          <td>{{ $exit->id }}</td>
          <td>{{ $exit->type }}</td>
          <td>{{ $exit->responsible }}</td>
          <td>R$ {{ number_format($exit->total_value, 2, ',', '.') }}</td>
          <td>{{ \Carbon\Carbon::parse($exit->exit_date)->format('d/m/Y') }}</td>
          <td>
            {{-- Vamos fazer este link funcionar no passo 3 --}}
            <a href="{{ route('saidas.show', $exit) }}" class="btn btn-sm btn-info">Ver Itens</a>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center">Nenhuma saída registrada.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div>
    {{ $exits->links() }}
  </div>
@endsection
