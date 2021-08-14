<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pós Venda</title>
    <link rel="stylesheet" href="<?=URL?>/css/style.css">
    <link rel="icon" href="<?=URL?>/images/icone-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  
</head>
<body>

    <section class="section-page">
      
            <div class="container-page">
            <a href="<?=URL?>/admins/home" class="voltar"><i class="bi bi-arrow-left"></i> Voltar</a>
                <?=Sessao::mensagem('venda');?>
            <fieldset><h2>Informações da Venda <i class="bi bi-basket2-fill"></i></h2></fieldset> 

            <fieldset>
                    <h2>Dados do Cliente <i class="bi bi-person-fill"></i></h2>
                   
                </fieldset> 
        <div class="data-client">
        
        <?php foreach($info['cliente'] as $cliente):?>
   
       <div class="name_client info_client">
           <span><i class="bi bi-person-fill"></i> Nome:</span>
           <p><?=$cliente->nome_cliente?></p>
       </div>
       <div class="address_client info_client">
           <span><i class="bi bi-pin-map-fill"></i> Endereço:</span>
           <p><?=$cliente->endereco_cliente?></p>
       </div>
       <div class="phone_client info_client">
           <span><i class="bi bi-telephone-fill"></i> Telefone:</span>
           <p><?=$cliente->telefone_cliente?></p>
       </div>

       <div class="cpf_cnpj_client info_client">
           <span><i class="bi bi-person-badge"></i> CPF/CNPJ:</span>
           <p><?=$cliente->cpf_cnpj_cliente?></p>
       </div>
       
       <div class="date_buy info_client">
           <span><i class="bi bi-cart4"></i> Data da Compra:</span>
           <p><?=Checa::dataBr($cliente->data_compra)?></p>
       </div>
   
    
     <?php endforeach;?>
     </div>
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
                        
                    </tr>
                    
                    <?php endforeach;?>
                   
                </tbody>
            </table>
        </div>



          <fieldset><h2>Valores da compra <i class="bi bi-cash-coin"></i></h2></fieldset>
           <fieldset>
               
               <table class="table-default">
               <?php foreach($info['produtosComprados'] as $produtosVenda):?>
                <thead>
                    <th>Valor total</th>
                    <th>Desconto</th>
                    <th>Total a pagar</th>
                   
                </thead>
                        <tr>
                        <td ><b><?=str_replace(".",",",number_format($produtosVenda->valor_venda,2))?></b>R$</td>
                        <td ><b><?=str_replace(".",",",number_format($produtosVenda->desconto,2))?></b>R$</td>
                        <td><b><?=str_replace(".",",",number_format($produtosVenda->total_pagar,2))?></b>R$</td>
                    </tr>
                    <?php endforeach;?>
               </table>
           
           
        </fieldset>
       
        <div class="buttons-container-page">
            <a href='<?=URL?>/notas/notaProduto/<?=$info['id_venda']?>' target="_blank"><button class="btn btn-note link-button" >Imprimir Nota <i class="bi bi-printer-fill"></i></button></a>
            <a href='<?=URL?>/vendas/editarVenderProdutos/<?=$info['id_venda']?>'><button class="btn-alterar link-button">Alterar Compra <i class="bi bi-pencil-fill"></i></button> </a> 
            <button class="btn btn-excluir link-button" id="botaoexcluirServico">Cancelar Venda <i class="bi bi-trash-fill"></i></button>
        
       </div>
      
      
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

  
    <script type="text/javascript" src="<?=URL?>/js/posVenda.js"></script>

    <script>

  function buttonClose(){
    const alert = document.querySelector(".alert");
   alert.style.display = 'none';
 }
    
    </script>

</body>
</html>