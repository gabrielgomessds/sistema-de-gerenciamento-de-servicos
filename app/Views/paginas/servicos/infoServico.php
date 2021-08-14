<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações do Serviço</title>
    <link rel="stylesheet" href="<?=URL?>/css/style.css">
    <link rel="icon" href="<?=URL?>/images/icone-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>

    <section class="section-page">
      
            <div class="container-page">
                <a href="<?=URL?>/admins/home" class="voltar"><i class="bi bi-arrow-left"></i> Voltar</a>
          
                <fieldset><h2>Informações do Serviço <i class="bi bi-tools"></i></h2></fieldset> 
                <fieldset>
                    <h2>Dados do Cliente <i class="bi bi-person-fill"></i></h2>
                   
                </fieldset> 
                <?=Sessao::mensagem('servico');?>
               <?php foreach($info['servico'] as $servico):?>
                <div class="data-client">
        
                <div class="name_client info_client">
                    <span><i class="bi bi-person-fill"></i> Nome: </span>
                    <p> <?=$servico->nome_cliente?></p>
                </div>
                <div class="address_client info_client">
                    <span><i class="bi bi-pin-map-fill"></i> Endereço: </span>
                    <p><?=$servico->endereco_cliente?></p>
                </div>
                <div class="phone_client info_client">
                    <span><i class="bi bi-telephone-fill"></i> Telefone: </span>
                    <p><?=$servico->telefone_cliente?></p>
                </div>
        
                <div class="cpf_cnpj_client info_client">
                    <span><i class="bi bi-person-badge"></i> CPF/CNPJ: </span>
                    <p><?=$servico->cpf_cnpj_cliente?></p>
                </div>

                <div class="date_buy info_client">
                    <span><i class="bi bi-laptop"></i> Aparelho: </span>
                    <p><?=$servico->aparelho_cliente?> <?=$servico->marca_aparelho?> <?=$servico->modelo_aparelho?></p>
                </div>
                
                <div class="date_buy info_client">
                    <span><i class="bi bi-calendar-week-fill"></i> Entrada: </span>
                    <p><?=Checa::dataBr($servico->data_entrada)?></p>
                </div>

                
            </div>
            <hr/>
            <div class="data-product">
    
    
        <div class="problem_product info_produtct">
            <span>Problema:</span>
            <p><?=$servico->problema_aparelho?></p>
        </div>
  
     </div>

             <!-- --------------------------------------------------------------------------------------------------------------------- -->  
           
             <form method="post" name="form_venda_produto">
            <textarea name="solucao_aparelho" class="campo_solucao" placeholder="Solução para o problema"></textarea>

             <table>

                 <tr>
                     <td><label>Data do Concerto: </label></td>
                     <td class="campo"><input type="text" class="data_concerto" id="data_servico" name="data_concerto" value="" placeholder="Data do concerto"></td>
                 </tr>
             </table>
             
           <!-- ------------------------------------------------------------------------------------------- -->
          
           <div class="div-table">
            
           <?php
                if($info['vendas'] == 0):
                
           ?>
            <fieldset><h2>Nenhum produto adicionando ao serviço <i class="bi bi-cart4"></i></h2></fieldset>
           <?php
                else:
            
           ?>
                      <fieldset><h2>Produtos Adicionados <i class="bi bi-cart4"></i></h2></fieldset>

               <table class="table-default">
                <tr>
                    <th>Produto</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Quant.</th>
                    <th>Valor Unit.</th>
                    <th>Valor Total</th>
                    <th>Excluir</th>
                </tr>
               <?php foreach($info['vendaProduto'] as $vendas):?>
                <tr>
                    <td><?=$vendas->nome_produto?></td>
                    <td><?=$vendas->marca_produto?></td>
                    <td><?=$vendas->modelo_produto?></td>
                    <td class="quant_produto"><?=$vendas->quant_venda?></td>
                    <td class="preco_produto"><?=$vendas->preco_produto?></td>
                    <td class="total_produto"></td>
                    <td><i class="bi bi-trash-fill botaoExcluirProduto" id="<?=$vendas->id_produto?>"></i></td>
                </tr>
                <?php endforeach;?>
                
              </table>
           <?php endif;?>

        


          </div>
          
              <table>
                  <tr>
                      <td> <label>Valor do serviço: </label></td>
                      <td class="campo"><input type="text" name="valor_servico"  onkeypress="return filtroTeclas(event)" onblur="calcular();" id="servico" value="" placeholder="00,00"></td>
                  </tr>
                  <tr>
                      <td> <label>Desconto: </label></td>
                      <td class="campo"><input type="text" name="valor_desconto"  onkeypress="return filtroTeclas(event)" onblur="calcular();" id="desconto" value="" placeholder="00,00"></td>
                  </tr>
                
              </table>
            <input type="hidden" id="servico" value="0">
               
            </tr>
         
          <fieldset>
            <input type="hidden" id="servico" value="0">
               
            </tr>
          </fieldset>
          
           <fieldset>
            TOTAL A PAGAR: <b id="pagar"></b>R$
        </fieldset>
       
      <div class="buttons-container-page">
        <button onclick="return false" class="btn btn-print-out " id="botaoChamaProdutos"> 
            <i class="bi bi-plus-lg"></i> Adicionar Produto
        </button>

        <a href="<?=URL?>/notas/entradaAparelho/<?=$servico->ServicoID?>" class="link__button" target="_blank">

            <i class="bi bi-printer"></i> Nota de Entrada
       </a>

        <button onclick="return false" class="btn btn-finalizar" id="botaoFinalizarServico">
             Finalizar Serviço <i class="bi bi-check-lg"></i>
        </button>

        <button onclick="return false" class="btn btn-excluir" id="botaoexcluirServico">
            Cancelar Serviço <i class="bi bi-trash-fill"></i>
       </button>

        </form>
        <?php endforeach;?>
    </div>
