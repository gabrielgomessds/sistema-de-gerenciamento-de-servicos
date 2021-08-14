<?php


class Produto{

    private $db;

    public function __construct()
    {
        $this->db = new DataBase;
    }

      
    public function lerProdutos(){
        $this->db->query("SELECT * FROM produtos order by id desc");
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
    public function lerProdutoPorId($id){
        $this->db->query("SELECT * FROM produtos where id = '".$id."'");
        return $this->db->resultado();
    }

    // public function lerVariosProdutoPorId($id_produto){
    //     foreach($id_produto as $produto):
    //         $this->db->query("SELECT * FROM produtos where id IN ('".$produto."')");
    //     endforeach;
    //     return $this->db->resultados();
    // }
    public function lerVariosProdutoPorId($id_produto){
        $this->db->query("SELECT * FROM produtos where id IN ('".$id_produto."')");
        return $this->db->resultado();
  
}

    public function lerVariosProdutoPorId2($id_produto){
            $this->db->query("SELECT * FROM vendas_produtos where id IN ('".$id_produto."')");
            return $this->db->resultado();
      
    }


    public function armazenar($dados){
        $this->db->query("INSERT INTO produtos (nome_produto, marca_produto, modelo_produto, quant_produto, preco_produto, descricao_produto)
         VALUES (:nome, :marca, :modelo, :quant, :preco, :descricao)");
        $this->db->bind("nome", $dados['nome_produto']);
        $this->db->bind("marca", $dados['marca_produto']);
        $this->db->bind("quant", $dados['quant_produto']);
        $this->db->bind("preco", $dados['preco_produto']);
        $this->db->bind("descricao", $dados['descricao_produto']);

        if(empty($dados['modelo_produto'])):
            $this->db->bind("modelo", 'Não informado');
        else:
            $this->db->bind("modelo", $dados['modelo_produto']);
        endif;
      
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }

    public function atualizarProduto($dados){
        $this->db->query("UPDATE produtos SET nome_produto = :nome, marca_produto = :marca, modelo_produto = :modelo,
        quant_produto = :quant, preco_produto = :preco, descricao_produto = :descricao WHERE id = :id");

        $this->db->bind("id",$dados['id']);
        $this->db->bind("nome",$dados['nome_produto']);
        $this->db->bind("marca",$dados['marca_produto']);
        $this->db->bind("modelo",$dados['modelo_produto']);
        $this->db->bind("quant",$dados['quant_produto']);
        $this->db->bind("preco",$dados['preco_produto']);
        $this->db->bind("descricao",$dados['descricao_produto']);

        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }

    public function adicionarEstoque($id, $total){
        $this->db->query("UPDATE produtos SET quant_produto = :quant WHERE id = :id");
        $this->db->bind("id",$id);
        $this->db->bind("quant",$total);

        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }

    
    public function diminuirVenda($id, $total){
        $this->db->query("UPDATE produtos SET quant_produto = :quant WHERE id = :id");
        $this->db->bind("id",$id);
        $this->db->bind("quant",$total);

        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }

    public function ajustarEstoque($reajuste){
        foreach($reajuste as $key => $ajustando):
            $this->db->query("UPDATE produtos SET quant_produto = '".$ajustando."' WHERE id = '".$key."'");
            $this->db->bind("id",$key);
            $this->db->executa();
        endforeach;

    }

  
    public function deletarProduto($idProduto){
        $this->db->query("DELETE FROM produtos WHERE id = :produto");
        $this->db->bind("produto", $idProduto);

        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }


}