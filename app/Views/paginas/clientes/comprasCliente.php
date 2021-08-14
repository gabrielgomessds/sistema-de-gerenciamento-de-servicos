<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras Realizadas</title>
    <link rel="stylesheet" href="<?=URL?>/css/style.css">
    <link rel="icon" href="<?=URL?>/images/icone-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>

    <section class="section-page">
      
            <div class="container-page vendas-realizadas">
           
                <?php foreach($dados['cliente'] as $cliente):?>
                    <a href="<?=URL?>/clientes/infoCliente/<?=$cliente->id?>" class="voltar"><i class="bi bi-arrow-left"></i> Voltar</a>
                <fieldset><h2>Compras feita por <?=$cliente->nome_cliente?> <i class="bi bi-tools"></i></h2></fieldset> 
                <?php endforeach;?>
                <div class="search">
                    <div class="content-search">
                        <input type="text" class="search" id="filtrar-tabela-compras" placeholder="Pesquisar por data do serviço...">
                    </div>
                </div>

                <div class="div-table">
                    <table class="table-default product">
                        <thead>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Valor Unit.</th>
                            <th>Desconto</th>
                            <th>Total Pagar</th>
                            <th>Data</th>
                           
                            <th>Informações</th>
                           
                        </thead>
                        <tbody>
                            <tr class="tabela-compras">
                                <td>Notebook Lenovo</td>
                                <td>1</td>
                                <td>10,50</td>
                                <td>0,00</td>
                                <td>10,50</td>
                                <td class="nome-produto">11/08/2021</td>
                                <td><i class="bi bi-clipboard-data"></i></td>
                            </tr>
                            <tr class="tabela-compras">
                                <td>Notebook Lenovo</td>
                                <td>1</td>
                                <td>10,50</td>
                                <td>0,00</td>
                                <td>10,50</td>
                                <td class="nome-produto">12/06/2021</td>
                                <td><i class="bi bi-clipboard-data"></i></td>
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