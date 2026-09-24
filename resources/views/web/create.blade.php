@extends('layouts.app')

@section('conteudo')
    <div class="mb-3">
        <h2>Nova Categoria</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <!-- O action aponta para a rota store, método POST -->
            <form action="{{ route('categorias.store') }}" method="POST">
                @csrf <!-- OBRIGATÓRIO: Sem isso o Laravel bloqueia o formulário (Erro 419) -->

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome da Categoria</label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}">
                    
                    <!-- Mostra erro de validação (ex: se deixar em branco) -->
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-success">Salvar</button>
            </form>
        </div>
    </div>
@endsection