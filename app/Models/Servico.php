<?php


class Servico{

    private $db;

    public function __construct()
    {
        $this->db = new DataBase;
    }

    public function armazenar($dados){
        $this->db->query("INSERT INTO servicos (id_cliente,aparelho_cliente, marca_aparelho,modelo_aparelho, problema_aparelho,data_entrada) VALUES (:id_cliente, :aparelho_cliente, :marca_aparelho,:modelo_aparelho,:problema_aparelho,:data_entrada)");
        $this->db->bind("id_cliente", $dados['id_cliente']);
        $this->db->bind("aparelho_cliente", $dados['aparelho_cliente']);
        $this->db->bind("marca_aparelho", $dados['marca_aparelho']);
        $this->db->bind("modelo_aparelho", $dados['modelo_aparelho']);
        $this->db->bind("problema_aparelho", $dados['problema_aparelho']);
        $this->db->bind("data_entrada", $dados['data_entrada']);
      
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }

    public function lerServicos(){
        $this->db->query("SELECT *,
        clientes.id as clientesID,
        servicos.id as ServicoID
        FROM servicos INNER JOIN clientes ON 
        servicos.id_cliente = clientes.id
        order by servicos.id desc");
        
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

    public function lerServicoPorId($id){
        $this->db->query("SELECT *,
        clientes.id as clientesID,
        servicos.id as ServicoID
        FROM servicos INNER JOIN clientes ON 
        servicos.id_cliente = clientes.id AND servicos.id = '".$id."'
        order by servicos.id desc");
        return $this->db->resultados();
    }

    public function servicosCliente($id){
        $this->db->query("SELECT *,
        clientes.id as clientesID,
        servicos.id as ServicoID
        FROM servicos INNER JOIN clientes ON 
        servicos.id_cliente = clientes.id AND servicos.id_cliente = '".$id."'
        order by servicos.id desc");
        return $this->db->resultados();
    }

    public function deletarServico($idServico){
        $this->db->query("DELETE FROM servicos WHERE id = :servico");
        $this->db->bind("servico", $idServico);

        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }


    public function finalizaServico($dados){
        $this->db->query("UPDATE servicos SET situacao_aparelho = :situacao, solucao_aparelho = :solucao, data_saida = :saida, valor_servico = :servico, valor_produtos = :produtos, desconto = :desconto, total_pagar = :valor_final  WHERE id = :id_servico");
        $this->db->bind("id_servico",$dados['id_servico']);
        $this->db->bind("situacao",$dados['situacao_aparelho']);
        $this->db->bind("solucao",$dados['solucao_aparelho']);
        $this->db->bind("saida",$dados['data_concerto']);
        $this->db->bind("servico",$dados['valor_servico']);
        $this->db->bind("produtos",$dados['valor_produtos']);
        $this->db->bind("desconto",$dados['desconto']);
        $this->db->bind("valor_final",$dados['total_pagar']);
       

        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }

    public function alterarServico($dados){
        $this->db->query("UPDATE servicos SET situacao_aparelho = :situacao, id_cliente = :id_cliente, solucao_aparelho = :solucao, problema_aparelho = :problema, data_entrada = :entrada, data_saida = :saida, valor_servico = :servico, valor_produtos = :produtos, desconto = :desconto, total_pagar = :valor_final  WHERE id = :id_servico");
        $this->db->bind("id_servico",$dados['id_servico']);
        $this->db->bind("id_cliente",$dados['id_cliente']);
        $this->db->bind("situacao",$dados['situacao_aparelho']);
        $this->db->bind("problema",$dados['problema_aparelho']);
        $this->db->bind("solucao",$dados['solucao_aparelho']);
        $this->db->bind("entrada",$dados['data_entrada']);
        $this->db->bind("saida",$dados['data_saida']);
        $this->db->bind("servico",$dados['valor_servico']);
        $this->db->bind("produtos",$dados['valor_produtos']);
        $this->db->bind("desconto",$dados['desconto']);
        $this->db->bind("valor_final",$dados['total_pagar']);
       

        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }

    public function finalizaVendaServico($dados){
        $this->db->query("UPDATE vendas SET situacao = :situacao, valor_venda = :venda, total_pagar = :total  WHERE id = :id_venda");
        $this->db->bind("id_venda",$dados['id_venda']);
        $this->db->bind("situacao",$dados['situacao_aparelho']);
        $this->db->bind("venda",$dados['valor_produtos']);
        $this->db->bind("total",$dados['valor_produtos']);
       
       

        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }

}