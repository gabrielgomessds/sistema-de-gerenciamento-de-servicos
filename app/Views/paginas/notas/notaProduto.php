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
        
        <?php foreach($dados['cliente'] as $cliente):?>

       <div class="name_client info_client">
           <span><i class="bi bi-person-fill"></i> Nome:</span>
           <p><?=$cliente->nome_cliente?></p>
       </div>
       <div class="address_client info_client">
           <span><i class="bi bi-pin-map-fill"></i> Endereço:</span>
           <p>Vila Senhora Satana</p>
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
           <span><i class="bi bi-cart4"></i> Data Compra:</span>
           <p><?=Checa::dataBr($cliente->data_compra)?></p>
       </div>
    </div>
    <?php endforeach;?>

    <div class="table-buy">
        <h2>Produtos Comprados <i class="bi bi-cart4"></i></h2>
        <table>
            <thead>
               
                <th>Produto</th>
                <th>Marca</th>
                <th>Valor Unit.</th>
                <th>Quantidade</th>
                <th>Total</th>
            </thead>
            <tbody>
                <?php foreach($dados['vendaProduto'] as $produtosVenda):?>
                    <tr>
                        <td><?=$produtosVenda->nome_produto?></td>
                        <td><?=$produtosVenda->marca_produto?></td>
                        <td class="preco_produto"><?=str_replace(".",",",$produtosVenda->preco_produto);?></td>
                        <td class="quant_produto"><?=$produtosVenda->quant_venda?></td>
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
                   <td><b><?=str_replace(".",",",number_format($produtosVenda->valor_venda,2)) ?>R$</b> </td>
               </tr>
               <tr class="linha">
                   <td><b>DESCONTO</b></td>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td><b class="desconto_venda"><?=str_replace(".",",",$produtosVenda->desconto) != 0 ? "-".str_replace(".",",", number_format($produtosVenda->desconto,2)) : '0,00'?>R$</b> </td>
               </tr>
                       
               <tr>
                   <td><b>TOTAL A PAGAR</b></td>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td><b class="valor_pagar"><?=str_replace(".",",",number_format($produtosVenda->total_pagar,2))?>R$</b> </td>
               </tr>
            </tbody>
        </table>
       
    </div>
    

    <div class="func-signatura">
        <p>________________________________________</p>
        <p>Assinatura do funcionario(a)</p>
    </div>
   
    <script src="<?=URL?>/js/calcular.js"></script>

    <script>
        window.print();
    </script>
</body>
</html>