<?php

class Vendas extends Controller{

    public function __construct()
    {
        $this->clienteModel = $this->model('Cliente');
        $this->produtoModel = $this->model('Produto');
        $this->vendaModel = $this->model('Venda');
        $this->db = new DataBase;
    }

    /* ______________________________DADOS PARA INICIAR A COMPRA___________________________________________________ */
    public function dadosParaCompra(){
          
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if(isset($formulario)):
            $dados = [
                'id_cliente' => trim($formulario['id_cliente']),
                'nome_cliente' => trim($formulario['nome_cliente']),
                'telefone_cliente' => trim($formulario['telefone_cliente']),
                'endereco_cliente' => trim($formulario['endereco_cliente']),
                'cpf_cnpj_cliente' => trim($formulario['cpf_cnpj_cliente']),

                'id_produto' => trim($formulario['id_produto']),
                'quant_venda' => trim($formulario['quant_venda']),
                'data_compra' => trim(implode("-", array_reverse(explode("/",$formulario['data_compra'])))),
                

            ];

            if(!empty($formulario['id_cliente'])):
                    
                    $estoque = $this->produtoModel->lerProdutoPorId($dados['id_produto']);
                    if($dados['quant_venda'] <= $estoque->quant_produto):
                        if($this->vendaModel->armazenar($dados)):
                            $id_venda = $this->db->ultimoIdInserido();
                            $dados['id_venda'] = $id_venda;
                            $this->vendaModel->venderProduto($dados);
                            $total = $estoque->quant_produto - $dados['quant_venda'];
                            $this->produtoModel->diminuirVenda($dados['id_produto'],$total);
                            URL::redirecionar('vendas/venderProdutos/'.$id_venda.'');
                        endif;
                    
                        
                    
                    $dados = [
                        'id_cliente' => "",
                        'nome_cliente' => "",
                        'telefone_cliente' => "",
                        'endereco_cliente' => "",
                        'cpf_cnpj_cliente' => "",
        
                        'id_produto' => "",
                        'quant_venda' => "",
                        'data_compra' => "",
                    ];

                else:
                    Sessao::mensagem('venda','Quantidade superior ao do estoque','alert-danger');
                endif;

            else:
                if(empty($formulario['nome_cliente']) or empty($formulario['telefon_cliente'])
            or empty($formulario['endereco_cliente']) or empty($formulario['cpf_cnpj_cliente'])or empty($formulario['quant_produto'])):
                if(empty($formulario['nome_cliente'])):
                        Sessao::mensagem('venda','Preencha o campo nome','alert-danger');
                elseif(empty($formulario['telefone_cliente'])):
                        Sessao::mensagem('venda','Preencha o campo telefone','alert-danger');
                elseif(empty($formulario['endereco_cliente'])):
                        Sessao::mensagem('venda','Preencha o campo endereço','alert-danger');
                elseif(empty($formulario['cpf_cnpj_cliente'])):
                        Sessao::mensagem('venda','Preencha o campo CPF/CNPJ','alert-danger');
                elseif(empty($formulario['quant_venda'])):
                        Sessao::mensagem('venda','Preencha o campo quantidade','alert-danger');
                elseif($this->clienteModel->armazenar($dados)):
                    if(empty($dados['id_cliente'])):
                        $dados['id_cliente'] = $this->db->ultimoIdInserido();
                       
                    endif;

                    $estoque = $this->produtoModel->lerProdutoPorId($dados['id_produto']);
                    if($dados['quant_venda'] <= $estoque->quant_produto):
                        if($this->vendaModel->armazenar($dados)):
                            $id_venda = $this->db->ultimoIdInserido();
                            $dados['id_venda'] = $id_venda;
                            $this->vendaModel->venderProduto($dados);
                            $total = $estoque->quant_produto - $dados['quant_venda'];
                            $this->produtoModel->diminuirVenda($dados['id_produto'],$total);
                            URL::redirecionar('vendas/venderProdutos/'.$id_venda.'');
                        endif;
                    else:
                        Sessao::mensagem('venda','Quantidade superior ao do estoque','alert-danger');
                    endif;

                    $dados = [
                        'nome_cliente' => '',
                        'telefone_cliente' => '',
                        'endereco_cliente' => '',
                        'cpf_cnpj_cliente' => '',

                        'id_produto' => "",
                        'quant_venda' => "",
                        'data_compra' => "",
                    ];
             
                endif;
                    
            else: 

                    Sessao::mensagem('venda','Erro iniciar a venda','alert-danger');

           
        endif;

            endif;
        else:
            $dados = [
                'id_cliente' => "",
                'nome_cliente' => "",
                'telefone_cliente' => "",
                'endereco_cliente' => "",
                'cpf_cnpj_cliente' => "",

                'id_produto' => "",
                'quant_venda' => "",
                'data_compra' => "",
            ];
        endif;
        $info = [
            'clientes' => $this->clienteModel->lerClientes(),
            'produtos' => $this->produtoModel->lerProdutos(),
            'vendas' => $this->vendaModel->lerVendas(),
        ];

        $this->view('paginas/vendas/dadosParaCompra', $dados,$info);
    }

