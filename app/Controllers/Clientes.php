 <?php


class Clientes extends Controller{

    public function __construct()
    {
        $this->clienteModel = $this->model("Cliente");
        $this->servicoModel = $this->model("Servico");
        $this->vendaModel = $this->model("Venda");
    }

    /* ______________________________CADASTRAR CLIENTE______________________________________ */
    public function cadastrar(){
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(isset($formulario)):
            $dados = [
                'nome_cliente'     => trim($formulario['nome_cliente']),
                'telefone_cliente' => trim($formulario['telefone_cliente']),
                'endereco_cliente' => trim($formulario['endereco_cliente']),
                'cpf_cnpj_cliente' => trim($formulario['cpf_cnpj_cliente']),
            ];


                if(empty($formulario['nome_cliente']) or empty($formulario['telefone_cliente']) or empty($formulario['endereco_cliente'])):
                    if(empty($formulario['nome_cliente'])):
                        Sessao::mensagem('cliente','Preencha o campo nome','alert-danger');
                    endif;
                    if(empty($formulario['telefone_cliente'])):
                        Sessao::mensagem('cliente','Preencha o campo telefone','alert-danger');
                    endif;
                    if(empty($formulario['endereco_cliente'])):
                        Sessao::mensagem('cliente','Preencha o campo endereço','alert-danger');
                    endif;
                   
                else:                  
                    if($this->clienteModel->armazenar($dados)):
                        Sessao::mensagem('cliente','Cliente cadastrado com sucesso!');
                        $dados = [
                            'nome_cliente' => '',
                            'telefone_cliente' => '',
                            'endereco_cliente' => '',
                            'cpf_cnpj_cliente' => '',
                        ];
                    else:
                        Sessao::mensagem('cliente','Erro ao cadastrar o cliente!','alert-danger');
                    endif;

                endif;
           
        else:
            $dados = [
                'nome_cliente' => '',
                'telefone_cliente' => '',
                'endereco_cliente' => '',
                'cpf_cnpj_cliente' => '',
            ];

        endif;
       

        $this->view('paginas/clientes/cadastrar',$dados);
    }

    /* __________________PEGAR INFORMAÇÕES DO CLIENTE___________________________________________ */

    public function infoCliente($id){
        $cliente = $this->clienteModel->lerClientePorId($id);
        $dados = [
                'id'     => $cliente->id,
                'nome_cliente'     => $cliente->nome_cliente,
                'telefone_cliente' => $cliente->telefone_cliente,
                'endereco_cliente' => $cliente->endereco_cliente,
                'cpf_cnpj_cliente' => $cliente->cpf_cnpj_cliente,
        ];
        $this->view('paginas/clientes/infoCliente', $dados);
    }

    /* __________________MOSTRAR OS SERVIÇOS FEITOS PARA ESSE CLIENTE___________________________________________ */

    public function servicosCliente($idCliente){
        $dados = [
                'id'     => $idCliente,
                'servico' => $this->servicoModel->servicosCliente($idCliente),
                'cliente' => $this->clienteModel->clienteServicoID($idCliente),
                 
        ];
        $this->view('paginas/clientes/servicosCliente', $dados);
    }
    /* __________________MOSTRAR OS VENDAS FEITOS PARA ESSE CLIENTE___________________________________________ */

    public function comprasCliente($idCliente){
        $dados = [
                'id'     => $idCliente,
                'venda' => $this->vendaModel->clienteVendaID($idCliente),
                'cliente' => $this->clienteModel->clienteServicoID($idCliente),
                 
        ];
        $this->view('paginas/clientes/comprasCliente', $dados);
    }


/* ______________________EDITAR DADOS DO CLIENTE___________________________________________ */

    public function editar($id){
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
        if(isset($formulario)):
            $dados = [
                'id' => $id,
                'nome_cliente' => trim($formulario['nome_cliente']),
                'telefone_cliente' => trim($formulario['telefone_cliente']),
                'endereco_cliente' => trim($formulario['endereco_cliente']),
                'cpf_cnpj_cliente' => trim($formulario['cpf_cnpj_cliente']),
            ];

            if(empty($formulario['nome_cliente']) or empty($formulario['telefone_cliente']) or empty($formulario['endereco_cliente'])):
            
                if(empty($formulario['nome_cliente'])):
                    Sessao::mensagem('cliente','Preencha o campo nome','alert-danger');
                endif;

                if(empty($formulario['telefone_cliente'])):
                    Sessao::mensagem('cliente','Preencha o campo telefone','alert-danger');
                endif;

                if(empty($formulario['endereco_cliente'])):
                    Sessao::mensagem('cliente','Preencha o campo endereço','alert-danger');
                 endif;

               
            else:
                    if($this->clienteModel->atualizarCliente($dados)):
                        Sessao::mensagem('cliente','Cliente atualizado com sucesso!');
                        $cliente = $this->clienteModel->lerClientePorId($id);
                        $dados = [
                            'nome_cliente' => $cliente->nome_cliente,
                            'telefone_cliente' => $cliente->telefone_cliente,
                            'endereco_cliente' => $cliente->endereco_cliente,
                            'cpf_cnpj_cliente' => $cliente->cpf_cnpj_cliente,
                        ];
                    else:
                        Sessao::mensagem('cliente','Erro ao atualizar o cliente!','alert-danger');
                    endif;
                   
                
        endif;
        else:

            $cliente = $this->clienteModel->lerClientePorId($id);


            $dados = [
                'id' => $cliente->id,
                'nome_cliente' => $cliente->nome_cliente,
                'telfone_cliente' => $cliente->telefone_cliente,
                'endereco_cliente' => $cliente->endereco_cliente,
                'cpf_cnpj_cliente' => $cliente->cpf_cnpj_cliente,
                'mensagem_erro' => '',
            ];
        endif;   

        $this->view('paginas/clientes/infoCliente', $dados);
    }


    /* ____________________EXCLUIR CLIENTE__________________________________________ */
    public function excluir($id){
        if($this->clienteModel->excluir($id)):
            Sessao::mensagem('cliente','Cliente excluido com sucesso!');
            URL::redirecionar('admins/home');
        else:
            die('Erro ao tentar excluir o cliente!');
        endif;
    }


} 


