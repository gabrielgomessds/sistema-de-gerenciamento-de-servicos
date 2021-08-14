<?php


 class Cliente{
    private $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function lerClientes(){
        $this->db->query("SELECT * FROM clientes order by id desc");
        
        if($this->db->executa()):
            if($this->db->totalResultados() > 0):
                return $this->db->resultados();
            else:
                return false;
            endif;
        else:
            return false;
        endif;
    }
    public function lerClientePorId($id){
        $this->db->query("SELECT * FROM clientes where id = '".$id."'");
        return $this->db->resultado();
    }
    public function clienteServicoID($id){
        $this->db->query("SELECT * FROM clientes where id = '".$id."'");
        return $this->db->resultados();
    }

    public function armazenar($dados){
        $this->db->query("INSERT INTO clientes (nome_cliente, telefone_cliente, endereco_cliente, cpf_cnpj_cliente) VALUES (:nome, :telefone, :endereco, :cpf)");
        $this->db->bind("nome", $dados['nome_cliente']);
        $this->db->bind("telefone", $dados['telefone_cliente']);
        $this->db->bind("endereco", $dados['endereco_cliente']);
        
        if(empty($dados['cpf_cnpj_cliente'])):
            $this->db->bind("cpf", 'Não informado');
        else:
            $this->db->bind("cpf", $dados['cpf_cnpj_cliente']);
        endif;
      
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }

    public function atualizarCliente($dados){
        $this->db->query("UPDATE clientes SET nome_cliente = :nome, telefone_cliente = :telefone,
         endereco_cliente = :endereco, cpf_cnpj_cliente = :cpf_cnpj WHERE id = :id");
        $this->db->bind("id",       $dados['id']);
        $this->db->bind("nome",     $dados['nome_cliente']);
        $this->db->bind("telefone", $dados['telefone_cliente']);
        $this->db->bind("endereco", $dados['endereco_cliente']);
        $this->db->bind("cpf_cnpj", $dados['cpf_cnpj_cliente']);
     
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }

    public function excluir($id){
        $this->db->query("DELETE FROM clientes WHERE id = :id");
        $this->db->bind("id", $id);
     
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }

  

} 