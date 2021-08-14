<?php

class Notas extends Controller{

    public function __construct()
    {
        $this->clienteModel = $this->model('Cliente');
        $this->produtoModel = $this->model('Produto');
        $this->vendaModel = $this->model('Venda');
        $this->servicoModel = $this->model('Servico');
    }
    /* ____________________________MOSTRAR DADOS PARA A NOTA DO PRODUTO_____________________________ */
    public function notaProduto($id = null){
        
        $dados = [
            'vendaProduto' => $this->vendaModel->produtosCompra($id),
            'produtosComprados' => $this->vendaModel->produtosComprados($id),
            'produtos' => $this->produtoModel->lerProdutos(),
            'cliente' => $this->vendaModel->clienteCompra($id),
            'id_venda' => $id
        ];


        $this->view('paginas/notas/notaProduto',$dados);
    }

    /* _________________NOTA DA ENTRADA DO APARELHO__________________________________________ */
    public function entradaAparelho($id = null){
        
        $dados = [
            'servico' => $this->servicoModel->lerServicoPorId($id),
            'id_servio' => $id
        ];


        $this->view('paginas/notas/notaServicoEntrada',$dados);
    }
    public function saidaAparelho($id = null){
 

        $info = [
            'vendas' => $this->vendaModel->lerVendaServico($id),
        ];
        if($this->vendaModel->lerVendaServico($id)):
            foreach($info['vendas'] as $vendas):
                $idVenda = $vendas->id_venda;
            endforeach;
        else:
            $idVenda = '';
        endif;
        $dados = [
            'servico' => $this->servicoModel->lerServicoPorId($id),
            'vendaProduto' => $this->vendaModel->produtosCompra($idVenda),
            'id_servio' => $id
        ];

        $this->view('paginas/notas/notaServicoSaida',$dados,$info);
    }
}