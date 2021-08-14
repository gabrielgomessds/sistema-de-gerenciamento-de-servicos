<?php


class Venda{
    private $db;

    public function __construct()
    {
        $this->db = new DataBase;
    }

    public function produtosCompra($idProduto){
        $this->db->query("SELECT *,
        produtos.id as produtosID,
        vendas_produtos.id as vendasProdutosID,
        vendas.id as vendasID
        FROM vendas INNER JOIN produtos INNER JOIN vendas_produtos ON 
        vendas.id = vendas_produtos.id_venda AND vendas_produtos.id_produto = produtos.id
        where id_venda = '".$idProduto."'
        order by  vendas.id desc ");


        return $this->db->resultados();
        
    }

    public function produtosComprados($idProduto){
        $this->db->query("SELECT *,
        produtos.id as produtosID,
        vendas_produtos.id as vendasProdutosID,
        vendas.id as vendasID
        FROM vendas INNER JOIN produtos INNER JOIN vendas_produtos ON 
        vendas.id = vendas_produtos.id_venda AND vendas_produtos.id_produto = produtos.id
        where id_venda = '".$idProduto."'
        order by  vendas.id desc LIMIT 1");


        return $this->db->resultados();
        
    }

    public function clienteCompra($idVenda){
        $this->db->query("SELECT *,
        clientes.id as clienteID,
        vendas.id_cliente as vendaCliente
        FROM vendas INNER JOIN clientes ON
        clientes.id = vendas.id_cliente
        WHERE vendas.id = '".$idVenda."'");
        if($this->db->executa()):
            return $this->db->resultados();
        else:
            return false;
        endif;
    }

    public function lerVendas(){
        $this->db->query("SELECT * FROM vendas");
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
    public function buscaVendaServico($id_servico){
        $this->db->query("SELECT * FROM vendas where id_servico = '".$id_servico."'");
        return $this->db->resultado();
    }

    public function lerVendasPorId($id){
        $this->db->query("SELECT * FROM vendas where id = '".$id."'");
        return $this->db->resultado();
       
    }

    public function buscarVendas(){
        $this->db->query("SELECT *,
        clientes.id as clientesID,
        vendas.id as VendaID
        FROM vendas INNER JOIN clientes ON 
        vendas.id_cliente = clientes.id
        order by vendas.id desc");
        
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

    public function clienteVendaID($id){
        $this->db->query("SELECT * FROM vendas where id_cliente = '".$id."'");
        return $this->db->resultados();
    }


    public function lerVendaServico($id){
        $this->db->query("SELECT *,
        vendas_produtos.id as produtosID,
        vendas.id as VendaID
        FROM vendas INNER JOIN vendas_produtos ON 
        vendas.id = vendas_produtos.id_venda AND vendas.id_servico = '".$id."'");
        
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

    public function pegarIdVenda($id){
        $this->db->query("SELECT * FROM vendas WHERE id_servico = '".$id."'");
        if($this->db->executa()):
            return $this->db->resultados();
        else:
            return false;
        endif;
       
    }

    public function armazenar($dados){
        $this->db->query("INSERT INTO vendas (id_cliente,data_compra) VALUES (:cliente,:dataCompra)");
        $this->db->bind("cliente", $dados['id_cliente']);
        $this->db->bind("dataCompra", $dados['data_compra']);

        if($this->db->executa()){
            return true;
        }else{
            return false;
        }

    }
    public function armazenarProdutoServico($dados){
        $this->db->query("INSERT INTO vendas (id_cliente,id_servico,data_compra) VALUES (:cliente,:servico,:dataCompra)");
        $this->db->bind("cliente", $dados['id_cliente']);
        $this->db->bind("servico", $dados['id_servico']);
        $this->db->bind("dataCompra", $dados['data_compra']);

        if($this->db->executa()){
            return true;
        }else{
            return false;
        }

    }

    public function buscarProdutoDaVenda($id_venda, $id_produto){
        $this->db->query('SELECT * FROM vendas_produtos WHERE id_produto = "'.$id_produto.'" AND id_venda = "'.$id_venda.'"');
        if($this->db->executa()){
            return $this->db->resultado();
        }else{
            return false;
        }
       
    }

    public function finalizaVenda($dados){
        $this->db->query("UPDATE vendas SET situacao = :situacao, valor_venda = :valor_venda, desconto = :valor_desconto, total_pagar = :valor_total WHERE id = :id_venda");
        $this->db->bind("id_venda",$dados['id_venda']);
        $this->db->bind("situacao",'1');
        $this->db->bind("valor_total",$dados['valor_total']);
        $this->db->bind("valor_venda",$dados['valor_venda']);
        $this->db->bind("valor_desconto",$dados['desconto']);

        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }
    public function atualizarVendaProduto($dados){
        $this->db->query("UPDATE vendas SET situacao = :situacao, id_cliente = :id_cliente, valor_venda = :valor_venda, desconto = :valor_desconto, total_pagar = :valor_total WHERE id = :id_venda");
        $this->db->bind("id_cliente",$dados['id_cliente']);
        $this->db->bind("id_venda",$dados['id_venda']);
        $this->db->bind("situacao",'1');
        $this->db->bind("valor_total",$dados['valor_total']);
        $this->db->bind("valor_venda",$dados['valor_venda']);
        $this->db->bind("valor_desconto",$dados['desconto']);

        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }
  
    
    public function venderProduto($dados){
        $this->db->query("INSERT INTO vendas_produtos (id_venda,id_cliente, id_produto, quant_venda)
        VALUES (:idVenda,:idCliente,:idProduto,:quantVenda)");
        $this->db->bind("idVenda", $dados['id_venda']);
        $this->db->bind("idCliente", $dados['id_cliente']);
        $this->db->bind("idProduto", $dados['id_produto']);
        $this->db->bind("quantVenda", $dados['quant_venda']);
        
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }


    public function excluirProdutoCompra($id_venda, $id_produto){
        $this->db->query("DELETE FROM vendas_produtos WHERE id_produto = :produto AND id_venda = :venda");
        $this->db->bind("venda", $id_venda);
        $this->db->bind("produto", $id_produto);
     
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }

    public function excluirVenda($id_venda){
        $this->db->query("DELETE FROM vendas WHERE id = :venda");
        $this->db->bind("venda", $id_venda);
      
     
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }

    public function excluirVendaProduto($id_venda){
        $this->db->query("DELETE FROM vendas_produtos WHERE id_venda = :venda");
        $this->db->bind("venda", $id_venda);
      
     
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }
}