<?php


class Produtos extends Controller{

    public function __construct()
    {
        $this->produtoModel = $this->model("Produto");
    }

    /* _____________________________________________--Cadastrar Produto--__________________________________________________________________________ */

    public function cadastrar(){
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(isset($formulario)):
            $dados = [
                'nome_produto'     => trim($formulario['nome_produto']),
                'marca_produto'    => trim($formulario['marca_produto']),
                'modelo_produto'   => trim($formulario['modelo_produto']),
                'quant_produto'    => trim($formulario['quant_produto']),
                'preco_produto'    => trim(str_replace(",",".",$formulario['preco_produto'])),
                'descricao_produto'=> trim($formulario['descricao_produto']),
            ];


                if(empty($formulario['nome_produto']) or empty($formulario['marca_produto']) or empty($formulario['quant_produto']) or empty($formulario['preco_produto']) or empty($formulario['descricao_produto']) ):
                    
                    if(empty($formulario['nome_produto'])):
                        Sessao::mensagem('produto','Preencha o campo nome','alert-danger');
                    endif;
                    if(empty($formulario['marca_produto'])):
                        Sessao::mensagem('produto','Preencha o campo marca','alert-danger');
                    endif;
                    if(empty($formulario['quant_produto'])):
                        Sessao::mensagem('produto','Preencha o campo quantidade','alert-danger');
                    endif;
                    if(empty($formulario['descricao_produto'])):
                        Sessao::mensagem('produto','Preencha o campo descrição','alert-danger');
                    endif;
                   
                else:                  
                    if($this->produtoModel->armazenar($dados)):
                        Sessao::mensagem('produto','Produto cadastrado com sucesso!');
                        $dados = [
                            'nome_produto'     => '',
                            'marca_produto'    => '',
                            'modelo_produto'   => '',
                            'quant_produto'    => '',
                            'preco_produto'    => '',
                            'descricao_produto'=> '',
                        ];
                    else:
                        Sessao::mensagem('produto','Erro ao cadastrar o produto!','alert-danger');
                    endif;

                endif;
           
        else:
            $dados = [
                'nome_produto'     => '',
                'marca_produto'    => '',
                'modelo_produto'   => '',
                'quant_produto'    => '',
                'preco_produto'    => '',
                'descricao_produto'=> '',
            ];

        endif;
       
        $this->view('paginas/produtos/cadastrar',$dados);
    }

    /* __________________________________________________--Buscar produto por ID--________________________________________________________________________ */

    public function infoProduto($id){
        $produto = $this->produtoModel->lerProdutoPorId($id);
        $dados = [
                'id'     => $produto->id,
                'nome_produto'     => $produto->nome_produto,
                'marca_produto' => $produto->marca_produto,
                'modelo_produto' => $produto->modelo_produto,
                'quant_produto' => $produto->quant_produto,
                'preco_produto' => $produto->preco_produto,
                'descricao_produto' => $produto->descricao_produto,
        ];
        $this->view('paginas/produtos/infoProduto', $dados);
    }


    /* ____________________________________________________--Editar Produto--_______________________________________________________________________ */

    public function editar($id){
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        if(isset($formulario)):
            $dados = [
                'id'     => $id,
                'nome_produto'     => trim($formulario['nome_produto']),
                'marca_produto'    => trim($formulario['marca_produto']),
                'modelo_produto'   => trim($formulario['modelo_produto']),
                'quant_produto'    => trim($formulario['quant_produto']),
                'preco_produto'    => trim(str_replace(",",".",$formulario['preco_produto'])),
                'descricao_produto'=> trim($formulario['descricao_produto']),
            ];


                if(empty($formulario['nome_produto']) or empty($formulario['marca_produto']) or empty($formulario['quant_produto']) or empty($formulario['preco_produto']) or empty($formulario['descricao_produto']) ):
                    
                    if(empty($formulario['nome_produto'])):
                        Sessao::mensagem('produto','Preencha o campo nome','alert-danger');
                    endif;
                    if(empty($formulario['marca_produto'])):
                        Sessao::mensagem('produto','Preencha o campo marca','alert-danger');
                    endif;
                    if(empty($formulario['quant_produto'])):
                        Sessao::mensagem('produto','Preencha o campo quantidade','alert-danger');
                    endif;
                    if(empty($formulario['descricao_produto'])):
                        Sessao::mensagem('produto','Preencha o campo descrição','alert-danger');
                    endif;
                   

               
            else:
                    if($this->produtoModel->atualizarProduto($dados)):
                        Sessao::mensagem('produto','Produto atualizado com sucesso!');
                        $produto = $this->produtoModel->lerProdutoPorId($id);
                        // $dados = [
                        //     'nome_produto' => $produto->nome_produto,
                        //     'marca_produto' => $produto->marca_produto,
                        //     'modelo_produto' => $produto->modelo_produto,
                        //     'quant_produto' => $produto->quant_produto,
                        //     'preco_produto' => $produto->preco_produto,
                        //     'descricao_produto' => $produto->descricao_produto,
                        // ];
                    else:
                        Sessao::mensagem('produto','Erro ao atualizar o produto!','alert-danger');
                    endif;
                   
                
        endif;
        else:

            $produto = $this->produtoModel->lerProdutoPorId($id);


            $dados = [
                'id' => $produto->id,
                'nome_produto' => $produto->nome_produto,
                'marca_produto' => $produto->marca_produto,
                'modelo_produto' => $produto->modelo_produto,
                'quant_produto' => $produto->quant_produto,
                'preco_produto' => $produto->preco_produto,
                'descricao_produto' => $produto->descricao_produto,
                'mensagem_erro' => '',
            ];
        endif;   

        $this->view('paginas/produtos/infoProduto', $dados);
    }

    /* ______________________________________________________--Adicionar ao estoque_____________________________________________________________________ */

    public function addEstoque($id){
        $quant_venda = $_GET['add_quant'];
        if(empty($quant_venda)):
            Sessao::mensagem('produto','O campo adicionar estoque não pode estar vazio','alert-danger');
            URL::redirecionar('produtos/infoProduto/'.$id.'');
        else:
            $quant_produto = $this->produtoModel->lerProdutoPorId($id);
            $total = $quant_produto->quant_produto + $quant_venda;

            if($this->produtoModel->adicionarEstoque($id,$total)):
                Sessao::mensagem('produto','Adicionado ao estoque com sucesso!');
                URL::redirecionar('produtos/infoProduto/'.$id.'');
            else:
                Sessao::mensagem('produto','Erro ao adicionar estoque','alert-danger');
                URL::redirecionar('produtos/infoProduto/'.$id.'');
            endif;
        endif;

    }

    /* _______________________________________________________--Excluir Produto--___________________________________________________________________ */

    public function excluirProduto($id){
        if($this->produtoModel->deletarProduto($id)):
            Sessao::mensagem('produto','Produto excluido com sucesso!');
            URL::redirecionar('admins/home');
        else:
            die('Erro ao tentar excluir o produto!');
        endif;
    }
    
    
}