    /* ________________________VENDER PRODUTO_________________________________________________________ */

    public function venderProdutos($id = null){
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if(isset($formulario)):
            $dados = [
                'id_cliente' => trim($formulario['id_cliente']),
                'id_produto' => trim($formulario['id_produto']),
                'quant_venda' => trim($formulario['quant_venda']),
                'id_venda' =>  trim($formulario['id_venda'])

            ];

            $estoque = $this->produtoModel->lerProdutoPorId($dados['id_produto']);
            if($dados['quant_venda'] <= $estoque->quant_produto):
               
                    $this->vendaModel->venderProduto($dados);

                    $total = $estoque->quant_produto - $dados['quant_venda'];
                    $this->produtoModel->diminuirVenda($dados['id_produto'],$total);
                    URL::redirecionar('vendas/venderProdutos/'.$dados['id_venda'].'');
              
            else:
                Sessao::mensagem('venda','Quantidade superior ao do estoque','alert-danger');
            endif;

        else:
            $dados = [
                'id_cliente' => '',
                'id_produto' => '',
                'quant_venda' => '',
                'id_venda' => ''

            ];
            
        endif;
        $info = [
            'vendaProduto' => $this->vendaModel->produtosCompra($id),
            'produtos' => $this->produtoModel->lerProdutos(),
            'cliente' => $this->vendaModel->clienteCompra($id),
            'id_venda' => $id
        ];
       
        $this->view('paginas/vendas/venderProdutos',$dados,$info);
    }
    /* ________________________EDITAR VENDA____________________________________________________ */
        public function alterarVendaProduto(){
            $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $dados = [
               
                'id_cliente' => $formulario['id_cliente'],
                'id_venda' => $formulario['id_venda'],
                'desconto' => $formulario['desconto'],
                'valor_venda' => $formulario['valor_venda'],
                'valor_total' => $formulario['valor_total']
            ];
            

            if($this->vendaModel->atualizarVendaProduto($dados)):
                Sessao::mensagem('venda','Venda atualizada com sucesso!');
                URL::redirecionar('vendas/editarVenderProdutos/'.$dados['id_venda'].'');
            endif;
        }

        /* ______________________________DADOS PARA EDITAR A VENDA_____________________________ */
        public function editarVenderProdutos($id){
            $dados = [];

            $info = [
                'vendaProduto' => $this->vendaModel->produtosCompra($id),
                'produtos' => $this->produtoModel->lerProdutos(),
                'cliente' => $this->vendaModel->clienteCompra($id),
                'clientes' => $this->clienteModel->lerClientes(),
                'id_venda' => $id,
                'venda' => $this->vendaModel->lerVendasPorId($id)
            ];
           
            $this->view('paginas/vendas/editarvenderProdutos',$dados,$info);
        }
    /* ________________________FINALIZAR VENDA____________________________________________________ */
    public function finalizarVenda(){
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $dados = [
            'id_venda' => $formulario['id_venda'],
            'desconto' => $formulario['desconto'],
            'valor_venda' => $formulario['valor_venda'],
            'valor_total' => $formulario['valor_total']
        ];

        if($this->vendaModel->finalizaVenda($dados)):
            Sessao::mensagem('venda','Venda finalizada com sucesso');
            URL::redirecionar('vendas/posVenda/'.$dados['id_venda'].'');
        endif;
    }

    /* ____________________DADOS DOS PÓS VENDA_________________________________________________ */

    public function posVenda($id = null){

        $info = [
            'vendaProduto' => $this->vendaModel->produtosCompra($id),
            'produtosComprados' => $this->vendaModel->produtosComprados($id),
            'produtos' => $this->produtoModel->lerProdutos(),
            'cliente' => $this->vendaModel->clienteCompra($id),
            'id_venda' => $id
        ];
        $dados = [];
        foreach($info['vendaProduto'] as $vendas):
            if($vendas->situacao == '0'):
                Sessao::mensagem('venda','A venda não foi finalizada!','alert-danger');
                URL::redirecionar('vendas/venderProdutos/'.$id);
            else:
                $this->view('paginas/vendas/posVenda',$dados,$info);
            endif;
        endforeach;
       
    }

    /* ________________________EXCLUIR PRODUTO DA COMPRA___________________________________________ */

