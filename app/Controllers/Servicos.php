<?php

class Servicos extends Controller{

    public $ultimoId;
    private $db;

   public function __construct()
    {
      $this->clienteModel = $this->model("Cliente");
      $this->servicoModel = $this->model("Servico");
      $this->produtoModel = $this->model("Produto");
      $this->vendaModel = $this->model("Venda");
      $this->db = new DataBase;
    } 

    /* __________________________CADASTRAR O SERVIÇO__________________________________________ */
    public function cadastrar(){
       
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if(isset($formulario)):
            $dados = [
                'id_cliente' => trim($formulario['id_cliente']),
                'nome_cliente' => trim($formulario['nome_cliente']),
                'telefone_cliente' => trim($formulario['telefone_cliente']),
                'endereco_cliente' => trim($formulario['endereco_cliente']),
                'cpf_cnpj_cliente' => trim($formulario['cpf_cnpj_cliente']),

                'aparelho_cliente' => trim($formulario['aparelho_cliente']),
                'marca_aparelho' => trim($formulario['marca_aparelho']),
                'modelo_aparelho' => trim($formulario['modelo_aparelho']),
                'problema_aparelho' => trim($formulario['problema_aparelho']),
                'data_entrada' => trim(implode("-", array_reverse(explode("/",$formulario['data_entrada'])))),
                

            ];

            if(!empty($formulario['id_cliente'])):
                if(empty($formulario['aparelho_cliente']) or empty($formulario['marca_aparelho']) 
                or empty($formulario['problema_aparelho']) or empty($formulario['data_entrada'])):
    
                     if(empty($formulario['aparelho_cliente'])):
                            Sessao::mensagem('servico','Preencha o campo aparelho','alert-danger');
                    elseif(empty($formulario['marca_aparelho'])):
                            Sessao::mensagem('servico','Preencha o campo marca','alert-danger');
                    elseif(empty($formulario['problema_aparelho'])):
                            Sessao::mensagem('servico','Preencha o campo problema','alert-danger');
                    elseif(empty($formulario['problema_aparelho'])):
                            Sessao::mensagem('servico','Preencha o campo problema','alert-danger');
                   
                    endif;
                else:
                    $this->servicoModel->armazenar($dados);
                    $id_servico = $this->db->ultimoIdInserido();
                    Sessao::mensagem('servico','Serviço cadastrado com sucesso!');
                    URL::redirecionar('servicos/infoServico/'.$id_servico.'');
                    $dados = [
                        'id_cliente' => "",
                        'nome_cliente' => "",
                        'telefone_cliente' => "",
                        'endereco_cliente' => "",
                        'cpf_cnpj_cliente' => "",
        
                        'aparelho_cliente' => "",
                        'marca_aparelho' => "",
                        'modelo_aparelho' => "",
                        'problema_aparelho' => "",
                        'data_entrada' => "",
                    ];

                endif;

            else:
                if(empty($formulario['nome_cliente']) or empty($formulario['telefon_cliente'])
            or empty($formulario['endereco_cliente'])or empty($formulario['aparelho_cliente']) 
            or empty($formulario['marca_aparelho']) or empty($formulario['problema_aparelho']) 
            or empty($formulario['data_entrada'])):

                if(empty($formulario['nome_cliente'])):
                        Sessao::mensagem('servico','Preencha o campo nome','alert-danger');
                elseif(empty($formulario['telefone_cliente'])):
                        Sessao::mensagem('servico','Preencha o campo telefone','alert-danger');
                elseif(empty($formulario['endereco_cliente'])):
                        Sessao::mensagem('servico','Preencha o campo endereço','alert-danger');

               elseif(empty($formulario['aparelho_cliente'])):
                        Sessao::mensagem('servico','Preencha o campo aparelho','alert-danger');
                elseif(empty($formulario['marca_aparelho'])):
                        Sessao::mensagem('servico','Preencha o campo marca','alert-danger');
                elseif(empty($formulario['problema_aparelho'])):
                        Sessao::mensagem('servico','Preencha o campo problema','alert-danger');
                elseif(empty($formulario['problema_aparelho'])):
                        Sessao::mensagem('servico','Preencha o campo problema','alert-danger');

                        
                elseif($this->clienteModel->armazenar($dados)):
                    if(empty($dados['id_cliente'])):
                        $dados['id_cliente'] = $this->db->ultimoIdInserido();
                    endif;
                    
                    $this->servicoModel->armazenar($dados);
                    $id_servico = $this->db->ultimoIdInserido();
                    Sessao::mensagem('servico','Cliente e Serviço cadastrados com sucesso');
                    URL::redirecionar('servicos/infoServico/'.$id_servico.'');
                    $dados = [
                        'nome_cliente' => '',
                        'telefone_cliente' => '',
                        'endereco_cliente' => '',
                        'cpf_cnpj_cliente' => '',

                        'id_cliente' => '',
                        'aparelho_cliente' => "",
                        'marca_aparelho' => "",
                        'modelo_aparelho' => "",
                        'problema_aparelho' => "",
                        'data_entrada' => "",
                    ];
             
                endif;
                    
            else: 

                    Sessao::mensagem('servico','Erro ao cadastrar o cliente e serviço!','alert-danger');

           
        endif;

            endif;
        else:
            $dados = [
                'id_cliente' => "",
                'nome_cliente' => "",
                'telefone_cliente' => "",
                'endereco_cliente' => "",
                'cpf_cnpj_cliente' => "",

                'aparelho_cliente' => "",
                'marca_aparelho' => "",
                'modelo_aparelho' => "",
                'problema_aparelho' => "",
                'data_entrada' => "",
            ];
        endif;
        
        $info = [
            'clientes' => $this->clienteModel->lerClientes()
        ];
        
          $this->view('paginas/servicos/cadastrar',$dados, $info);
    } 

/* __________________________________________PEGANDO OS DADOS DO SERVIÇO E MOSTRANDO_________________________________ */
    public function infoServico($id){
        $dados = [
            'vendas' => $this->vendaModel->lerVendaServico($id),
        ];
        if($this->vendaModel->lerVendaServico($id)):
            foreach($dados['vendas'] as $vendas):
                $idVenda = $vendas->id_venda;
            endforeach;
        else:
            $idVenda = '';
        endif;
      
        $info = [
            'servico' => $this->servicoModel->lerServicoPorId($id),
            'produtos' => $this->produtoModel->lerProdutos(),
            'vendas' => $this->vendaModel->lerVendaServico($id),
            'idVenda' => $this->vendaModel->pegarIdVenda($id),
            'vendaProduto' => $this->vendaModel->produtosCompra($idVenda),
            'id_servio' => $id
        ];
        $this->view('paginas/servicos/infoServico',$dados,$info);
    }
   

