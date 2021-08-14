<?php

class Admins extends Controller{

    public function __construct()
    {
        $this->adminModel = $this->model("Admin");
        $this->clienteModel = $this->model("Cliente");
        $this->servicoModel = $this->model("Servico");
        $this->produtoModel = $this->model("Produto");
        $this->vendaModel = $this->model("Venda");
        
    }
    /* ___________MOSTRAR DADOS NA HOME DO ADM__________________________________ */
    public function home(){
        $dados = [
            'admins' =>   $this->adminModel->lerAdmins(),
            'clientes' => $this->clienteModel->lerClientes(),
            'servicos' => $this->servicoModel->lerServicos(),
            'produtos' => $this->produtoModel->lerProdutos(),
            'vendas' => $this->vendaModel->buscarVendas(),
            'meusDados' => $this->adminModel->meusDados($_SESSION['id'])
        ];

      
    
        $this->view('paginas/admins/home', $dados);
      
    }
/* ___________________CADASTRAR NOVO ADM_____________________________ */
    public function cadastrar(){
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(isset($formulario)):
            $dados = [
                'nome_admin' => trim($formulario['nome_admin']),
                'email_admin' => trim($formulario['email_admin']),
                'senha_admin' => trim($formulario['senha_admin']),
                'confirmar_senha_admin' => trim($formulario['confirmar_senha_admin']),
            ];

            if(in_array("", $formulario)):
            
                if(empty($formulario['nome_admin'])):
                    Sessao::mensagem('admin','Preencha o campo nome','alert-danger');
                endif;

                if(empty($formulario['email_admin'])):
                    Sessao::mensagem('admin','Preencha o campo email','alert-danger');
                endif;

                if(empty($formulario['senha_admin'])):
                    Sessao::mensagem('admin','Preencha o campo senha','alert-danger');
                 endif;

                if(empty($formulario['confirmar_senha_admin'])):
                    Sessao::mensagem('admin','Preencha o campo confirmar senha','alert-danger');
                 endif;
               
            else:
              if(Checa::checaEmail($formulario['email_admin'])):
                    Sessao::mensagem('admin','O e-mail informado é inválido','alert-danger');
                
                elseif($this->adminModel->checarEmail($formulario['email_admin'])):
                    Sessao::mensagem('admin','O e-mail informado já foi cadastrado','alert-danger');
                elseif(strlen($formulario['senha_admin']) < 6):
                    Sessao::mensagem('admin','A senha precisa ter pelo menos 6 caracteres','alert-danger');
               
                elseif($formulario['senha_admin'] != $formulario['confirmar_senha_admin']):
                    Sessao::mensagem('admin','As senhas são diferentes','alert-danger');
                else:
                    if($this->adminModel->armazenar($dados)):
                        Sessao::mensagem('admin','Admin cadastrado com sucesso!');
                        $dados = [
                            'nome_admin' => '',
                            'email_admin' => '',
                            'senha_admin' => '',
                            'confirmar_senha_admin' => '',
                        ];
                    else:
                        Sessao::mensagem('admin','Erro ao cadastrar o admin!','alert-danger');
                    endif;
                   
                endif;
        endif;
        else:
            $dados = [
                'nome_admin' => '',
                'email_admin' => '',
                'senha_admin' => '',
                'confirmar_senha_admin' => '',
                'mensagem_erro' => '',
            ];
        endif;   
        $this->view('paginas/admins/cadastrar', $dados);
    }

    /* ____________________EDITAR DADOS DE OUTRO ADM__________________________________________________ */
    public function editar($id){
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
        if(isset($formulario)):
            $dados = [
                'id' => $id,
                'nome_admin' => trim($formulario['nome_admin']),
                'email_admin' => trim($formulario['email_admin']),
                'senha_admin' => trim($formulario['senha_admin']),
                'confirmar_senha_admin' => trim($formulario['confirmar_senha_admin']),
            ];

            if(in_array("", $formulario)):
            
                if(empty($formulario['nome_admin'])):
                    Sessao::mensagem('admin','Preencha o campo nome','alert-danger');
                endif;

                if(empty($formulario['email_admin'])):
                    Sessao::mensagem('admin','Preencha o campo email','alert-danger');
                endif;

                if(empty($formulario['senha_admin'])):
                    Sessao::mensagem('admin','Preencha o campo senha','alert-danger');
                 endif;

                if(empty($formulario['confirmar_senha_admin'])):
                    Sessao::mensagem('admin','Preencha o campo confirmar senha','alert-danger');
                 endif;
               
            else:
              if(Checa::checaEmail($formulario['email_admin'])):
                    Sessao::mensagem('admin','O e-mail informado é inválido','alert-danger');
                elseif(strlen($formulario['senha_admin']) < 6):
                    Sessao::mensagem('admin','A senha precisa ter pelo menos 6 caracteres','alert-danger');
               
                elseif($formulario['senha_admin'] != $formulario['confirmar_senha_admin']):
                    Sessao::mensagem('admin','As senhas são diferentes','alert-danger');
                else:
                    if($this->adminModel->atualizarAdmin($dados)):
                        Sessao::mensagem('admin','Admin atualizado com sucesso!');
                        $admin = $this->adminModel->lerAdminsPorId($id);
                        $dados = [
                            'nome_admin' => $admin->nome,
                            'email_admin' => $admin->email,
                            'senha_admin' => $admin->senha,
                            'confirmar_senha_admin' => '',
                        ];
                    else:
                        Sessao::mensagem('admin','Erro ao atualizar o admin!','alert-danger');
                    endif;
                   
                endif;
        endif;
        else:

            $admin = $this->adminModel->lerAdminsPorId($id);


            $dados = [
                'id' => $admin->id,
                'nome_admin' => $admin->nome,
                'email_admin' => $admin->email,
                'senha_admin' => $admin->senha,
                'confirmar_senha_admin' => '',
                'mensagem_erro' => '',
            ];
        endif;   

        $this->view('paginas/admins/editar', $dados);
    }


