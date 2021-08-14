<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Serviço</title>
    <link rel="stylesheet" href="<?=URL?>/css/style.css">
    <link rel="icon" href="<?=URL?>/images/icone-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>

    <section class="section-page">
      
            <div class="container-page">
                <a href="<?=URL?>/admins/home" class="voltar"><i class="bi bi-arrow-left"></i> Voltar</a>
          
                <fieldset><h2>Editar Serviço <i class="bi bi-tools"></i></h2></fieldset> 
                <fieldset>
                    <h2>Dados do Cliente <i class="bi bi-person-fill"></i></h2>
                   
                </fieldset> 
                <?=Sessao::mensagem('servico');?>

               <fieldset><button class="btn-add botaoTabelaClientes" >Mudar Cliente <i class="bi bi-people-fill"></i> </button></fieldset>
               
              
               <?php foreach($info['servico'] as $servico):?>
                <form action="<?=URL?>/servicos/alterarDadosServico" method="POST">
               <table>
               <input type="text" name="id_cliente" id="id_cliente" value="<?=$servico->id?>" hidden>
                <input type="text" name="id_servico" value="<?=$servico->ServicoID?>" hidden>
                <?php foreach($info['idVenda'] as $venda):?>
                    <input type="text" name="id_venda" id="id_venda" value="<?=$venda->id?>" hidden>
                <?php endforeach;?>
                
                <tr>  
                    <td> <label>Nome: </label></td> 
                    <td class="campo"><input type="text" disabled value="<?=$servico->nome_cliente?>" name="nome_cliente" id="nome_cliente" placeholder="Vincular nome do cliente"></td>
                </tr>

                <tr>   
                    <td><label>Telefone: </label></td>
                    <td class="campo"><input type="text" disabled value="<?=$servico->telefone_cliente?>" name="telefone_cliente" id="telefone_cliente" placeholder="Vincular telefone do cliente"></td>                
                </tr>

               <tr>   
                   <td><label>Endereço: </label></td>
                   <td class="campo"><input type="text" disabled value="<?=$servico->endereco_cliente?>" name="endereco_cliente" id="endereco_cliente" placeholder="Vincular endereço do cliente"></td>
               </tr>

               <tr>   
                   <td><label>CPF/CNPJ: </label></td>
                   <td class="campo"><input type="text" disabled value="<?=$servico->cpf_cnpj_cliente?>" name="cpf_cnpj_cliente" id="cpf_cliente" placeholder="Vincular CPF/CNPJ do cliente"></td>           
               </tr>
               </table>
               
            <hr/>
            <div class="data-product">
    
    
       
  
     </div>

             <!-- --------------------------------------------------------------------------------------------------------------------- -->  
           
            
             <?php foreach($info['servico'] as $servico):?>
            <label>Problema do Aparelho:</label>
            <textarea name="problema_aparelho" class="campo_problema" placeholder="Problema do aparelho"><?=$servico->problema_aparelho?></textarea>
            
            <label>Solução do Aparelho:</label>
            <textarea name="solucao_aparelho" class="campo_solucao" placeholder="Solução para o problema"><?=$servico->solucao_aparelho?></textarea>
           
             <table>

                 <tr>
                     <td><label>Entrada: </label></td>
                     <td class="campo"><input type="date" class="data-entrada"  name="data_entrada" value="<?=$servico->data_entrada?>" placeholder="Data do concerto"></td>
                 
                    
                    </tr>

                 <tr>
                     <td><label>Saida: </label></td>
                     <td class="campo"><input type="date" class="data-saida"  name="data_saida" value="<?=$servico->data_saida?>" placeholder="Data do concerto"></td>
                 
                    
                    </tr>
             </table>
             <?php endforeach;?>
             
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
              <?php foreach($info['servico'] as $servico):?>
                  <tr>
                      <td> <label>Valor do serviço: </label></td>
                      <td class="campo"><input type="text" class="valor_servico" name="valor_servico" value="<?=$servico->valor_servico?>" onkeypress="return filtroTeclas(event)" onblur="calcular();" id="servico" value="" placeholder="00,00"></td>
                  </tr>
                  <tr>
                      <td> <label>Desconto: </label></td>
                      <td class="campo"><input type="text" name="valor_desconto" value="<?=$servico->desconto?>"  onkeypress="return filtroTeclas(event)" onblur="calcular();" id="desconto" value="" placeholder="00,00"></td>
                  </tr>
                  <tr>
                      <td> <label>Situação: </label></td>
                      
                      <td class="campo">
                          <select id="select" onChange="update()" name="situacao_aparelho" >
                              <?php 
                                if($servico->situacao_aparelho == '1'):
                              ?>
                                <option value="1" >Finalizado</option>
                                 <option value="0" >Em andamento</option>
                            <?php
                                else:
                            ?>
                                <option value="0" >Em andamento</option>
                                 <option value="1" >Finalizado</option>
                                 
                            <?php
                                endif;
                            ?>
                      </select>
                    </td>
                  </tr>
                <?php endforeach;?>
              </table>
              <input type="text" name="valor_produtos" class="valor_venda" hidden>
            <input type="text" name="total_pagar" class="total_pagar" hidden>
            <input type="text" name="desconto" class="total_desconto" hidden>
               
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

        <button  class="btn btn-update" id="botaoFinalizarServico">
             Alterar Serviço <i class="bi bi-pencil-fill"></i>
        </button>

        <button onclick="return false" class="btn btn-excluir" id="botaoexcluirServico">
            Cancelar Serviço <i class="bi bi-trash-fill"></i>
       </button>
      </div>

      
        </form>
        <?php endforeach;?>
    </div>
