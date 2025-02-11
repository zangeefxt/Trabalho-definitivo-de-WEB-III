<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\SaidaProduto;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;


class SaidaProdutoController extends Controller
{
    public function index()
    {
        // Busca todas as saídas de produtos com os dados do cliente e produto
        $saidasProdutos = SaidaProduto::with(['cliente', 'produto'])->latest()->get(); // Traz todas as saídas de produtos
        return view('saidas.index', compact('saidasProdutos')); // Passa para a view
    }


    public function create()
    {
        $produtos = Produto::all();
        $clientes = Cliente::all();

        return view('saidas.create', compact('produtos', 'clientes'));
    }

    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'produtos' => 'required|array',
            'produtos.*.produto_id' => 'required|exists:produtos,id',
            'produtos.*.quantidade' => 'required|integer|min:1',
        ]);

        $saidaIds = [];
        $qrData = [];

        DB::transaction(function () use ($request, &$saidaIds, &$qrData) {
            foreach ($request->produtos as $item) {
                $produto = Produto::lockForUpdate()->findOrFail($item['produto_id']);
        
                // Verifica se há estoque suficiente
                if ($item['quantidade'] > $produto->estoque) {
                    throw new \Exception("Quantidade solicitada para o produto {$produto->nome} excede o estoque disponível.");
                }
        
                // Atualiza o estoque do produto
                $produto->decrement('estoque', $item['quantidade']);
        
                // Registra a saída do produto
                $saida = SaidaProduto::create([
                    'cliente_id' => $request->cliente_id,
                    'produto_id' => $item['produto_id'],
                    'quantidade' => $item['quantidade'],
                    'valor_total' => $item['quantidade'] * $produto->preco,
                    'data_saida' => now(),
                ]);
        
                $saidaIds[] = $saida->id;
                $qrData[] = [
                    'Saida ID' => $saida->id,
                    'Cliente' => $saida->cliente->nome,
                    'Produto' => $saida->produto,
                    'Quantidade' => $saida->quantidade,
                    'Valor Total' => 'R$ ' . number_format($saida->valor_total, 2, ',', '.'),
                    'Data' => Carbon::parse($saida->data_saida)->format('d/m/Y H:i'),
                ];
        
                // Geração de QR Code para cada saída
                $qrCodeData = [
                    'Saida ID' => $saida->id,
                    'Cliente' => $saida->cliente->nome,
                    'Produto' => $saida->produto,
                    'Quantidade' => $saida->quantidade,
                    'Valor Total' => 'R$ ' . number_format($saida->valor_total, 2, ',', '.'),
                    'Data' => Carbon::parse($saida->data_saida)->format('d/m/Y H:i'),
                ];
        
                // Definir o caminho para o QR Code
                $qrCodePath = 'qr_codes/saida_' . $saida->id . '.svg';
        
                // Gera o QR Code e salva como SVG
                QrCode::size(200)->format('svg')->generate(json_encode($qrCodeData), public_path($qrCodePath));
        
                // Atualiza o caminho do QR Code para a saída
                $saida->update(['qr_code_path' => $qrCodePath]);
            }
        });
        

        return redirect()->route('saidas.index')
            ->with('success', 'Saída registrada com sucesso!');
    }

    public function show(SaidaProduto $saida)
    {
        return view('saidas.show', compact('saida'));
    }
}
