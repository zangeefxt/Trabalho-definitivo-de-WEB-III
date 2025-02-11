<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Seus estilos anteriores aqui */
        .filtros {
            margin-bottom: 20px;
        }
        .filtros input {
            margin-right: 10px;
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .filtros button {
            padding: 5px 10px;
            border-radius: 4px;
            border: 1px solid #007bff;
            background-color: #007bff;
            color: white;
        }
        .filtros button:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Lista de Clientes') }}
            </h2>
            <a href="{{ route('clientes.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-plus"></i> Cadastrar Cliente
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="form-container">
                        <!-- Filtro de Busca -->
                        <div class="filtros">
                            <input type="text" id="searchInput" placeholder="Buscar cliente..." onkeyup="filterTable()">
                            <button onclick="filterTable()"><i class="fas fa-search"></i> Buscar</button>
                        </div>
                        <!-- Tabela de Clientes -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="clientesTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>Email</th>
                                        <th>Telefone</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clientes as $cliente)
                                        <tr>
                                            <td>{{ $cliente->id }}</td>
                                            <td>{{ $cliente->nome }}</td>
                                            <td>{{ $cliente->cpf }}</td>
                                            <td>{{ $cliente->email }}</td>
                                            <td>{{ $cliente->telefone }}</td>
                                            <td>
                                                <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info btn-action">
                                                    <i class="fas fa-search"></i> Visualizar
                                                </a>
                                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-action">
                                                    <i class="fas fa-pencil-alt"></i> Editar
                                                </a>
                                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-action" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">
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

    <script>
        function filterTable() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("clientesTable");
            tr = table.getElementsByTagName("tr");

            
            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td"); 
                let found = false; 

                
                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            found = true; 
                            break; 
                        }
                    }
                }

                if (found) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    </script>
</x-app-layout>