    /* _____________________________FINALIZAR SERVIÇO_____________________________________________ */

    public function finalizarServico(){
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $dados = [
            'id_servico' => $formulario['id_servico'],
            'solucao_aparelho' => $formulario['solucao_aparelho'],
            'valor_servico' => $formulario['valor_servico'],
            'data_concerto' => trim(implode("-", array_reverse(explode("/",$formulario['data_concerto'])))),
            'total_pagar' => $formulario['total_pagar'],
            'id_venda' => $formulario['id_venda'],

            'valor_produtos' => $formulario['valor_produtos'],
            'desconto' => $formulario['desconto'],
            'situacao_aparelho' => '1'

        ];

        if(empty($dados['solucao_aparelho'])):
            Sessao::mensagem('servico','Preencha a solução do aparelho','alert-danger');
            URL::redirecionar('servicos/infoServico/'.$dados['id_servico']);
        elseif(empty($dados['valor_servico'])):
            Sessao::mensagem('servico','Preencha o valor do serviço','alert-danger');
            URL::redirecionar('servicos/infoServico/'.$dados['id_servico']);
        elseif(empty($dados['data_concerto'])):
            Sessao::mensagem('servico','Preencha o campo data do concerto','alert-danger');
            URL::redirecionar('servicos/infoServico/'.$dados['id_servico']);
        else:
            if($this->servicoModel->finalizaServico($dados)):
                $this->servicoModel->finalizaVendaServico($dados);
                Sessao::mensagem('servico','Serviço finalizado com sucesso!');
                URL::redirecionar('servicos/posServico/'.$dados['id_servico']);
            else:
                Sessao::mensagem('servico','Erro ao serviço finalizado com sucesso!','alert-danger');
            URL::redirecionar('servicos/infoServico/'.$dados['id_servico']);
            endif;
            

        endif;
    }
     /* _____________________________PÓS SERVIÇO_________________________________________________ */
     public function posServico($id = null){
        $dados = [
            'vendas' => $this->vendaModel->lerVendaServico($id),
        ];
        if($this->vendaModel->lerVendaServico($id)):
            foreach($dados['vendas'] as $vendas):
                $idVenda = $vendas->id_venda;
            endforeach;
        else:
            $idVenda = '';
        endif;
        
        $info = [
            'servico' => $this->servicoModel->lerServicoPorId($id),
            'produtos' => $this->produtoModel->lerProdutos(),
            'vendas' => $this->vendaModel->lerVendaServico($id),
            'idVenda' => $this->vendaModel->pegarIdVenda($id),
            'vendaProduto' => $this->vendaModel->produtosCompra($idVenda),
            'id_servio' => $id
        ];

        foreach($info['servico'] as $servico):
            if($servico->situacao_aparelho == '0'):
                Sessao::mensagem('servico','Esse serviço ainda não foi finalizado!','alert-danger');
                URL::redirecionar('servicos/infoServico/'.$id);
            else:
                $this->view('paginas/servicos/posServico',$dados,$info);
            endif;
        endforeach;
      
       
     }