</section>

<footer class="footer-page">Gomess Produções - Todos os direitos reservados</footer>
<!-- -------------------------------------JANELAS MODAIS --------------------------------------------- -->


<div id="modalFinalizarServico" class="modal-container">
    <div class="modal-content">
        <button class="fechar">X</button>
        <h2 class="subtitulo">Tem certeza que deseja finalizar essa serviço?</h2>
        <form action="<?=URL?>/servicos/finalizarServico" method="POST">
            <input type="text" name="id_servico" value="<?=$servico->ServicoID?>" hidden>
            <?php foreach($info['idVenda'] as $venda):?>
                        <input type="text" name="id_venda" id="id_venda" value="<?=$venda->id?>" hidden>
            <?php endforeach;?>
            <input type="text" name="data_concerto" class="campo_data" hidden>
            <input type="text" name="solucao_aparelho" class="solucao_aparelho" hidden>
            <input type="text" name="valor_servico" class="valor_servico" hidden>
            <input type="text" name="valor_produtos" class="valor_venda" hidden>
            <input type="text" name="total_pagar" class="total_pagar" hidden>
            <input type="text" name="desconto" class="total_desconto" hidden>
            <button class="btn-question btn-yes">Sim</button> <a class="btn-question btn-no">Não</a>
        </form>
        
    </div>
</div>

<div id="modalExcluirServico" class="modal-container">
    <div class="modal-content">
        <button class="fechar">X</button>
        <h2 class="subtitulo">Tem certeza que deseja cancelar esse serviço?</h2>
        <form action="<?=URL?>/servicos/excluirServico" method="POST">
            <?php foreach($info['servico'] as $servico):?>
                        <input type="text" name="id_servico" value="<?=$servico->ServicoID?>" hidden>
            <?php endforeach;?>
            <?php foreach($info['idVenda'] as $venda):?>
                        <input type="text" name="id_venda" id="id_venda" value="<?=$venda->id?>" hidden>
             <?php endforeach;?>
            <?php foreach($info['vendaProduto'] as $produtosVenda):?>
                <input type="text" name="id_produto[]" value="<?=$produtosVenda->id?>" hidden>
                <input type="text" name="quant_venda[]" value="<?=$produtosVenda->quant_venda?>" hidden>
           <?php endforeach;?>
            <button class="btn-question btn-yes">Sim</button> <a class="btn-question btn-no">Não</a>
        </form>
        
    </div>
</div>

