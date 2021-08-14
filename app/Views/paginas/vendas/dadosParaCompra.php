<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vender Produto - Dados para compra</title>
    <link rel="stylesheet" href="<?=URL?>/css/style.css">
    <link rel="icon" href="<?=URL?>/images/icone-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  
</head>
<body>

    <section class="section-page">
      
            <div class="container-page">
            <a href="<?=URL?>/admins/home" class="voltar"><i class="bi bi-arrow-left"></i> Voltar</a>
          
                <fieldset><h2>Venda de Produto <i class="bi bi-cash-coin"></i></h2></fieldset> 
           

               <fieldset><button class="btn-add botaoTabelaClientes" >Adicionar Cliente <i class="bi bi-people-fill"></i> </button></fieldset>
               <?=Sessao::mensagem('venda')?>
               <fieldset><h2>Dados do Cliente <i class="bi bi-people-fill"></i></h2></fieldset>
              
               <table>
                <input type="text" name="id_cliente" id="id_cliente" hidden>
                <tr>  
                    <td> <label>Nome: </label></td> 
                    <td class="campo"><input type="text" name="nome_cliente" id="nome_cliente" placeholder="Vincular nome do cliente"></td>
                </tr>

                <tr>   
                    <td><label>Telefone: </label></td>
                    <td class="campo"><input type="text" name="telefone_cliente" id="telefone_cliente" placeholder="Vincular telefone do cliente"></td>                
                </tr>

               <tr>   
                   <td><label>Endereço: </label></td>
                   <td class="campo"><input type="text" name="endereco_cliente" id="endereco_cliente" placeholder="Vincular endereço do cliente"></td>
               </tr>

               <tr>   
                   <td><label>CPF/CNPJ: </label></td>
                   <td class="campo"><input type="text" name="cpf_cnpj_cliente" id="cpf_cliente" placeholder="Vincular CPF/CNPJ do cliente"></td>           
               </tr>
               </table>
           <!-- ------------------------------------------------------------------------------------------- -->
           <fieldset><h2>Nenhum produto adicionado <i class="bi bi-cart4"></i></h2></fieldset>
         
       
        <div class="buttons-container-page">
            <button class="btn btn-print-out link-button" id="botaoChamaProdutos"><i class="bi bi-plus-lg"></i> Adicionar Produto</button>
            
       </div>
       
      
    </div>
</section>

<footer class="footer-page">Gomess Produções - Todos os direitos reservados</footer>
<!-- -------------------------------------JANELAS MODAIS --------------------------------------------- -->


  <div id="modalTabelaClientes" class="modal-container ">
        <div class="modal-content table">
            <button class="fechar">X</button>
            <h2 class="subtitulo">Vicular cliente ao serviço</h2>
            <div class="search">
                <div class="content-search">
                    <input type="text" class="search" id="filtrar-tabela-cliente-modal" placeholder="Pesquisar cliente..."><button><i class="bi bi-search"></i></button>
                </div>
            </div>
            <div class="table-modal-client">
                <?php if($info['clientes'] == 0):?>
                    <h1 class="text-default">Nenhum cliente cadastrado <i class="bi bi-x-octagon-fill"></i></h1>
                <?php else:?>
                    <table>
                    <thead>
                        <tr>
                            <td>Código</td>
                            <td>Nome</td>
                            <td>Telefone</td>
                            <td>Endereço</td>
                            <td>CPF</td>
                            <td>Vincular</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($info['clientes'] as $cliente):?>
                            <tr id="cliente-<?=$cliente->id?>" class="tabela-modal-cliente">
                                <td data-id="<?=$cliente->id?>"><?=$cliente->id?></td>
                                <td data-nome="<?=$cliente->nome_cliente?>" class="nome_cliente"><?=$cliente->nome_cliente?></td>
                                <td data-telefone = "<?=$cliente->telefone_cliente?>"><?=$cliente->telefone_cliente?></td>
                                <td data-endereco = "<?=$cliente->endereco_cliente?>"><?=$cliente->endereco_cliente?></a></td>
                                <td data-cpf = "<?=$cliente->cpf_cnpj_cliente?>"><?=$cliente->cpf_cnpj_cliente?></td>
                                <td><button ><i class="bi bi-plus-circle-fill" onclick="adicionar('cliente-<?=$cliente->id?>');" id="btn-vincular"></i></button></td>
                             </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <?php endif;?>
                

            </div>
        </div>
    </div>


<div id="modalTabelaProdutos" class="modal-container ">
    <div class="modal-content table">
        <button class="fechar">X</button>
        <h2 class="subtitulo">Adicionar produto a venda</h2>
        <div class="search">
            <div class="content-search">
                <input type="text" class="search" id="filtrar-tabela-produto-modal" placeholder="Pesquisar produto..."><button><i class="bi bi-search"></i></button>
            </div>
        </div>
        <div class="table-modal-product">
            
            <?php if($info['produtos'] == 0):?>
                <h1 class="text-default" style="margin-right: 20%;">Nenhum produto cadastrado <i class="bi bi-x-octagon-fill"></i></h1>
            <?php else:?>

                <table>
                <thead>
                    <tr>
                        <td>Produto</td>
                        <td>Marca/Modelo</td>
                        <td>Estoque</td>
                        <td>Preço</td>
                        <td>Adicionar</td>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($info['produtos'] as $produto):?>
                

                        <tr class="tabela-modal-produto">
                            <td class="nome_produto"><?=$produto->nome_produto?></td>
                            <td><?=$produto->marca_produto?></td>
                            <td><?=$produto->quant_produto > 0 ? $produto->quant_produto : '<b style="color:red">'.$produto->quant_produto.'</br>'?></td>
                            <td ><?=str_replace(".",",",$produto->preco_produto);?>R$</a></td>
                            <td><i class="bi bi-plus-circle-fill <?=$produto->quant_produto > 0 ? "botaoAddProduto" : 'estoqueVazio'?>"  id="<?=$produto->id?>"></i></td>
                        
                        </tr>
                  <?php endforeach;?>

                   
                </tbody>
            </table>

            <?php endif;?>

            
        </div>
    </div>
</div>

<div id="modalAddProduto" class="modal-container">
    <div class="modal-content">
        <button class="fechar">X</button>
        <h2 class="subtitulo">Adicionar  <b class="nomeProdutoAqui"></b></h2>
            <form action="<?=URL?>/vendas/dadosParaCompra" method="POST">
                    Quant: <input type="text" name="quant_venda" value="1">
                    <input type="text" name="id_produto" id="id_produto" hidden>
                    <input type="text" name="id_cliente" id="id_compra_cliente" hidden>
                    <input type="text" name="nome_cliente"     id="nome_compra_cliente" hidden>
                    <input type="text" name="telefone_cliente" id="telefone_compra_cliente" hidden>
                    <input type="text" name="endereco_cliente" id="endereco_compra_cliente" hidden>
                    <input type="text" name="cpf_cnpj_cliente" id="cpf_cnpj_compra_cliente" hidden>
                    <input type="text" name="data_compra" id="data_compra" hidden>
                    <button class="btn-question btn-yes">Adicionar</button> <a class="btn-question btn-no">Cancelar</a>
            </form>
    </div>
</div>



   
    <script src="https://unpkg.com/imask"></script>
    <script src="<?=URL?>/js/dadosParaCompra.js"></script>

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

 
    </script>

</body>
</html>