    /* ____________________________ADICIONAR PRODUTO AO SERVIÇO___________________________________ */

    public function addProdutoServico(){
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $dados = [
            'quant_venda' => $formulario['quant_venda'],
            'id_produto' => $formulario['id_produto'],
            'id_venda' => $formulario['id_venda'],
            'id_cliente' => $formulario['id_cliente'],
            'id_servico' => $formulario['id_servico'],
            'data_compra' => $formulario['data_compra']
        ];

        if(!assert($dados['id_venda'])):
            $estoque = $this->produtoModel->lerProdutoPorId($dados['id_produto']);
            if($dados['quant_venda'] <= $estoque->quant_produto):
                $this->vendaModel->armazenarProdutoServico($dados);
                $dados['id_venda'] = $this->db->ultimoIdInserido();
                $this->vendaModel->venderProduto($dados);
                $total = $estoque->quant_produto - $dados['quant_venda'];
                $this->produtoModel->diminuirVenda($dados['id_produto'],$total);
                Sessao::mensagem('servico','Produto adicionado com sucesso!');
                URL::redirecionar('servicos/infoServico/'.$dados['id_servico'].'');
            else:
                URL::redirecionar('servicos/infoServico/'.$dados['id_servico'].'');
                Sessao::mensagem('servico','Quantidade superior ao do estoque','alert-danger');
            endif;
            
        else:
            
                $estoque = $this->produtoModel->lerProdutoPorId($dados['id_produto']);
                if($dados['quant_venda'] <= $estoque->quant_produto):
                    $venda = $this->vendaModel->buscaVendaServico($dados['id_servico']);
                    $dados['id_venda'] = $venda->id;  
                    $this->vendaModel->venderProduto($dados);
                    $total = $estoque->quant_produto - $dados['quant_venda'];
                    $this->produtoModel->diminuirVenda($dados['id_produto'],$total);
                    Sessao::mensagem('servico','Produto adicionado com sucesso!');
                    URL::redirecionar('servicos/infoServico/'.$dados['id_servico'].'');
                else:
                    URL::redirecionar('servicos/infoServico/'.$dados['id_servico'].'');
                    Sessao::mensagem('servico','Quantidade superior ao do estoque','alert-danger');
                endif;
                // $info = [
            //     'vendaServico' => $this->vendaModel->buscaVendaServico($dados['id_servico'])
            // ];
              // foreach($info['vendaServico'] as $vendas):
                //     $dados['id_venda'] = $vendas->id;
                   
                // endforeach;
           
        endif;
    }
    /* ________________MOSTRAR DADOS PARA EDITAR SERVIÇO____________________________________________________________ */
    public function editarServico($id){
        $dados = [
            'vendas' => $this->vendaModel->lerVendaServico($id),
        ];
        if($this->vendaModel->lerVendaServico($id)):
            foreach($dados['vendas'] as $vendas):
                $idVenda = $vendas->id_venda;
            endforeach;
        else:
            $idVenda = '';
        endif;
        
        $info = [
            'servico' => $this->servicoModel->lerServicoPorId($id),
            'produtos' => $this->produtoModel->lerProdutos(),
            'vendas' => $this->vendaModel->lerVendaServico($id),
            'idVenda' => $this->vendaModel->pegarIdVenda($id),
            'vendaProduto' => $this->vendaModel->produtosCompra($idVenda),
            'clientes' => $this->clienteModel->lerClientes(),
            'id_servio' => $id
        ];
      
         $this->view('paginas/servicos/editarServico',$dados,$info);
    }

