<x-app-layout>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            <i class="fas fa-boxes"></i> Produtos sem Estoque
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse border border-gray-300 dark:border-gray-700">
                            <thead class="bg-gray-200 dark:bg-gray-700">
                                <tr>
                                    <th class="border px-4 py-2">Nome do Produto</th>
                                    <th class="border px-4 py-2">Unidade</th>
                                    <th class="border px-4 py-2">Categoria</th>
                                    <th class="border px-4 py-2">Quantidade</th>
                                    <th class="border px-4 py-2">% Restante</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800">
                                @foreach($produtos as $produto)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="border px-4 py-2">{{ $produto->nome }}</td>
                                        <td class="border px-4 py-2">{{ $produto->unidade->nome }}</td>
                                        <td class="border px-4 py-2">{{ $produto->categoria->nome }}</td>
                                        <td class="border px-4 py-2">{{ $produto->estoque }}</td>
                                        <td class="border px-4 py-2 flex items-center">
                                            <i class="fas fa-box-open mr-2"></i>
                                            {{ $produto->estoque_inicial > 0 
                                                ? number_format(($produto->estoque / $produto->estoque_inicial) * 100, 2) 
                                                : '0' }}%
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
</x-app-layout>
