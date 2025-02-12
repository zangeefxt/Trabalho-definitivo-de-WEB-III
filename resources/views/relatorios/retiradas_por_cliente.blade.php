<x-app-layout>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            <i class="fas fa-users"></i></i> Retiradas por Cliente
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-6">
                <div class="text-gray-900 dark:text-gray-100">
                    @foreach($clientes as $cliente)
                        <h3 class="font-bold flex items-center mt-4">
                            <i class="fas fa-user-circle mr-2"></i> {{ $cliente->nome }}
                        </h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-300 dark:border-gray-700">
                                <thead class="bg-blue-200 dark:bg-blue-700 text-blue-900 dark:text-blue-200">
                                    <tr>
                                        <th class="border px-4 py-2">Nome do Produto</th>
                                        <th class="border px-4 py-2">Unidade</th>
                                        <th class="border px-4 py-2">Categoria</th>
                                        <th class="border px-4 py-2">Quantidade Retirada</th>
                                        <th class="border px-4 py-2">Data da Retirada</th>
                                        <th class="border px-4 py-2">Valor Total</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800">
                                    @foreach($cliente->saidas as $saida)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <td class="border px-4 py-2">{{ $saida->produto->nome }}</td>
                                            <td class="border px-4 py-2">{{ $saida->produto->unidade->nome }}</td>
                                            <td class="border px-4 py-2">{{ $saida->produto->categoria->nome }}</td>
                                            <td class="border px-4 py-2">{{ $saida->quantidade }}</td>
                                            <td class="border px-4 py-2">{{ $saida->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="border px-4 py-2 text-green-600 dark:text-green-400 font-semibold">
                                                R$
                                                {{ number_format($saida->quantidade * $saida->produto->valor_unitario, 2, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>