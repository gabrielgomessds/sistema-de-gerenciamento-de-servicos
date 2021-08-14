<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendas Realizadas</title>
    <link rel="stylesheet" href="<?=URL?>/css/style.css">
    <link rel="icon" href="<?=URL?>/images/icone-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>

    <section class="section-page">
      
            <div class="container-page vendas-realizadas">
            <a href="<?=URL?>/admins/home" class="voltar"><i class="bi bi-arrow-left"></i> Voltar</a>
                <fieldset><h2>Vendas Relizadas <i class="bi bi-cart4"></i></h2></fieldset> 
                <div class="search">
                    <div class="content-search">
                        <input type="text" class="search" id="filtrar-tabela-compras" placeholder="Pesquisar cliente...">
                    </div>
                </div>

                <div class="div-table">
                    <table class="table-default product">
                        <thead>
                            <th>Cliente</th>
                            <th>Produto</th>
                            <th>Marca</th>
                            <th>Quant</th>
                            <th>Valor Pago</th>
                            <th>Data</th>
                            <th>Nota</th>
                            <th>Alterar</th>
                            <th>Excluir</th>
                        </thead>
                        <tbody>
                            <tr class="tabela-compras">
                                <td class="nome-cliente">Gabriel Gomes</td>
                                <td>Mouse</td>
                                <td>Aos</td>
                                <td class="quant_produto">1</td>
                                <td class="valor_produto">120,00</td>
                                <td>15/5/2021</td>
                                <td><i class="bi bi-printer-fill"></i></td>
                                <td><a href=""><i class="bi bi-pencil-fill"></i></a></td>
                                <td><i class="bi bi-trash-fill botaoExcluirCompra" id="1"></i></td>
                            </tr>
                            <tr class="tabela-compras">
                                <td class="nome-cliente">Roberio Cunha</td>
                                <td>+Mouse</td>
                                <td>Aos</td>
                                <td class="quant_produto">1</td>
                                <td class="valor_produto">120,00</td>
                                <td>15/5/2021</td>
                                <td><i class="bi bi-printer-fill"></i></td>
                                <td><a href=""><i class="bi bi-pencil-fill"></i></a></td>
                                <td><i class="bi bi-trash-fill botaoExcluirCompra" id="1"></i></td>
                            </tr>
                            <tr class="tabela-compras">
                                <td class="nome-cliente">Felipe Oliveira</td>
                                <td>+Mouse</td>
                                <td>Aos</td>
                                <td class="quant_produto">1</td>
                                <td class="valor_produto">120,00</td>
                                <td>15/5/2021</td>
                                <td><i class="bi bi-printer-fill"></i></td>
                                <td><a href=""><i class="bi bi-pencil-fill"></i></a></td>
                                <td><i class="bi bi-trash-fill botaoExcluirCompra" id="1"></i></td>
                            </tr>
                            <tr class="tabela-compras">
                                <td class="nome-cliente">Renato Alexandre</td>
                                <td>+Mouse</td>
                                <td>Aos</td>
                                <td class="quant_produto">1</td>
                                <td class="valor_produto">120,00</td>
                                <td>15/5/2021</td>
                                <td><i class="bi bi-printer-fill"></i></td>
                                <td><a href=""><i class="bi bi-pencil-fill"></i></a></td>
                                <td><i class="bi bi-trash-fill botaoExcluirCompra" id="1"></i></td>
                            </tr>
                        </tbody>
                    </table>
                 </div>


                 
    </div>
</section>

<footer class="footer-page">Gomess Produções - Todos os direitos reservados</footer>


<div id="modalExcluirCompra" class="modal-container">
    <div class="modal-content">
        <button class="fechar">X</button>
        <h2 class="subtitulo">Excluir a compra de <b class="nomeProdutoCompraAqui"></b></h2>
        <form action="">
            <input type="text" name="id_produto" id="id_produto_compra" hidden >
            <button class="btn-question btn-yes">Sim</button> <a class="btn-question btn-no">Não</a>
        </form>
    </div>
</div>

<script>
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

    const botaoExcluirCompra = document.querySelectorAll('.botaoExcluirCompra');
    const nomeProdutoCompraAqui = document.querySelector(".nomeProdutoCompraAqui");
    botaoExcluirCompra.forEach((e) => {
        e.addEventListener('click', function(botao) {
        var prodID = botao.target.id;
        console.log(prodID)
        document.getElementById('id_produto_compra').value = prodID
        nomeProdutoCompraAqui.innerHTML = e.parentNode.parentNode.childNodes[1].innerHTML;
        iniciaModal("modalExcluirCompra", prodID);
});
})

/* Filtro para a tabela produto */
    //pegando valor de um campo de texto
    var campoFiltro = document.querySelector("#filtrar-tabela-compras");
    //o input verifica o que foi digitado
    campoFiltro.addEventListener("input",function(){
        /* console.log(this.value); */
        //aqui pega o tr
        var users = document.querySelectorAll(".tabela-compras");
        
        if(this.value.length > 0){
            for(var i =0;i<users.length;i++){
                var user = users[i];
                //buscando dentro do td o nome
                var tdNome = user.querySelector(".nome_produto");
                var nome = user.textContent;  
                //RegExp expresão regular que busca, usando o i informa que pode ser maiscula ou minuscula
                var expressao = new RegExp(this.value,"i");
                if( !expressao.test(nome)){
                    //adiciona a class invisivel
                    user.classList.add("invisivel");
                }else{
                    //remove a class invisivel
                    user.classList.remove("invisivel");
                }
            }
        }else{
            for(var i = 0;i < users.length;i++){
                var user = users[i];
                user.classList.remove("invisivel");
            }
        }
        
    });
</script>
</body>
</html>