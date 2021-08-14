<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vender Produto</title>
    <link rel="stylesheet" href="<?=URL?>/css/style.css">
    <link rel="icon" href="<?=URL?>/images/icone-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  
</head>
<body>

    <section class="section-page">
      
            <div class="container-page">
            <a href="<?=URL?>/admins/home" class="voltar"><i class="bi bi-arrow-left"></i> Voltar</a>
                <?=Sessao::mensagem('venda');?>
                <fieldset>
                        
                        <h2>Dados do Cliente<i class="bi bi-person-fill"></i></h2>
                    
                </fieldset> 

                <fieldset><button class="btn-add botaoTabelaClientes" >Mudar Cliente <i class="bi bi-people-fill"></i> </button></fieldset>
               <?=Sessao::mensagem('venda')?>
               
              
               <?php foreach($info['cliente'] as $cliente):?>
               <table>
               <form action="<?=URL?>/vendas/alterarVendaProduto" method="POST">
               <input type="text" name="id_venda" value="<?=$info['id_venda']?>" hidden>
                <input type="text" name="id_cliente" value="<?=$cliente->id?>" hidden>
                <tr>  
                    <td> <label>Nome: </label></td> 
                    <td class="campo"><input type="text" disabled value="<?=$cliente->nome_cliente?>" name="nome_cliente" id="nome_cliente" placeholder="Vincular nome do cliente"></td>
                </tr>

                <tr>   
                    <td><label>Telefone: </label></td>
                    <td class="campo"><input type="text" disabled value="<?=$cliente->telefone_cliente?>" name="telefone_cliente" id="telefone_cliente" placeholder="Vincular telefone do cliente"></td>                
                </tr>

               <tr>   
                   <td><label>Endereço: </label></td>
                   <td class="campo"><input type="text" disabled value="<?=$cliente->endereco_cliente?>" name="endereco_cliente" id="endereco_cliente" placeholder="Vincular endereço do cliente"></td>
               </tr>

               <tr>   
                   <td><label>CPF/CNPJ: </label></td>
                   <td class="campo"><input type="text" disabled value="<?=$cliente->cpf_cnpj_cliente?>" name="cpf_cnpj_cliente" id="cpf_cliente" placeholder="Vincular CPF/CNPJ do cliente"></td>           
               </tr>
               </table>
               <?php endforeach;?>
           <!-- ------------------------------------------------------------------------------------------- -->
           <fieldset><h2>Produtos Comprados <i class="bi bi-cart4"></i></h2></fieldset>
         
             <div class="div-table">
            <table class="table-default">
                <thead>
                    <th>Produto</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Quant</th>
                    <th>Valor Unit.</th>
                    <th>Valor Total</th>
                    <th>Excluir</th>
                </thead>
                <tbody>
                    <?php foreach($info['vendaProduto'] as $produtosVenda):?>
                    <tr>
                        <td><?=$produtosVenda->nome_produto?></td>
                        <td><?=$produtosVenda->marca_produto?></td>
                        <td><?=$produtosVenda->modelo_produto?></td>
                        <td class="quant_produto"><?=$produtosVenda->quant_venda?></td>
                        <td class="preco_produto"><?=str_replace(".",",",$produtosVenda->preco_produto);?>R$</td>
                        <td class="total_produto"></td>
                        <td><i class="bi bi-trash-fill botaoExcluirProduto" id="<?=$produtosVenda->id_produto?>"></i></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>

       

          <fieldset>
            <input type="hidden" id="servico" value="0">
                <label>Desconto: </label>
                    <?php foreach($info['cliente'] as $venda):?>
                        <input type="text" name="desconto"  value="<?=$venda->desconto?>"  onkeypress="return filtroTeclas(event)" onblur="calcular();" id="desconto"  placeholder="00,00">
                        <input type="text" name="desconto" class="total_desconto" value="<?=$venda->desconto?>" hidden>
                        <input type="text" name="valor_desconto" class="valor_servico" disabled hidden>
                    <?php endforeach;?>
            </tr>
          </fieldset>



           <fieldset>
            TOTAL A PAGAR: <b id="pagar"></b>R$
            
        </fieldset>
       
        <div class="buttons-container-page">
            <button class="btn btn-print-out link-button" onclick="return false" id="botaoChamaProdutos"><i class="bi bi-plus-lg"></i> Adicionar Produto</button>
             <button class="btn btn-update link-button"  id="botaoFinalizarServico">Alterar Compra <i class="bi bi-pencil-fill"></i></button>
            <!-- <button class="btn-alterar link-button">Alterar Compra <i class="bi bi-pencil-fill"></i></button>  -->
            <button class="btn btn-excluir link-button" onclick="return false"  id="botaoexcluirServico">Cancelar Venda <i class="bi bi-trash-fill"></i></button>
        
          
            <input type="text" name="valor_venda" class="valor_venda" hidden>
            <input type="text" name="valor_total" class="total_pagar" hidden>
            
       </div>
                    </form>
       
      
    </div>
</section>

<footer class="footer-page">Gomess Produções - Todos os direitos reservados</footer>
<!-- -------------------------------------JANELAS MODAIS --------------------------------------------- -->


