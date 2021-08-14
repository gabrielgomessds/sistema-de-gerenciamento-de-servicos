<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota - Entrada de Aparelho - MICROINFOR Solução com Tecnologia</title>
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
    </div>
    
    <div class="data-product">
        
        <div class="name_product info_produtct">
            <span>Aparelho:</span>
            <p><?=$servico->aparelho_cliente?> <?=$servico->marca_aparelho?> <?=$servico->modelo_aparelho?></p>
        </div>
        <hr>
        <div class="problem_product info_produtct">
            <span>Problema:</span>
            <p><?=$servico->problema_aparelho?></p>
        </div>
        <hr>
     
     </div>
     <?php endforeach;?>
   <div class="termos container">
        <h2>Termos de Garantia</h2>
        <ol>
           <li>MICROINFOR tem garantia de 30 dias para mão  de obra e peças no concerto a partir da entrega</li>
           <li>O aparelho só será entregue com essa nota, portanto guardi-a com cuidado </li>
           <li>Equipamentos que não ligam ou que não tem como acessar o sistema operacional assim impossibilitando
               teste de outros componentes podem apresentar defeitos secundários, podendo ser concertados posteriormente </li>
           <li>Qualquer dúvida que venha a ter quanto ao serviço por favor entrar em contato</li>
       </ol>
    </div>
    <div class="func-signatura">
        <p>________________________________________</p>
        <p>Assinatura do funcionario(a)</p>
    </div>
    
    <script>
        window.print();
    </script>
</body>
</html>