    /* ___________________EDITAR DADOS DA CONTA__________________________________ */

    public function editarConta($id){
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        if(isset($formulario)):
            $dados = [
                'id' => $id,
                'nome_admin' => trim($formulario['nome_admin']),
                'email_admin' => trim($formulario['email_admin']),
                'senha_admin' => trim($formulario['senha_admin']),
                'confirmar_senha_admin' => trim($formulario['confirmar_senha_admin']),
                'foto_admin' => ''
            ];

            $admin = $this->adminModel->lerAdminsPorId($id);
            
            $upload = $this->salvarFoto($_FILES, $admin->id);

            var_dump($_FILES);

                if(empty($_FILES['foto_admin']['tmp_name'])):
                    $dados['foto_admin'] = $admin->foto;
                else:
                    if(gettype($upload) == "string"):
                        $dados['foto_admin'] = $upload;
                    endif;
                endif;
                

            if(in_array("", $formulario)):
            
                if(empty($formulario['nome_admin'])):
                    Sessao::mensagem('conta','Preencha o campo nome','alert-danger');
                endif;

                if(empty($formulario['email_admin'])):
                    Sessao::mensagem('conta','Preencha o campo email','alert-danger');
                endif;

                if(empty($formulario['senha_admin'])):
                    Sessao::mensagem('conta','Preencha o campo senha','alert-danger');
                 endif;

                if(empty($formulario['confirmar_senha_admin'])):
                    Sessao::mensagem('conta','Preencha o campo confirmar senha','alert-danger');
                 endif;
               
            else:
              if(Checa::checaEmail($formulario['email_admin'])):
                    Sessao::mensagem('conta','O e-mail informado é inválido','alert-danger');
                elseif(strlen($formulario['senha_admin']) < 6):
                    Sessao::mensagem('conta','A senha precisa ter pelo menos 6 caracteres','alert-danger');
               
                elseif($formulario['senha_admin'] != $formulario['confirmar_senha_admin']):
                    Sessao::mensagem('conta','As senhas são diferentes','alert-danger');
                else:
                    if($this->adminModel->atualizarConta($dados)):
                        Sessao::mensagem('conta','Conta atualizado com sucesso!');
                        $admin = $this->adminModel->lerAdminsPorId($id);
                    else:
                        Sessao::mensagem('conta','Erro ao atualizar o admin!','alert-danger');
                    endif;
                   
                endif;
        endif;
        else:

            $admin = $this->adminModel->lerAdminsPorId($id);


            $dados = [
                'id' => $admin->id,
                'nome_admin' => $admin->nome,
                'email_admin' => $admin->email,
                'senha_admin' => $admin->senha,
                'confirmar_senha_admin' => '',
                'mensagem_erro' => '',
            ];
        endif;   

        URL::redirecionar('admins/home');
    }



    /* _______________________________ADM FAZER LOGIN___________________________________ */