<div id="modalExcluirServico" class="modal-container">
    <div class="modal-content">
        <button class="fechar">X</button>
        <h2 class="subtitulo">Tem certeza que deseja excluir essa venda?</h2>
        <form action="<?=URL?>/vendas/excluirVenda" method="POST">
            <input type="text" name="id_venda" value="<?=$info['id_venda']?>" hidden>
            <?php foreach($info['vendaProduto'] as $produtosVenda):?>
                <input type="text" name="id_produto[]" value="<?=$produtosVenda->id?>" hidden>
                <input type="text" name="quant_venda[]" value="<?=$produtosVenda->quant_venda?>" hidden>
           <?php endforeach;?>
            <button class="btn-question btn-yes">Sim</button> <a class="btn-question btn-no">Não</a>
        </form>
        
    </div>
</div>

<div id="modalExcluirProduto" class="modal-container">
    <div class="modal-content">
        <button class="fechar">X</button>
        <h2 class="subtitulo">Excluir <b class="nomeProdutoCompraAqui"></b> da compra</h2>
        <form action="<?=URL?>/vendas/alterarExcluindoProdutoDaCompra">
            <input type="text" name="id_produto" id="id_produto_compra" hidden>
            <input type="text" name="id_venda" id="id_venda" value="<?=$info['id_venda']?>" hidden>
            <button class="btn-question btn-yes">Sim</button> <a class="btn-question btn-no">Não</a>
        </form>
    </div>
</div>


  <!-- -----------------------------------------------JANELAS MODAIS---------------------------------------------- -->

<div id="modalTabelaProdutos" class="modal-container ">
    <div class="modal-content table">
        <button class="fechar">X</button>
        <h2 class="subtitulo">Adicionar Produto a Compra</h2>
        <div class="search">
            <div class="content-search">
                <input type="text" class="search" id="filtrar-tabela-produto-modal" placeholder="Pesquisar produto..."><button><i class="bi bi-search"></i></button>
            </div>
        </div>
        <div class="table-modal-product">
            <table>
                <thead>
                    <tr>
                        <td>Produto</td>
                        <td>Marca/Modelo</td>
                        <td>Estoque</td>
                        <td>Preço</td>
                        <td>Adicionar</td>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($info['produtos'] as $produto):?>
                

                        <tr class="tabela-modal-produto">
                            <td class="nome_produto"><?=$produto->nome_produto?></td>
                            <td><?=$produto->marca_produto?></td>
                            <td><?=$produto->quant_produto > 0 ? $produto->quant_produto : '<b style="color:red">'.$produto->quant_produto.'</br>'?></td>
                            <td ><?=str_replace(".",",",$produto->preco_produto);?>R$</a></td>
                            <td><i class="bi bi-plus-circle-fill <?=$produto->quant_produto > 0 ? "botaoAddProduto" : 'estoqueVazio'?>"  id="<?=$produto->id?>"></i></td>
                        
                        </tr>
                  <?php endforeach;?>

                   
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modalAddProduto" class="modal-container">
    <div class="modal-content">
        <button class="fechar">X</button>
        <h2 class="subtitulo">Adicionar  <b class="nomeProdutoAqui"></b></h2>
            <form action="<?=URL?>/vendas/alterarVenderProdutos" method="POST">
                    Quant: <input type="text" name="quant_venda" value="1">
                    <input type="text" name="id_produto" id="id_produto" hidden>
                    <input type="text" name="id_venda" id="id_venda" value="<?=$info['id_venda']?>" hidden>
                    <?php foreach($info['cliente'] as $cliente):?>
                        <input type="text" name="id_cliente" id="id_compra_cliente" value="<?=$cliente->id?>" hidden>
                    <?php endforeach;?>
                    <button class="btn-question btn-yes">Adicionar</button> <a class="btn-question btn-no">Cancelar</a>
            </form>
    </div>
</div>

<div id="modalTabelaClientes" class="modal-container ">
        <div class="modal-content table">
            <button class="fechar">X</button>
            <h2 class="subtitulo">Vicular cliente ao serviço</h2>
            <div class="search">
                <div class="content-search">
                    <input type="text" class="search" id="filtrar-tabela-cliente-modal" placeholder="Pesquisar cliente..."><button><i class="bi bi-search"></i></button>
                </div>
            </div>
            <div class="table-modal-client">
                <table>
                    <thead>
                        <tr>
                            <td>Código</td>
                            <td>Nome</td>
                            <td>Telefone</td>
                            <td>Endereço</td>
                            <td>CPF</td>
                            <td>Vincular</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($info['clientes'] as $cliente):?>
                            <tr id="cliente-<?=$cliente->id?>" class="tabela-modal-cliente">
                                <td data-id="<?=$cliente->id?>"><?=$cliente->id?></td>
                                <td data-nome="<?=$cliente->nome_cliente?>" class="nome_cliente"><?=$cliente->nome_cliente?></td>
                                <td data-telefone = "<?=$cliente->telefone_cliente?>"><?=$cliente->telefone_cliente?></td>
                                <td data-endereco = "<?=$cliente->endereco_cliente?>"><?=$cliente->endereco_cliente?></a></td>
                                <td data-cpf = "<?=$cliente->cpf_cnpj_cliente?>"><?=$cliente->cpf_cnpj_cliente?></td>
                                <td><button ><i class="bi bi-plus-circle-fill" onclick="adicionar('cliente-<?=$cliente->id?>');" id="btn-vincular"></i></button></td>
                             </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



   
    <script type="text/javascript" src="<?=URL?>/js/script-page.js"></script>

    <script>

  function buttonClose(){
    const alert = document.querySelector(".alert");
   alert.style.display = 'none';
 }
    
    </script>

</body>
</html>