</section>

<footer class="footer-page">Gomess Produções - Todos os direitos reservados</footer>
<!-- -------------------------------------JANELAS MODAIS --------------------------------------------- -->

<div id="modalExcluirServico" class="modal-container">
    <div class="modal-content">
        <button class="fechar">X</button>
        <h2 class="subtitulo">Tem certeza que deseja cancelar esse serviço?</h2>
        <form action="<?=URL?>/servicos/excluirServico" method="POST">
            <?php foreach($info['servico'] as $servico):?>
                        <input type="text" name="id_servico" value="<?=$servico->ServicoID?>" >
            <?php endforeach;?>
            <?php foreach($info['idVenda'] as $venda):?>
                        <input type="text" name="id_venda" id="id_venda" value="<?=$venda->id?>" >
             <?php endforeach;?>
            <?php foreach($info['vendaProduto'] as $produtosVenda):?>
                <input type="text" name="id_produto[]" value="<?=$produtosVenda->id?>" >
                <input type="text" name="quant_venda[]" value="<?=$produtosVenda->quant_venda?>" >
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
            </div>
        </div>
    </div>

    <script src="<?=URL?>/js/script-page.js"></script>

                <script>
              
                    /* ________________________________________________ */

                    let campoSolucao = document.querySelector('.campo_solucao');
                    let modalSolucao = document.querySelector('.solucao_aparelho');
                    modalSolucao.value = campoSolucao.value;
                    modalSolucao.addEventListener('keyup', ()=>{
                        campoSolucao.value = modalSolucao.value;
                    });
                    /* ________________________________________________ */
                    let campoProblema = document.querySelector('.campo_problema');
                    let modalProblema = document.querySelector('.problema_aparelho');
                    modalProblema.value = campoProblema.value;
                    modalProblema.addEventListener('keyup', ()=>{
                        campoProblema.value = modalProblema.value;
                    });
                    
                    /* ____________________________________________________ */
                    let campoDataEntrada = document.querySelector('.data-entrada');
                    let dataEntradaModel = document.querySelector('.dataEntradaModel');
                    dataEntradaModel.value = campoDataEntrada.value;
                    campoDataEntrada.addEventListener('keyup', ()=>{
                        dataEntradaModel.value = campoDataEntrada.value;
                    });
                    /* ____________________________________________________ */
                    let campoDataSaida = document.querySelector('.data-saida');
                    let dataSaidaModel = document.querySelector('.dataSaidaModel');
                    dataSaidaModel.value = campoDataSaida.value;
                    campoDataEntrada.addEventListener('keyup', ()=>{
                        dataSaidaModel.value = campoDataSaida.value;
                    });
                    /* ____________________________________________________ */
                    let servico = document.querySelector('#servico');
                    let valorServico = document.querySelector('.valor_servico');
                    valorServico.value = servico.value.replace(',','.');
                    servico.addEventListener('keyup', ()=>{
                        valorServico.value = servico.value.replace(',','.');
                    });
                    /* ____________________________________________________ */

                    function update() {
                        var select = document.getElementById('select');
                        var option = select.options[select.selectedIndex];

                        document.querySelector('.situacao_aparelho').value = option.value;
                    }

                    update();
                                        
                </script>
</body>
</html>