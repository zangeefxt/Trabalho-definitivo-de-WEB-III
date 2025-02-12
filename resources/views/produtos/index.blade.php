<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <i class="fas fa-boxes"></i> {{ __('Lista de Produtos') }}
            </h2>
            <a href="{{ route('produtos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Cadastrar Produto
            </a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Unidade</th>
                                    <th>Estoque</th>
                                    <th>Valor Unitário</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produtos as $produto)
                                    <tr>
                                        <td>{{ $produto->id }}</td>
                                        <td>{{ $produto->nome }}</td>
                                        <td>{{ $produto->categoria->nome ?? 'Sem Categoria' }}</td>
                                        <td>{{ $produto->unidade->sigla ?? 'Sem Unidade' }}</td>
                                        
                                        <!-- Estoque com ícones personalizados -->
                                        <td>
                                            @if($produto->estoque > 0)
                                                <span class="badge badge-success">
                                                    <i class="fas fa-box"></i> {{ $produto->estoque }}
                                                </span>
                                            @else
                                                <span class="badge badge-danger">
                                                    <i class="fas fa-exclamation-circle"></i> Sem Estoque
                                                </span>
                                            @endif
                                        </td>

                                        <!-- Formatação correta do preço -->
                                        <td>R$ {{ number_format($produto->valor_unitario, 2, ',', '.') }}</td>

                                        <!-- Ações -->
                                        <td class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('produtos.show', $produto->id) }}" class="btn btn-info btn-sm mx-1">
                                                <i class="fas fa-search"></i> Ver
                                            </a>
                                            <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning btn-sm mx-1">
                                                <i class="fas fa-pencil-alt"></i> Editar
                                            </a>
                                            
                                            <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mx-1">
                                                    <i class="fas fa-trash-alt"></i> Excluir
                                                </button>
                                            </form>

                                            <a href="{{ route('saidas.create', $produto->id) }}" class="btn btn-success btn-sm mx-1">
                                                <i class="fas fa-shopping-cart"></i> Vender
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Mensagem caso não existam produtos -->
                        @if($produtos->isEmpty())
                            <div class="alert alert-warning text-center" role="alert">
                                <i class="fas fa-exclamation-circle"></i> Nenhum produto cadastrado.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
