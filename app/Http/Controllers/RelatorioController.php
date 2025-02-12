<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaidaProduto;
use App\Models\Produto;
use App\Models\Cliente;
use Carbon\Carbon;

class RelatorioController extends Controller
{
    // Relatório de Retiradas Agrupadas por Período
    public function retiradasPorPeriodo(Request $request)
    {
        $periodo = $request->input('periodo', 'diario'); // Padrão: diário
        $retiradas = SaidaProduto::with(['produto', 'cliente']);

        switch ($periodo) {
            case 'diario':
                $retiradas->whereDate('created_at', Carbon::today());
                break;
            case 'semanal':
                $retiradas->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'mensal':
                $retiradas->whereMonth('created_at', Carbon::now()->month);
                break;
        }

        $retiradas = $retiradas->get();

        return view('relatorios.retiradas_por_periodo', compact('retiradas', 'periodo'));
    }

    // Relatório de Retiradas Agrupadas por Cliente
    public function retiradasPorCliente()
    {
        $clientes = Cliente::with('saidas.produto')->get();
        return view('relatorios.retiradas_por_cliente', compact('clientes'));
    }

    // Relatório de Produtos sem Estoque
    public function produtosSemEstoque()
    {
        $produtos = Produto::where('estoque', 0)->get();
        return view('relatorios.produtos_sem_estoque', compact('produtos'));
    }

    // Relatório de Produtos com Estoque
    public function produtosComEstoque()
    {
        $produtos = Produto::where('estoque', '>', 0)->get();
        return view('relatorios.produtos_com_estoque', compact('produtos'));
    }
}