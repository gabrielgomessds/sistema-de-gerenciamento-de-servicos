<?php
  
    Sessao::estaLogado($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="<?=URL?>/css/style.css">
    <link rel="icon" href="<?=URL?>/images/icone-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>

    <section class="section-page">
      
            <div class="container-page">
                <a href="<?=URL?>/admins/home" class="voltar"><i class="bi bi-arrow-left"></i> Voltar</a>
            <form method="post" action="<?=URL?>/produtos/cadastrar" name="form_servico">
                <fieldset><h2>Adicionar Produto <i class="bi bi-basket2-fill"></i></h2></fieldset>
                <?=Sessao::mensagem('produto');?> 
           <table>
               <tr>
                    <td><label>Nome: </label></td>
                    <td class="campo"><input type="text" name="nome_produto" placeholder="Digite o nome do produto"></td>

               </tr>

               <tr>
                   <td><label>Marca: </label></td>
                   <td class="campo"> <input type="text" name="marca_produto" placeholder="Digite a marca do produto"></td>
               </tr>

           <tr>
                <td><label>Modelo: </label></td>
                <td class="campo"> <input type="text" name="modelo_produto" placeholder="Digite o modelo do produto"></td>
            </tr>

               <tr>
                <td><label>Quant: </label></td>
                <td class="campo"><input type="text" name="quant_produto"  placeholder="Digite a quantidade do produto"></td>
            </tr>

               <tr>
                   <td><label>Preço: </label></td>
                   <td class="campo"><input type="text" name="preco_produto"  placeholder="Digite o preço do produto"></td>
                   
               </tr>

               <tr>
                   <td><label>Descrição: </label></td>
                   <td class="campo"><textarea name="descricao_produto" placeholder="Descrição do produto"></textarea></td>
                   
               </tr>

           </table>
           <fieldset>
            <button class="btn-finalizar"><i class="bi bi-plus-lg"></i> Adicionar Produto</button>

           </fieldset>
      
        </form>
      
    </div>
</section>

<footer class="footer-page">Gomess Produções - Todos os direitos reservados</footer>

   <script>
        function buttonClose(){
                    const alert = document.querySelector(".alert");
                    alert.style.display = 'none';
                 }
   </script>

</body>
</html>