    public function excluirProdutoDaCompra(){
        $id_venda = (int) $_GET['id_venda'];
        $id_produto = (int) $_GET['id_produto'];

        $estoque = $this->produtoModel->lerProdutoPorId($id_produto);

        $venda_quant = $this->vendaModel->buscarProdutoDaVenda($id_venda, $id_produto);

        $total = $estoque->quant_produto + $venda_quant->quant_venda;

        if($this->vendaModel->excluirProdutoCompra($id_venda, $id_produto)):


            $this->produtoModel->adicionarEstoque($id_produto, $total);

            Sessao::mensagem('venda','Produto excluido da venda com sucesso!');
            URL::redirecionar('vendas/venderProdutos/'.$id_venda.'');
        else:
            Sessao::mensagem('venda','Erro produto excluido da venda com sucesso!','alert-danger');
            URL::redirecionar('vendas/venderProdutos/'.$id_venda.'');
        endif;
    }
    /* ________________________________________EXCLUIR VENDA______________________________________________________ */
    public function excluirVenda(){

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if(isset($formulario)):
            $dados = [
                'id_produto' => $formulario['id_produto'],
                'quant_venda' => $formulario['quant_venda'],
                'id_venda' => $formulario['id_venda']
            ];
        

        $prodEstoque = array();
        $prodVenda = array();
        $soma = array();
        foreach($dados['id_produto'] as $produtos):
            $estoqueVenda = $this->produtoModel->lerVariosProdutoPorId2($produtos);
            $produto = $this->produtoModel->lerVariosProdutoPorId($estoqueVenda->id_produto);
           
            $prodEstoque[$estoqueVenda->id_produto] = $produto->quant_produto;
            $prodVenda[$estoqueVenda->id_produto] = $estoqueVenda->quant_venda;
            $soma[$estoqueVenda->id_produto] = $produto->quant_produto + $estoqueVenda->quant_venda;
        endforeach;

        $this->produtoModel->ajustarEstoque($soma);
            $this->vendaModel->excluirVendaProduto($dados['id_venda']);
            $this->vendaModel->excluirVenda($dados['id_venda']);
            Sessao::mensagem('venda','Venda excluida com sucesso');
            URL::redirecionar('vendas/dadosParaCompra');
      
        

        endif;
    }

/* -------------------------------------ALTERAR VENDA-------------------------------------------------- */


public function alterarVenderProdutos($id = null){
    $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    if(isset($formulario)):
        $dados = [
            'id_cliente' => trim($formulario['id_cliente']),
            'id_produto' => trim($formulario['id_produto']),
            'quant_venda' => trim($formulario['quant_venda']),
            'id_venda' =>  trim($formulario['id_venda'])

        ];

        $estoque = $this->produtoModel->lerProdutoPorId($dados['id_produto']);
        if($dados['quant_venda'] <= $estoque->quant_produto):
           
                $this->vendaModel->venderProduto($dados);

                $total = $estoque->quant_produto - $dados['quant_venda'];
                $this->produtoModel->diminuirVenda($dados['id_produto'],$total);
                Sessao::mensagem('venda','Produto adicionado com sucesso!');
                URL::redirecionar('vendas/editarVenderProdutos/'.$dados['id_venda'].'');
          
        else:
            Sessao::mensagem('venda','Quantidade superior ao do estoque','alert-danger');
        endif;

    else:
        $dados = [
            'id_cliente' => '',
            'id_produto' => '',
            'quant_venda' => '',
            'id_venda' => ''

        ];
        
    endif;
    $info = [
        'vendaProduto' => $this->vendaModel->produtosCompra($id),
        'produtos' => $this->produtoModel->lerProdutos(),
        'cliente' => $this->vendaModel->clienteCompra($id),
        'clientes' => $this->vendaModel->clienteCompra($id),
        'id_venda' => $id
    ];
   
    $this->view('paginas/vendas/editarVenderProdutos',$dados,$info);
}

    /* _________________________________EXCLUIR PRODUTO DA VENDA NO ALTERAR VENDA_________________ */

    public function alterarExcluindoProdutoDaCompra(){
        $id_venda = (int) $_GET['id_venda'];
        $id_produto = (int) $_GET['id_produto'];

        $estoque = $this->produtoModel->lerProdutoPorId($id_produto);

        $venda_quant = $this->vendaModel->buscarProdutoDaVenda($id_venda, $id_produto);

        $total = $estoque->quant_produto + $venda_quant->quant_venda;

        if($this->vendaModel->excluirProdutoCompra($id_venda, $id_produto)):


            $this->produtoModel->adicionarEstoque($id_produto, $total);

            Sessao::mensagem('venda','Produto excluido da venda com sucesso!');
            URL::redirecionar('vendas/editarVenderProdutos/'.$id_venda.'');
        else:
            Sessao::mensagem('venda','Erro produto excluido da venda com sucesso!','alert-danger');
            URL::redirecionar('vendas/editarVenderProdutos/'.$id_venda.'');
        endif;
    }
}