<div id="modalTabelaProdutos" class="modal-container ">
    <div class="modal-content table">
        <button class="fechar">X</button>
        <h2 class="subtitulo">Adicionar Produto ao serviço</h2>
        <div class="search">
            <div class="content-search">
                <input type="text" class="search" id="filtrar-tabela-produto-modal" placeholder="Pesquisar produto..."><button><i class="bi bi-search"></i></button>
            </div>
        </div>
        <div class="table-modal-product">
            <table>
                <thead>
                    <tr>
                        <td>Produto</td>
                        <td>Marca</td>
                        <td>Modelo</td>
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
                            <td><?=$produto->modelo_produto?></td>
                            <td><?=$produto->quant_produto > 0 ? $produto->quant_produto : '<b style="color:red">'.$produto->quant_produto.'</br>'?></td>
                            <td ><?=str_replace(".",",",$produto->preco_produto);?>R$</a></td>
                            <td><i class="bi bi-plus-circle-fill <?=$produto->quant_produto > 0 ? "botaoAddProduto" : 'estoqueVazio'?>"  id="<?=$produto->id?>"></i></td>
                        
                        </tr>
                <?php endforeach;?>
    
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modalAddProduto" class="modal-container">
    <div class="modal-content">
        <button class="fechar">X</button>
        <h2 class="subtitulo">Adicionar  <b class="nomeProdutoAqui"></b></h2>
            <form action="<?=URL?>/servicos/addProdutoServico" method="POST">
                    Quant: <input type="text" name="quant_venda" value="1">
                    <input type="text" name="id_produto" id="id_produto" hidden>
                    <?php foreach($info['idVenda'] as $venda):?>
                        <input type="text" name="id_venda" id="id_venda" value="<?=$venda->id?>" hidden>
                    <?php endforeach;?>
                       
                    
                    
                    <input type="text" class="data_venda" name="data_compra" hidden>
                    <?php foreach($info['servico'] as $servico):?>
                        <input type="text" name="id_cliente" id="id_compra_cliente" value="<?=$servico->clientesID?>" hidden>
                        <input type="text" name="id_servico" value="<?=$servico->ServicoID?>" hidden>
                    <?php endforeach;?>
                    <button class="btn-question btn-yes">Adicionar</button> <a class="btn-question btn-no">Cancelar</a>
            </form>
    </div>
</div>

<div id="modalExcluirProduto" class="modal-container">
    <div class="modal-content">
        <button class="fechar">X</button>
        <h2 class="subtitulo">Excluir <b class="nomeProdutoCompraAqui"></b> da compra</h2>
        <form action="<?=URL?>/servicos/excluirProdutoServico">
            <input type="text" name="id_produto" id="id_produto_compra" hidden>
            <?php foreach($info['idVenda'] as $venda):?>
                        <input type="text" name="id_venda" id="id_venda" value="<?=$venda->id?>" hidden>
            <?php endforeach;?>
            <?php foreach($info['servico'] as $servico):?>
                        <input type="text" name="id_servico" value="<?=$servico->ServicoID?>" hidden>
            <?php endforeach;?>
            <button class="btn-question btn-yes">Sim</button> <a class="btn-question btn-no">Não</a>
        </form>
    </div>
</div>


    <script src="<?=URL?>/js/script-page.js"></script>
                <script>
                    let data_servico = document.querySelector("#data_servico");
                    var data = new Date();
                    var dia = String(data.getDate()).padStart(2, '0');
                    var mes = String(data.getMonth() + 1).padStart(2, '0');
                    var ano = data.getFullYear();
                    data_servico.value = dia + '/' + mes + '/' + ano;

                    let data_venda = document.querySelector(".data_venda");
                    var data = new Date();
                    var dia = String(data.getDate()).padStart(2, '0');
                    var mes = String(data.getMonth() + 1).padStart(2, '0');
                    var ano = data.getFullYear();
                    data_venda.value = ano + '-'  + mes  + '-' + dia;
                    /* ________________________________________________ */

                    let textarea = document.querySelector('.campo_solucao');
                    let campo = document.querySelector('.solucao_aparelho');
                    textarea.addEventListener('keyup', ()=>{
                        campo.value = textarea.value;
                    });
                    /* ____________________________________________________ */
                    let campoData = document.querySelector('.data_concerto');
                    let dataConcerto = document.querySelector('.campo_data');
                    dataConcerto.value = campoData.value;
                    campoData.addEventListener('keyup', ()=>{
                        dataConcerto.value = campoData.value;
                    });
                    /* ____________________________________________________ */
                    let servico = document.querySelector('#servico');
                    let valorServico = document.querySelector('.valor_servico');
                    servico.addEventListener('keyup', ()=>{
                        valorServico.value = servico.value.replace(',','.');
                    });
                    
                </script>
</body>
</html>