<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações do Cliente</title>
    <link rel="stylesheet" href="<?=URL?>/css/style.css">
    <link rel="icon" href="<?=URL?>/images/icone-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>

    <section class="section-page">
      
            <div class="container-page">
                <a href="<?=URL?>/admins/home" class="voltar"><i class="bi bi-arrow-left"></i> Voltar</a>
               <fieldset><h2>Dados do Cliente <i class="bi bi-people-fill"></i></h2></fieldset>  
               <?=Sessao::mensagem('cliente');?>
               <form method="post" action="<?=URL?>/clientes/editar/<?=$dados['id']?>" name="form_info_servico">
               <table>
                <tr>  
                    <td> <label>Nome: </label></td> 
                    <td class="campo"><input type="text"  value="<?=$dados['nome_cliente']?>" name="nome_cliente" id="nome_cliente" placeholder="Nome do cliente"></td>
                </tr>

                <tr>   
                    <td><label>Telefone: </label></td>
                    <td class="campo"><input type="text"  value="<?=$dados['telefone_cliente']?>" name="telefone_cliente" id="telefone_cliente" placeholder="Telefone do cliente"></td>                
                </tr>

               <tr>   
                   <td><label>Endereço: </label></td>
                   <td class="campo"><input type="text"  value="<?=$dados['endereco_cliente']?>" name="endereco_cliente" id="endereco_cliente" placeholder="Endereço do cliente"></td>
               </tr>

               <tr>   
                   <td><label>CPF/CNPJ: </label></td>
                   <td class="campo"><input type="text"  value="<?=$dados['cpf_cnpj_cliente']?>" name="cpf_cnpj_cliente" id="cpf_cliente" placeholder="CPF/CNPJ do cliente"></td>           
               </tr>

               </table>
       
               <div class="buttons-container-page">

               <a href="<?=URL?>/clientes/servicosCliente/<?=$dados['id']?>" class="btn-print-out link__button link-button" >

                 Serviços Feitos <i class="bi bi-tools"></i>
                </a>

              <!--   <a href="<?=URL?>/clientes/comprasCliente/<?=$dados['id']?>" class="btn-finalizar link__button link-button">

                    Compras Feitas <i class="bi bi-cart4"></i>
                 </a>
 -->
                <button  class="btn btn-update link-button" id="botaoFinalizarServico">
                    Alterar Cliente <i class="bi bi-pencil-fill"></i>
                </button>

                <button onclick="return false" class="btn btn-excluir link-button" id="botaoexcluirServico">
                    Excluir Cliente <i class="bi bi-trash-fill"></i>
            </button>
        </div>
        </form>
    </div>
</section>

<footer class="footer-page">Gomess Produções - Todos os direitos reservados</footer>
<!-- -------------------------------------JANELAS MODAIS --------------------------------------------- -->

<div id="modalExcluirServico" class="modal-container">
    <div class="modal-content">
        <button class="fechar">X</button>
        <h2 class="subtitulo">Tem certeza que deseja excluir esse cliente?</h2>
        <form action="<?=URL?>/clientes/excluir/<?=$dados['id']?>">
            <button class="btn-question btn-yes">Sim</button> <a class="btn-question btn-no">Não</a>
        </form>
        
    </div>
</div>


    <script src="<?=URL?>/js/script-page.js"></script>

    <script src="https://unpkg.com/imask"></script>
    <script>
        /* Mascara para o telefone do cliente */
        var phoneMask = IMask(
        document.getElementById('telefone_cliente'), {
        mask: '(00) 0 0000-0000'
  });
  var cpfMask = IMask(
        document.getElementById('cpf_cnpj_cliente'), {
        mask:[
        {
          mask: '000.000.000-00',
          maxLength: 11
        },
        {
          mask: '00.000.000/0000-00'
        }
      ]
  });

  </script>

</body>
</html>