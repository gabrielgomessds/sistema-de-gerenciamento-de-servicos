<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gerenciamento - Login</title>
    <link rel="stylesheet" href="<?=URL?>/css/style.css">
    <link rel="icon" href="<?=URL?>/images/icone-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
</head>
<body>
    <section class="section-login">
  <h1><img src="<?=URL?>/images/icone-logo.png" alt="Logo"> Sistema de Gerenciamento de Serviços</h1>
        <div class="form-login">

        <?=Sessao::mensagem('admin');?>

            <form action="<?=URL?>/admins/login" method="post">
               <fieldset>
                 <h2>LOGIN</h2>
               </fieldset>
                <fieldset>
                    <i class="bi bi-person-circle icon-user" ></i>
                </fieldset>
                <fieldset>
                    <label>Email: </label>
                    <input type="email" name="email_admin" value="<?=isset($dados['email_admin']) ? $dados['email_admin'] : ''?>" placeholder="Digite seu e-mail">
                </fieldset>
                <fieldset>
                    <label>Senha: </label>
                    <input type="password" name="senha_admin" placeholder="Digite sua senha">
                </fieldset>
               <!--  <fieldset class="fieldset-checkbox">
                    <input type="checkbox" name="manter_logado" value="yes"> <span>Mantenha-me conectado</span>
                </fieldset> -->
                <fieldset>
                    <input type="submit" value="Login">
                </fieldset>
            </form>
        </div>
    </section>
    <footer class="footer">Gomess Produções - Todos os direitos reservados</footer>
   <script src="assets/js/script.js"></script>
   <script>
         function buttonClose(){
                    const alert = document.querySelector(".alert");
                    alert.style.display = 'none';
                 }
   </script>
</body>
</html>