    public function login(){
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(isset($formulario)):
            if(isset($formulario['manter_logado'])):
                $dados = [
                    'email_admin' => trim($formulario['email_admin']),
                    'senha_admin' => trim($formulario['senha_admin']),
                    'manter_logado' => trim($formulario['manter_logado']),
                ];
            else:   
                $dados = [
                    'email_admin' => trim($formulario['email_admin']),
                    'senha_admin' => trim($formulario['senha_admin']),
                ];
            endif;
            

            if(in_array("", $formulario)):
            

                if(empty($formulario['email_admin'])):
                    Sessao::mensagem('admin','Preencha o campo e-mail','alert-danger');
                endif;

                if(empty($formulario['senha_admin'])):
                    Sessao::mensagem('admin','Preencha o campo senha','alert-danger');
                 endif;
               
            else:
              if(Checa::checaEmail($formulario['email_admin'])):
                    Sessao::mensagem('admin','O e-mail informado é inválido','alert-danger');
                else:
                    $admin = $this->adminModel->checarLogin($formulario['email_admin'], $formulario['senha_admin']);
                   if($admin):
                        $this->criarSessao($admin);
                        /* if(isset($formulario['manter_logado'])):
                            $this->adminModel->manterLogado($formulario['email_admin'], $formulario['manter_logado']);
                            $this->criarSessaoCookie($admin);
                        else:
                            $this->adminModel->manterLogado($formulario['email_admin'], $formulario['manter_logado']);
                            $this->criarSessao($admin);
                        endif; */
                   else:
                       Sessao::mensagem('admin','E-mail ou senha inválidos','alert-danger');
                    
                   endif;
                endif;
        endif;
        else:
            $dados = [
                'email_admin' => '',
                'senha_admin' => '',
                'manter_logado' => '',
                'mensagem_erro' => '',
            ];
        endif;   
        $this->view('paginas/admins/login', $dados);

      
    }
     

/* ____________________________ENVIAR IMAGEM DE PERFIL______________________________________ */

    private function salvarFoto($foto, $idAdmin){
      /*   $fotos = $_FILES['foto_admin']; */
        $fotoDir = "/public/img_user/fotos_admins/";
        $extensao = strtolower(substr($foto['foto_admin']['name'], -4));
        $fotoNome = md5(time()) .".". $extensao;
        
        $fotoPath = dirname(dirname(__DIR__)).$fotoDir.$fotoNome;
        $fotoTmp = $foto['foto_admin']['tmp_name'];

        if($foto['foto_admin']['type'] == '' or $foto['foto_admin']['type'] == 'image/jpeg' or $foto['foto_admin']['type'] == 'image/png' or $foto['foto_admin']['type'] == 'image/jpg'):
            if(move_uploaded_file($fotoTmp, $fotoPath)):
                return $fotoNome;
            else:
                return false;
            endif;
        else:
            
            Sessao::mensagem('conta','O formato enviado não é aceito','alert-danger');
            $admin = $this->adminModel->lerAdminsPorId($idAdmin);
            return $admin->foto;
            URL::redirecionar('admins/home');
        endif;
        
    }
    
    /*______________EXCLUIR FOTO DE PERFIL_______________________  */

    public function excluirFoto($id){
        $admin = $this->adminModel->lerAdminsPorId($id);
        unlink(dirname(dirname(__DIR__)).'/public/img_user/fotos_admins/'.$admin->foto);
        if($this->adminModel->excluirImagem($id)):
            Sessao::mensagem('conta','Foto excluida com sucesso!');
            URL::redirecionar('admins/home');
        endif;
    }


  /* ___________________________EXCLUIR ADMIN DO BANCO__________________________________ */
    public function deletarAdmin(){
        $id = (int) $_GET['id_admin'];

        if($this->adminModel->excluir($id)):
            Sessao::mensagem('admin','Admin excluido com sucesso!');
            URL::redirecionar('admins/home');
        else:
            die('Erro ao tentar excluir o admin!');
        endif;
    }

    /* ______________CRIAR SESSÃO______________________________________________________________ */

    private function criarSessao($admin){
        $_SESSION['id'] = $admin->id;
        $_SESSION['nome'] = $admin->nome;
        $_SESSION['email'] = $admin->email;
        $_SESSION['acesso'] = $admin->acesso;


        URL::redirecionar('admins/home');
    }

  /*   private function criarSessaoCookie($admin){
      
        $_SESSION['id'] = $admin->id;
        $_SESSION['nome'] = $admin->nome;
        $_SESSION['email'] = $admin->email;
        $_SESSION['acesso'] = $admin->acesso;
        setcookie('acesso', $_SESSION['acesso'], time() + (30 * 24 * 3600), "/");
        URL::redirecionar('paginas/home');
        
        
      
    }

    public function fazLogin($email, $senha){
        $admin = $this->adminModel->checarLogin($email, $senha);
        if($admin):
             $this->criarSessao($admin);
        else:
            URL::redirecionar('paginas/login');
        endif;
    } */



    /* ___________________________SAIR______________________________________________________ */
    public function Sair(){
       /*  setcookie("acesso","",time()-3600,"/");
        $this->adminModel->manterLogado($_SESSION['email'], 'no');
         */
        unset($_SESSION['id']);
        unset($_SESSION['nome']);
        unset($_SESSION['email']);
        unset($_SESSION['acesso']);

      
       /*  unset($_COOKIE['acesso']); */
        session_destroy(); 
        

        URL::redirecionar('paginas/login');
    }

  

}