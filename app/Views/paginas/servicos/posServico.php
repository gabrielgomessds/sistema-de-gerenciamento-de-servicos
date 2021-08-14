<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pós Serviço</title>
    <link rel="stylesheet" href="<?=URL?>/css/style.css">
    <link rel="icon" href="<?=URL?>/images/icone-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>

    <section class="section-page">
      
            <div class="container-page">
                <a href="<?=URL?>/admins/home" class="voltar"><i class="bi bi-arrow-left"></i> Voltar</a>
          
                <fieldset><h2>Informações do Serviço <i class="bi bi-tools"></i></h2></fieldset> 
                <fieldset>
                    <h2>Dados do Cliente <i class="bi bi-person-fill"></i></h2>
                   
                </fieldset> 
                <?=Sessao::mensagem('servico');?>

               <?php foreach($info['servico'] as $servico):?>
                <div class="data-client">
        
                <div class="name_client info_client">
                    <span><i class="bi bi-person-fill"></i> Nome: </span>
                    <p> <?=$servico->nome_cliente?></p>
                </div>
                <div class="address_client info_client">
                    <span><i class="bi bi-pin-map-fill"></i> Endereço: </span>
                    <p><?=$servico->endereco_cliente?></p>
                </div>
                <div class="phone_client info_client">
                    <span><i class="bi bi-telephone-fill"></i> Telefone: </span>
                    <p><?=$servico->telefone_cliente?></p>
                </div>
        
                <div class="cpf_cnpj_client info_client">
                    <span><i class="bi bi-person-badge"></i> CPF/CNPJ: </span>
                    <p><?=$servico->cpf_cnpj_cliente?></p>
                </div>

                <div class="date_buy info_client">
                    <span><i class="bi bi-laptop"></i> Aparelho: </span>
                    <p><?=$servico->aparelho_cliente?> <?=$servico->marca_aparelho?> <?=$servico->modelo_aparelho?></p>
                </div>
                
                <div class="date_buy info_client">
                    <span><i class="bi bi-calendar-week-fill"></i> Entrada do Aparelho: </span>
                    <p><?=Checa::dataBr($servico->data_entrada)?></p>
                </div>

                <div class="date_buy info_client">
                    <span><i class="bi bi-calendar-week-fill"></i> Saida do Aparelho: </span>
                    <p><?=Checa::dataBr($servico->data_entrada)?></p>
                </div>
            </div>
            <hr/>
            
            <div class="data-product-note">
            <fieldset>
                    <h2>Dados do Serviço <i class="bi bi-tools"></i></h2>
                   
                </fieldset> 
    
        <div class="problem_product info_produtct">
            <span>Problema:</span>
            <p><?=$servico->problema_aparelho?></p>
        </div>

        <div class="solution_product info_produtct">
            <span>Solução:</span>
            <p><?=$servico->solucao_aparelho?></p>
        </div>
  
     </div>
            <hr>
           <!-- ------------------------------------------------------------------------------------------- -->
          
           <div class="div-table">
            
            <?php
                 if($info['vendas'] == 0):
                 
            ?>
             <fieldset><h2>Nenhum produto adicionando ao serviço <i class="bi bi-cart4"></i></h2></fieldset>
            <?php
                 else:
             
            ?>
                       <fieldset><h2>Produtos Adicionados <i class="bi bi-cart4"></i></h2></fieldset>
 
                <table class="table-default">
                 <tr>
                     <th>Produto</th>
                     <th>Marca</th>
                     <th>Modelo</th>
                     <th>Quant.</th>
                     <th>Valor Unit.</th>
                     <th>Valor Total</th>
                    
                 </tr>
                <?php foreach($info['vendaProduto'] as $vendas):?>
                 <tr>
                     <td><?=$vendas->nome_produto?></td>
                     <td><?=$vendas->marca_produto?></td>
                     <td><?=$vendas->modelo_produto?></td>
                     <td class="quant_produto"><?=$vendas->quant_venda?></td>
                     <td class="preco_produto"><?=$vendas->preco_produto?></td>
                     <td class="total_produto"></td>
                     
                 </tr>
                 <?php endforeach;?>
                 
               </table>
            <?php endif;?>
                    <hr/>
         
            <p class="total_valor"><i class="bi bi-cart4"></i> Valor da Venda: <?=str_replace(".",",",number_format($servico->valor_produtos,2))?>R$</p>

 
           </div>


               
              <p class="total_valor"><i class="bi bi-tools"></i> Valor do Serviço: <?=str_replace(".",",",number_format($servico->valor_servico,2))?>R$</p>
     
                <p class="total_valor"><i class="bi bi-cash-coin"></i> Valor do Desconto: <?=str_replace(".",",",number_format($servico->desconto,2))?>R$</p>
       

           <fieldset>
         
                <p class="total_valor pagar">TOTAL A PAGAR: <?=str_replace(".",",",number_format($servico->total_pagar,2))?>R$</p>
        
        </fieldset>
       
      <div class="buttons-container-page">

        <a href="<?=URL?>/notas/saidaAparelho/<?=$servico->ServicoID?>" target="_blank"><button class="btn btn-print-out " id="botaoChamaProdutos"> 
        <i class="bi bi-printer"></i> Nota de Saida
        </button></a>

        <a href="<?=URL?>/notas/entradaAparelho/<?=$servico->ServicoID?>" class="link__button" target="_blank">

            <i class="bi bi-printer"></i> Nota de Entrada
       </a>

       <a href='<?=URL?>/servicos/editarServico/<?=$servico->ServicoID?>'><button class="btn-alterar link__button">Alterar Serviço <i class="bi bi-pencil-fill"></i></button> </a> 


        <button onclick="return false" class="btn btn-excluir" id="botaoexcluirServico">
            Cancelar Serviço <i class="bi bi-trash-fill"></i>
       </button>

        <?php endforeach;?>
    </div>
</section>

<footer class="footer-page">Gomess Produções - Todos os direitos reservados</footer>
<!-- -------------------------------------JANELAS MODAIS --------------------------------------------- -->


<div id="modalExcluirServico" class="modal-container">
    <div class="modal-content">
        <button class="fechar">X</button>
        <h2 class="subtitulo">Tem certeza que deseja cancelar esse serviço?</h2>
        <form action="<?=URL?>/servicos/excluirServico" method="POST">
            <?php foreach($info['servico'] as $servico):?>
                        <input type="text" name="id_servico" value="<?=$servico->ServicoID?>" >
            <?php endforeach;?>
            <?php foreach($info['idVenda'] as $venda):?>
                        <input type="text" name="id_venda" id="id_venda" value="<?=$venda->id?>" >
             <?php endforeach;?>
            <?php foreach($info['vendaProduto'] as $produtosVenda):?>
                <input type="text" name="id_produto[]" value="<?=$produtosVenda->id?>" >
                <input type="text" name="quant_venda[]" value="<?=$produtosVenda->quant_venda?>" >
           <?php endforeach;?>
            <button class="btn-question btn-yes">Sim</button> <a class="btn-question btn-no">Não</a>
        </form>
        
    </div>
</div>



    <script src="<?=URL?>/js/calcular.js"></script>

    <script>
        function buttonClose(){
        const alert = document.querySelector(".alert");
        alert.style.display = 'none';
     }
    </script>
</body>
</html>