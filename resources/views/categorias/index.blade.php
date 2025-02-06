<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .table-responsive {
            overflow-x: auto;
        }
        .table thead th {
            background-color: #343a40;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .btn-action {
            margin: 2px;
            padding: 5px 10px;
            font-size: 14px;
        }
        .btn-action i {
            margin-right: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .form-container {
            padding: 20px;
            border-radius: 8px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Lista de Categorias de Produtos') }}
            </h2>
            <a href="{{ route('categorias.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-plus"></i> Cadastrar Categoria
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="form-container">
                        <!-- Tabela de Categorias -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categorias as $categoria)
                                        <tr>
                                            <td>{{ $categoria->id }}</td>
                                            <td>{{ $categoria->nome }}</td>
                                            <td>{{ $categoria->descricao }}</td>
                                            <td>
                                                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning btn-action">
                                                    <i class="fas fa-pencil-alt"></i> Editar
                                                </a>
                                                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-action" onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
                                                        <i class="fas fa-trash-alt"></i> Excluir
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>