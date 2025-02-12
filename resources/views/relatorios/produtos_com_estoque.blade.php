<x-app-layout>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            <i class="fas fa-boxes"></i> Produtos com Estoque
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle">
                        <thead class="bg-gray-700 text-white">
                            <tr>
                                <th>Nome do Produto</th>
                                <th>Unidade</th>
                                <th>Categoria</th>
                                <th>Quantidade</th>
                                <th>% Restante</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-100 dark:bg-gray-700">
                            @foreach($produtos as $produto)
                                <tr>
                                    <td class="font-semibold">{{ $produto->nome }}</td>
                                    <td>{{ $produto->unidade->nome }}</td>
                                    <td>{{ $produto->categoria->nome }}</td>
                                    <td class="font-bold text-lg">{{ $produto->estoque }}</td>
                                    <td class="text-green-600 dark:text-green-300">
                                        <i class="fas fa-box-open"></i>
                                        {{ $produto->estoque_inicial > 0 ? number_format(($produto->estoque / $produto->estoque_inicial) * 100, 2) : '0' }}%
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
