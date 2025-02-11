<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Registrar Saída de Produtos') }}
            </h2>
            <a href="{{ route('saidas.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar para os Produtos
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('saidas.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="cliente_id">Cliente</label>
                            <select class="form-control" name="cliente_id" required>
                                <option value="">Selecione um cliente</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="produtos-container">
                            <h4>Produtos</h4>
                            <div class="produto-item mb-3">
                                <!--<label for="produtos[0][produto_id]">Produto</label>-->
                                <select name="produtos[0][produto_id]" class="form-control" required>
                                    <option value="">Selecione um produto</option>
                                    @foreach($produtos as $produto)
                                        <option value="{{ $produto->id }}" data-estoque="{{ $produto->estoque }}">
                                            {{ $produto->nome }} (Estoque: {{ $produto->estoque }})
                                        </option>
                                    @endforeach
                                </select>

                                <label for="produtos[0][quantidade]">Quantidade</label>
                                <input type="number" name="produtos[0][quantidade]" class="form-control" min="1" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start align-items-center gap-2 mb-3">
                            <button type="button" class="btn btn-secondary" id="add-produto">
                                Adicionar Produto
                            </button>
    
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check"></i> Confirmar Saída
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let produtoIndex = 1;
        $(document).ready(function () {
            $('#add-produto').click(function () {
                const container = $('#produtos-container');
                const newItem = $(
                    `<div class="produto-item mb-3">
                        <label>Produto</label>
                        <select name="produtos[${produtoIndex}][produto_id]" class="form-control" required>
                            <option value="">Selecione um produto</option>
                            @foreach($produtos as $produto)
                                <option value="{{ $produto->id }}" data-estoque="{{ $produto->estoque }}">
                                    {{ $produto->nome }} (Estoque: {{ $produto->estoque }})
                                </option>
                            @endforeach
                        </select>

                        <label>Quantidade</label>
                        <input type="number" name="produtos[${produtoIndex}][quantidade]" class="form-control" min="1" required>
                    </div>`
                );
                container.append(newItem);
                produtoIndex++;
            });
        });
    </script>
</x-app-layout>
