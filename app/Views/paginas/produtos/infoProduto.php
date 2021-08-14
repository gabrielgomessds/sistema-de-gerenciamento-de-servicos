<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações do Produto</title>
    <link rel="stylesheet" href="<?=URL?>/css/style.css">
    <link rel="icon" href="<?=URL?>/images/icone-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>

    <section class="section-page">
      
            <div class="container-page">
                <a href="<?=URL?>/admins/home" class="voltar"><i class="bi bi-arrow-left"></i> Voltar</a>
               <fieldset><h2>Informações do Produto <i class="bi bi-basket2-fill"></i></h2></fieldset>
                <?=Sessao::mensagem('produto');?> 
                <form action="<?=URL?>/produtos/editar/<?=$dados['id']?>" method="POST">
               <table>
               <tr>
                    <td><label>Nome: </label></td>
                    <td class="campo"><input type="text" value="<?=$dados['nome_produto']?>" name="nome_produto" placeholder="Digite o nome do produto"></td>

               </tr>

               <tr>
                   <td><label>Marca: </label></td>
                   <td class="campo"> <input type="text" value="<?=$dados['marca_produto']?>" name="marca_produto" placeholder="Digite a marca do produto"></td>
               </tr>

           <tr>
                <td><label>Modelo: </label></td>
                <td class="campo"> <input type="text" value="<?=$dados['modelo_produto']?>" name="modelo_produto" placeholder="Digite o modelo do produto"></td>
            </tr>

               <tr>
                <td><label>Quant: </label></td>
                <td class="campo"><input type="text" name="quant_produto" value="<?=$dados['quant_produto']?>"  placeholder="Digite a quantnameade do produto"></td>
            </tr>

               <tr>
                   <td><label>Preço: </label></td>
                   <td class="campo"><input type="text" name="preco_produto" value="<?=str_replace(".",",",$dados['preco_produto'])?>"  placeholder="Digite o preço do produto"></td>
                   
               </tr>

               <tr>
                   <td><label>Descrição: </label></td>
                   <td class="campo"><textarea name="descricao_produto" placeholder="Descrição do produto"><?=$dados['descricao_produto']?>
                   </textarea></td>
                   
               </tr>

           </table>
       
      <div class="buttons-container-page">

      <button onclick="return false" class="btn btn-print-out link-button" id="botaoAddEstoque"> 
            <i class="bi bi-plus-lg"></i> Adicionar Estoque
        </button>


      <button class="btn-alterar link-button" >
            Alterar Produto <i class="bi bi-pencil-fill"></i>
        </button> 

        <button onclick="return false" class="btn btn-excluir link-button" id="botaoexcluirServico">
            Excluir Produto<i class="bi bi-trash-fill"></i>
       </button>

       </form>
    </div>
               
</section>

<footer class="footer-page">Gomess Produções - Todos os direitos reservados</footer>
<!-- -------------------------------------JANELAS MODAIS --------------------------------------------- -->

<div id="modalExcluirServico" class="modal-container">
    <div class="modal-content">
        <button class="fechar">X</button>
        <h2 class="subtitulo">Tem certeza que deseja excluir esse produto?</h2>
        <form action="<?=URL?>/produtos/excluirProduto/<?=$dados['id']?>">
            <button class="btn-question btn-yes">Sim</button> <a class="btn-question btn-no">Não</a>
        </form>
        
    </div>
</div>



<div id="modalAddEstoque" class="modal-container">
    <div class="modal-content">
        <button class="fechar">X</button>
        <h2 class="subtitulo">Quantidade a ser adicionada:</h2>
        <form action="<?=URL?>/produtos/addEstoque/<?=$dados['id']?>">
            <input type="text" name="add_quant" placeholder="Quantidade a ser adicionada">
            <button class="btn-question btn-yes">Adicionar</button> <a class="btn-question btn-no">Cancelar</a>
        </form>
        
    </div>
</div>


    <script src="<?=URL?>/js/script-page.js"></script>

    <script>
         /* Janelas Modais */
     function iniciaModal(modalID){
        const modal = document.getElementById(modalID);
        if(modal){
            modal.classList.add('mostrar');
             modal.addEventListener('click',(e)=>{
            if(e.target.id == modalID || e.target.className == 'fechar' || e.target.className == 'link-button-modal' || e.target.className == 'btn-question btn-no' || e.target.className == 'btn-question btn-yes' || e.target.id == 'btn-vincular' ){
                modal.classList.remove('mostrar');
            }
        });
        }
        
    }

    const botaoAdicionarEstoque = document.querySelector("#botaoAddEstoque");
    botaoAdicionarEstoque.addEventListener('click', ()=>{
        iniciaModal('modalAddEstoque');
    }); 
    // const botaoAlterarProduto = document.querySelector("#botaoAlterarProduto");
    // botaoAlterarProduto.addEventListener('click', ()=>{
    //     iniciaModal('modalProduto');
    // }); 
/* ------------------------------------------------------------------------------------------- */

    // let modalNome = document.querySelector('.modal-nome-produto'),
    //     campoNome = document.querySelector('#nome_produto'),
    //     modalMarca = document.querySelector('.modal-marca-produto'),
    //     campoMarca = document.querySelector('#marca_produto')
    //     modalModelo = document.querySelector('.modal-modelo-produto'),
    //     campoModelo = document.querySelector('#modelo_produto'),
    //     modalQuant = document.querySelector('.modal-quant-produto'),
    //     campoQuant = document.querySelector('#quant_produto'),
    //     modalPreco = document.querySelector('.modal-preco-produto'),
    //     campoPreco = document.querySelector('#preco_produto'),
    //     modalDescricao = document.querySelector('.modal-descricao-produto'),
    //     campoDescricao = document.querySelector('#descricao_produto'),

      
    //     /* ---------------------------- */

    //     modalNome.value = campoNome.value
    //     modalMarca.value = campoMarca.value
    //     modalModelo.value = campoModelo.value
    //     modalQuant.value = campoQuant.value
    //     modalPreco.value = campoPreco.value
    //     modalDescricao.value = campoDescricao.value

    //     /* ------------------------------ */

    //     campoNome.addEventListener('keyup',()=>{
    //         modalNome.value = campoNome.value
    //     });
    //     campoMarca.addEventListener('keyup',()=>{
    //         modalMarca.value = campoMarca.value
    //     });
    //     campoModelo.addEventListener('keyup',()=>{
    //         modalModelo.value = campoModelo.value
    //     });
    //     campoQuant.addEventListener('keyup',()=>{
    //         modalQuant.value = campoQuant.value
    //     });
    //     campoPreco.addEventListener('keyup',()=>{
    //         modalPreco.value = campoPreco.value
    //     });
    //     campoDescricao.addEventListener('keyup',()=>{
    //         modalDescricao.value = campoDescricao.value
    //     });
    </script>
</body>
</html>