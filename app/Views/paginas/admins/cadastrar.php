<?php
  
    Sessao::estaLogado($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Admin</title>
    <link rel="stylesheet" href="<?=URL?>/css/style.css">
    <link rel="icon" href="<?=URL?>/images/icone-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>

    <section class="section-page">
            <div class="container-page">
                <a href="<?=URL?>/admins/home" class="voltar"><i class="bi bi-arrow-left"></i> Voltar</a>
            <form method="post" name="form_admin">
                <fieldset><h2>Adicionar Admin <i class="bi bi-person-plus-fill"></i></h2></fieldset> 

                <?=Sessao::mensagem('admin');?>
           <table>
               <tr>
                    <td><label>Nome: </label></td>
                    <td class="campo"><input type="text" name="nome_admin" value="<?=$dados['nome_admin']?>" placeholder="Digite o nome do admin"></td>

               </tr>

               <tr>
                   <td><label>E-mail: </label></td>
                   <td class="campo"><input type="email" name="email_admin" value="<?=$dados['email_admin']?>"  placeholder="Digite o email do admin"></td>
                   
               </tr>

               <tr>
                <td><label>Senha: </label></td>
                <td class="campo"><div class="input-password"><input type="password" value="<?=$dados['senha_admin']?>" id="senha"  name="senha_admin"  placeholder="Digite a senha do admin"><i class="bi bi-eye-slash-fill" onclick="mostrarSenha();" id="icone_ver" title="Mostrar Senha"></i></div></td>
                
            </tr>
            <tr>
              <td><label>Confimar senha: </label></td>
              <td class="campo"><input type="password" id="confirmar_senha_admin" value="<?=$dados['confirmar_senha_admin']?>"  name="confirmar_senha_admin"  placeholder="Confirme a senha do admin"></td>
              
          </tr>

           </table>
           <fieldset>
            <button class="btn-finalizar"><i class="bi bi-plus-lg"></i> Adicionar Admin</button>

           </fieldset>
      
        </form>
      
    </div>
</section>

<footer class="footer-page">Gomess Produções - Todos os direitos reservados</footer>


   
    <script>
        function mostrarSenha(){
                 var senha = document.getElementById("senha");
                 var confirma = document.getElementById("confirma_senha");
                 if(senha.type == 'password'){
                      senha.type = '';
                      confirma.type = 'text';
                      senha.className = 'text';
                      confirma.className =  '';
                      document.getElementById('icone_ver').className = "bi bi-eye-fill";
                 }else{
                      senha.type = 'password';
                      confirma.type = 'password';
                      document.getElementById('icone_ver').className = "bi bi-eye-slash-fill";
                 }
                }

                function buttonClose(){
                    const alert = document.querySelector(".alert");
                    alert.style.display = 'none';
                 }
  

    </script>
</body>
</html>