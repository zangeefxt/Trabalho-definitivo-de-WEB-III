<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalhes da Saída de Produto
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p><strong>Cliente:</strong> {{ $saida->cliente->nome }}</p>
                
                <h4 class="mt-4"><strong>Produtos Retirados:</strong></h4>
                <ul>
                    @forelse($saida->produtos ?? [] as $produto)
                        <li>
                            <strong>Produto:</strong> {{ $produto->nome }} <br>
                            <strong>Quantidade:</strong> {{ $produto->pivot->quantidade }} <br>
                            <strong>Preço Unitário:</strong> R$ {{ number_format($produto->preco, 2, ',', '.') }}
                        </li>
                        <hr>
                    @empty
                        <p>Não há saídas registradas.</p>
                    @endforelse
                </ul>

                
                <p><strong>Valor Total:</strong> R$ {{ number_format($saida->valor_total, 2, ',', '.') }}</p>
                
                <h4 class="mt-4">QR Code:</h4>
                @if($saida->qr_code_path)
                    <img src="{{ asset($saida->qr_code_path) }}" alt="QR Code">
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
