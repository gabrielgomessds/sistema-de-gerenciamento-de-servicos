<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota do Produto - MICROINFOR Solução com Tecnologia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?=URL?>/css/notes.css">
    <link rel="icon" href="<?=URL?>/images/icone-logo.png">
</head>
<body>
    <div class="header-note">
        <div class="logo-store"><img src="<?=URL?>/images/simbolo.png" alt=""></div>
        <div class="info-store">
            <p><i class="bi bi-whatsapp"></i> (88) 9 8819-3596 | (88) 9 9771-76-70</p>
            <p><i class="bi bi-geo-alt"></i> Rua Henrique Alencar - 160 - Centro</p>
            <p><i class="bi bi-instagram"></i> microinfor_assitencia | <i class="bi bi-facebook"></i> MicroInfor Assitência</p> 
        </div>
    </div>
    <div class="data-client">
        
    <?php foreach($dados['servico'] as $servico):?>
   
       <div class="name_client info_client">
           <span><i class="bi bi-person-fill"></i> Nome:</span>
           <p><?=$servico->nome_cliente?></p>
       </div>
       <div class="address_client info_client">
           <span><i class="bi bi-pin-map-fill"></i> Endereço:</span>
           <p><?=$servico->endereco_cliente?></p>
       </div>
       <div class="phone_client info_client">
           <span><i class="bi bi-telephone-fill"></i> Telefone:</span>
           <p><?=$servico->telefone_cliente?></p>
       </div>

       <div class="cpf_cnpj_client info_client">
           <span><i class="bi bi-person-badge"></i> CPF/CNPJ:</span>
           <p><?=$servico->cpf_cnpj_cliente?></p>
       </div>
       
       <div class="date_buy info_client">
           <span><i class="bi bi-laptop"></i> Entrada do Aparelho:</span>
           <p><?=Checa::dataBr($servico->data_entrada)?></p>
       </div>
       <div class="date_buy info_client">
           <span><i class="bi bi-laptop"></i> Saida do Aparelho:</span>
           <p><?=Checa::dataBr($servico->data_saida)?></p>
       </div>
    </div>
   
    <div class="data-product">
        
        <div class="name_product info_produtct">
            <span>Aparelho:</span>
            <p><?=$servico->aparelho_cliente?> <?=$servico->marca_aparelho?> <?=$servico->modelo_aparelho?></p>
        </div>
        

        <div class="problem_product info_produtct">
            <span>Problema:</span>
            <p><?=$servico->problema_aparelho?>
            </p>
        </div>
        
        <div class="problem_product info_produtct">
            <span>Solução:</span>
            <p><?=$servico->solucao_aparelho?>
            </p>
        </div>
        
        <hr>
        <b><h4>VALOR DO SERVIÇO: <?=str_replace(".",",",number_format($servico->valor_servico,2))?>R$</h4></b>
        <hr>
       
        </div>
        <?php
            if($servico->valor_produtos != 0):
        ?>
           <div class="table-buy">
        <h2>Produtos Comprados <i class="bi bi-cart4"></i></h2>
        <table>
            <thead>
               
                <th>Produto</th>
                <th>Marca</th>
                <th>Valor Unit.</th>
                <th>Quantidade</th>
                <th>Valor</th>
            </thead>
            <tbody>
            <?php foreach($dados['vendaProduto'] as $vendas):?>
                <tr>
                  
                    <td><?=$vendas->nome_produto?></td>
                    <td><?=$vendas->marca_produto?></td>
                    <td class="preco_produto"><?=$vendas->preco_produto?></td>
                    <td class="quant_produto"><?=$vendas->quant_venda?></td>
                    <td class="total_produto"></td>
                    
                </tr>
                <?php endforeach;?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
               
                   <td><b>TOTAL DA COMPRA</b></td>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td><b><?=str_replace(".",",",number_format($servico->valor_produtos, 2))?></b> </td>
                   
               </tr>
               
            </tbody>
        </table>
       
    </div>
        <?php endif;?>
     
   
      <div class="data-product">

      <b><h4>DESCONTO: <?=str_replace(".",",",$servico->desconto) != 0 ? "-".str_replace(".",",", number_format($servico->desconto, 2)) : '0,00'?>R$</h4></b>
      <hr>
      <br>
      <b><h3>TOTAL A PAGAR: <?=str_replace(".",",",number_format($servico->total_pagar,2))?>R$</h3></b>
      <?php endforeach;?>
      </div>
     <div class="termos container">
        <h2>Termos de Garantia</h2>
       <ol>
           <li> Garantia de 30 dias a partir da assitência tecnica</li>
           <li>Não nos responsavilizamos por aparelhos abertos por terceitos </li>
           <li>A garantia não cobre defeitos causados por quedas</li>
           <li>Não damos garatia sobre peças fornecidas pelo cliente, apenas o serviço</li>
           <li>Se houver quebra no selo de garantia a mesma será anulada</li>
       </ol>
    </div>


    <div class="func-signatura container">
        <p>________________________________________</p>
        <p>Assinatura do cliente</p>
    </div>
   
    <div class="func-signatura container">
        <p>________________________________________</p>
        <p>Assinatura do funcionario(a)</p>
    </div>
   
    <script src="<?=URL?>/js/calcular.js"></script>
    <script>
        window.print();
    </script>
</body>
</html>