    public function alterarDadosServico(){
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $dados = [
            'id_servico' => trim($formulario['id_servico']),
            'id_venda' => trim($formulario['id_venda']),
            'id_cliente' => trim($formulario['id_cliente']),
            'data_entrada' => trim(implode("-", array_reverse(explode("/",$formulario['data_entrada'])))),
            'data_saida' => trim(implode("-", array_reverse(explode("/",$formulario['data_saida'])))),
            'problema_aparelho' => trim($formulario['problema_aparelho']),
            'solucao_aparelho' => trim($formulario['solucao_aparelho']),
            'valor_servico' => trim($formulario['valor_servico']),
            'valor_produtos' => trim($formulario['valor_produtos']),
            'total_pagar' => trim($formulario['total_pagar']),
            'desconto' => trim($formulario['desconto']), 
            'situacao_aparelho' => trim($formulario['situacao_aparelho']), 
        ];

        if($this->servicoModel->alterarServico($dados)):
            Sessao::mensagem('servico','Serviço atualizado com sucesso!');
            URL::redirecionar('servicos/editarServico/'.$dados['id_servico']);
        endif;
    }
    /* ________________EXCLUIR PRODUTO DO SERVIÇO________________________________________________ */
    public function excluirProdutoServico(){
        $id_venda = (int) $_GET['id_venda'];
        $id_produto = (int) $_GET['id_produto'];
        $id_servico = (int) $_GET['id_servico'];

        $estoque = $this->produtoModel->lerProdutoPorId($id_produto);

        $venda_quant = $this->vendaModel->buscarProdutoDaVenda($id_venda, $id_produto);

        $total = $estoque->quant_produto + $venda_quant->quant_venda;

        if($this->vendaModel->excluirProdutoCompra($id_venda, $id_produto)):


            $this->produtoModel->adicionarEstoque($id_produto, $total);

            Sessao::mensagem('servico','Produto excluido do serviço com sucesso!');
            URL::redirecionar('servicos/infoServico/'.$id_servico.'');
        else:
            Sessao::mensagem('servico','Erro produto excluido da venda com sucesso!','alert-danger');
        endif;
    }

    /* ________________________________________EXCLUIR SERVIÇO______________________________________________________ */
    public function excluirServico(){

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if(isset($formulario)):
            $dados = [
                'id_servico' => $formulario['id_servico'],
                'id_produto' => $formulario['id_produto'],
                'quant_venda' => $formulario['quant_venda'],
                'id_venda' => $formulario['id_venda']
            ];

        if(!empty($dados['id_venda'])):
            if($this->servicoModel->deletarServico($dados['id_servico'])):
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
                  
                    Sessao::mensagem('servico','Serviço excluida com sucesso!');
                    URL::redirecionar('admins/home');
            else:
                    Sessao::mensagem('servico','Erro ao excluir o serviço','alert-dange');
                    URL::redirecionar('servicos/infoServico/'.$dados['id_servico'].'');
            endif;
    
        else:

            
            if($this->servicoModel->deletarServico($dados['id_servico'])):
                Sessao::mensagem('servico','Serviço excluida com sucesso!');
                URL::redirecionar('admins/home');
               
        else:
                Sessao::mensagem('servico','Erro ao excluir o serviço','alert-dange');
                URL::redirecionar('servicos/infoServico/'.$dados['id_servico'].'');
        endif;

          
        endif;
        
        
        

        endif;
    }

   
}