<?php
  
    Sessao::estaLogado($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Cliente</title>
    <link rel="stylesheet" href="<?=URL?>/css/style.css">
    <link rel="icon" href="<?=URL?>/images/icone-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>

    <section class="section-page">
            <div class="container-page">
                <a href="<?=URL?>/admins/home" class="voltar"><i class="bi bi-arrow-left"></i> Voltar</a>
                <fieldset><h2>Adicionar Cliente <i class="bi bi-person-plus-fill"></i></h2></fieldset> 
                <?=Sessao::mensagem('cliente');?>
            <form method="POST" action="<?=URL?>/clientes/cadastrar">
               
           <table>
               <tr>
                    <td><label>Nome: </label></td>
                    <td class="campo"><input type="text" value="<?=$dados['nome_cliente'];?>" name="nome_cliente" placeholder="Digite o nome do cliente"></td>

               </tr>

               <tr>
                   <td><label>Telefone: </label></td>
                   <td class="campo"> <input type="text" name="telefone_cliente" value="<?=$dados['telefone_cliente'];?>" id="telefone_cliente" placeholder="Digite o telefone do cliente"></td>
               </tr>

           <tr>
                <td><label>Endereço: </label></td>
                <td class="campo"> <input type="text" name="endereco_cliente" value="<?=$dados['endereco_cliente'];?>" placeholder="Digite o endereço do cliente"></td>
            </tr>

               <tr>
                <td><label>CPF/CNPJ: </label></td>
                <td class="campo"><input type="text" name="cpf_cnpj_cliente" id="cpf_cliente" value="<?=$dados['cpf_cnpj_cliente'];?>" placeholder="Digite a CPF/CNPJ do cliente"></td>
            </tr>


           </table>
           <fieldset>
            <button class="btn-finalizar"><i class="bi bi-plus-lg"></i> Adicionar Cliente</button>

           </fieldset>
      
        </form>
      
    </div>
</section>

<footer class="footer-page">Gomess Produções - Todos os direitos reservados</footer>


    <script src="https://unpkg.com/imask"></script>
    <script>
        /* Mascara para o telefone do cliente */
        var phoneMask = IMask(
        document.getElementById('telefone_cliente'), {
        mask: '(00) 0 0000-0000'
  });
  var cpfMask = IMask(
        document.getElementById('cpf_cliente'), {
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

  function buttonClose(){
    const alert = document.querySelector(".alert");
   alert.style.display = 'none';
 }
  
    
    </script>

</body>
</html>