<?php

class Admin {
    private $db;

    public function __construct()
    {
        $this->db = new DataBase;
    }

    public function lerAdmins(){
        $this->db->query("SELECT * FROM admins order by id desc");
        
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

    public function meusDados($id){
        $this->db->query("SELECT * FROM admins where id = :id");
        $this->db->bind("id", $id);
        return $this->db->resultados();
    }
    
    
    public function lerAdminsPorId($id){
        $this->db->query("SELECT * FROM admins where id = ".$id."");
        return $this->db->resultado();
    }

    public function checarEmail($email){
        $this->db->query("SELECT email FROM admins where email = :email_admin");
        $this->db->bind("email_admin",$email);

        if($this->db->resultado()):
            return true;
        else:
            return false;
        endif;
    }

    public function armazenar($dados){
        $this->db->query("INSERT INTO admins (nome, email, senha) VALUES (:nome, :email, :senha)");
        $this->db->bind("nome", $dados['nome_admin']);
        $this->db->bind("email", $dados['email_admin']);
        $this->db->bind("senha", $dados['senha_admin']);
      
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }

    public function atualizarAdmin($dados){
        $this->db->query("UPDATE admins SET nome = :nome, email = :email, senha = :senha WHERE id = :id");
        $this->db->bind("id", $dados['id']);
        $this->db->bind("nome", $dados['nome_admin']);
        $this->db->bind("email", $dados['email_admin']);
        $this->db->bind("senha", $dados['senha_admin']);
     
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }
    public function excluirImagem($id){
        $this->db->query("UPDATE admins SET foto = '' WHERE id = :id");
        $this->db->bind("id", $id);
     
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }
    public function atualizarConta($dados){
        $this->db->query("UPDATE admins SET nome = :nome, email = :email, senha = :senha, foto = :foto WHERE id = :id");
        $this->db->bind("id", $dados['id']);
        $this->db->bind("nome", $dados['nome_admin']);
        $this->db->bind("email", $dados['email_admin']);
        $this->db->bind("senha", $dados['senha_admin']);
        $this->db->bind("foto", $dados['foto_admin']);
     
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }

    public function checarLogin($email, $senha){
        $this->db->query("SELECT * FROM admins where email = :email_admin and senha = :senha_admin");
        $this->db->bind("email_admin",$email);
        $this->db->bind("senha_admin",$senha);

        if($this->db->resultado()):
            $resultado = $this->db->resultado();
            return $resultado;
        else:
            return false;
        endif;
    }

    public function excluir($id){
        $this->db->query("DELETE FROM admins WHERE id = :id");
        $this->db->bind("id", $id);
     
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }




 /*    public function manterLogado($email, $manter){
        $this->db->query("UPDATE admins SET manter_logado = '".$manter."' where email = :email");
        $this->db->bind("email",$email);
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }
 */

}