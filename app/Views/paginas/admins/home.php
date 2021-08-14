<?php

    Sessao::estaLogado($_SESSION['id']);
   
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gerenciamento - Home</title>
    <link rel="stylesheet" href="<?=URL?>/css/style.css">
    <link rel="icon" href="<?=URL?>/images/icone-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
    <header>
        <div class="bar-header">
            <div class="toggle"><i class="bi bi-list"  onclick="toggleMenu();"></i></div>
        </div>
    </header>
    <nav class="menu">
        <div class="user">
            <?php foreach($dados['meusDados'] as $conta):?>
                <?=empty($conta->foto) ? '<i class="bi bi-person-circle"></i>' : '<img class="photo-profile" src='.URL.'/img_user/fotos_admins/'.$conta->foto.'>'?>
                <?php $nome = explode(" ",$conta->nome); ?>
                <p><?=($nome[1] == 'da' or $nome[1] == 'de') ? $nome[0]." ".$nome[1]." ".$nome[2] : $nome[0]." ".$nome[1]?></p>
            <?php endforeach;?>
        
            
        </div>
        <ul>
            <li class="tablinks" onclick="openCity(this, event, 'ContentOne_link')" id="ContentOne_link"><i class="bi bi-calendar2-check-fill"></i> Serviços</li>
            <li class="tablinks" onclick="openCity(this, event, 'ContentTwo_link')" id="ContentTwo_link"><i class="bi bi-cart4"></i> Vendas</li>
            <li class="tablinks" onclick="openCity(this, event, 'ContentSix_link')" id="ContentSix_link"><i class="bi bi-tags-fill"></i> Produtos</li>
            <li class="tablinks" onclick="openCity(this, event, 'ContentThree_link')" id="ContentThree_link"><i class="bi bi-person-square"></i> Admins</li>
            <li class="tablinks" onclick="openCity(this, event, 'ContentFor_link')" id="ContentFor_link"><i class="bi bi-people-fill"></i> Clientes</li>
            <li class="tablinks" onclick="openCity(this, event, 'ContentFive_link')" id="ContentFive_link"><i class="bi bi-gear-fill"></i> Configurações da Conta</li>
            <a href="<?=URL?>/admins/sair" class="link-menu"><li><i class="bi bi-box-arrow-right"></i> Sair</li></a>
        </ul>
    </nav>
    <main class="main">
        <!-- ------------------------------------TABELA COM OS SERVIÇOS------------------------------------------ -->
        <div class="card-table" id="ContentOne">
            <div class="title-card">
                <h2><i class="bi bi-calendar2-check-fill"></i> Serviços</h2>
           </div>
           <?=Sessao::mensagem('servico')?>
            <div class="search">
                <div class="content-search">
                    <input type="text" class="search" id="filtrar-tabela-servico" placeholder="Pesquisar cliente..."><button><i class="bi bi-search"></i></button>
                </div>
            </div>
            
            
        <div class="for-button">
            <a href="<?=URL?>/servicos/cadastrar"> <button class="btn-add"> <i class="bi bi-calendar-plus-fill"></i> Adicionar Serviço</button></a>
        </div>
                <?php
                    if($dados['servicos'] == 0):
                ?>
                    <h1 class="text-default">Nenhum serviço cadastrado <i class="bi bi-x-octagon-fill"></i></h1>
                <?php 
                    else:
                ?>
                        <table> 
                        <thead>
                            <tr>
                                <td>Nome do Cliente</td>
                                <td>Aparelho do Cliente</td>
                                <td>Situação</td>
                                <td>Entrada</td>
                                <td>Informações</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($dados['servicos'] as $servicos):?>
                                <tr class="tabela-servico">
                                    <td class="cliente-servico"><?=$servicos->nome_cliente?></td>
                                    <td><?=$servicos->aparelho_cliente?> <?=$servicos->marca_aparelho?></td>
                                    <td class="<?=$servicos->situacao_aparelho == '0' ? 'emAndamento' : 'finalizado'?>"><?=$servicos->situacao_aparelho == '0' ? 'Em andamento' : 'Finalizado' ?></td>
                                    <td><?=date('d/m/Y',strtotime($servicos->data_entrada))?></td>
                                    <td><a href="<?=$servicos->situacao_aparelho == '0' ? URL.'/servicos/infoServico/'.$servicos->ServicoID : URL.'/servicos/posServico/'.$servicos->ServicoID?>"><button class="btn btn-info">Informações <i class="bi bi-clipboard-data"></i></button></a></td>
                                </tr>
                            <?php endforeach;?>
                            
                        
                        </tbody>
                    </table>
                <?php endif;?>
           
        </div>

        <!-- ---------------------------------------Tabela de Produtos------------------------------------------------- -->
        <div class="card-table" id="ContentTwo">
            <div class="title-card">
                <h2><i class="bi bi-cart4"></i> Vendas Realizadas</h2>
           </div>
           <div class="search">
            <div class="content-search">
                <input type="text" class="search" id="filtrar-tabela-vendas" placeholder="Pesquisar venda..."><button><i class="bi bi-search"></i></button>
            </div>
        </div>
        

                <?php 
                    if($dados['vendas'] == 0):
                ?>
                      <h1 class="text-default">Nenhuma venda cadastrada <i class="bi bi-x-octagon-fill"></i></h1>

                <?php 
                    else:
                ?>
                    <table>
                        <thead>
                            <tr>
                                <td>Nome do Cliente </td>
                                <td>Situação</td>
                                <td>Valor</td>
                                <td>Data</td>
                                <td>Informações</td>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($dados['vendas'] as $vendas):?>
                            <tr class="tabela-venda">
                                <td class="nome-cliente"><?=$vendas->nome_cliente?></td>
                                <td><?=$vendas->situacao == '0' ? '<b class="emAndamento">Aberta</b>' : '<b class="finalizado">Fechada</b>'?></td>
                                <td><?=str_replace(".",",",number_format($vendas->total_pagar,2))?>R$</td>
                                <td><?=implode("/",array_reverse(explode("-",$vendas->data_compra)))?></td>
                                <td><a href="<?=$vendas->situacao == '0' ? URL."/vendas/venderProdutos/$vendas->VendaID" : URL."/vendas/posVenda/$vendas->VendaID"?>"><button class="btn btn-info" >Informações <i class="bi bi-clipboard-data"></i></button></a></td>
                                
                            </tr>
                        <?php endforeach;?>
                    
                        
                        </tbody>
                    </table>
                <?php endif;?>
      
               
        </div>
            <!-- -------------------------------------FORMULARIO PARA ADICIONAR ADMIN---------------------------------------------------- -->
       
            <div class="card-table" id="ContentThree">
       
                <div class="title-card">
                     <h2><i class="bi bi-person-square"></i> Administradores</h2>
                </div>
                <?=Sessao::mensagem('admin');?>
                <div class="search">
                  <div class="content-search">
                  <input type="text" class="search" id="filtrar-tabela-admin" placeholder="Pesquisar admins..."><button><i class="bi bi-search"></i></button>
            </div>
            </div>
                <div class="for-button">
                    <a href="<?=URL?>/admins/cadastrar"> <button class="btn-add"> <i class="bi bi-person-plus-fill"></i> Adicionar Admin</button></a>
                </div>

                            <?php if($dados['admins'] == 0):?>
                                <h1 class="text-default">Nenhum admin cadastrad <i class="bi bi-x-octagon-fill"></i></h1>

                            <?php else:?>
                                        <table>
                                <thead>
                                    <tr>
                                        <td>Nome do Admin</td>
                                        <td>Email</td>
                                        <td>Alterar</td>
                                        <td>Excluir</td>
                                    </tr>
                                </thead>
                                <tbody>
                            
                                <?php foreach($dados['admins'] as $admins):?>
                                    <tr class="tabela-admin">
                                        <td class="nome-admin"><?=$admins->nome?></td>
                                        <td><?=$admins->email?></td>
                                        <td><a href="<?=URL.'/admins/editar/'.$admins->id?>"><button class="btn btn-update" >Alterar <i class="bi bi-pencil-fill"></i></button></a></td>
                                        <td><button class="btn btn-danger botaoExcluirAdmin" id="<?=$admins->id?>">Excluir <i class="bi bi-trash-fill"></i></button></td> 
                                    </tr>
                                <?php endforeach;?>
                                    
                    
                                
                                </tbody>
                            </table>
                            <?php endif;?>
                  
               
            </div>

              <!-- ---------------------------------------Tabela de Produtos------------------------------------------------- -->
        <div class="card-table" id="ContentSix">
            <div class="title-card">
                <h2><i class="bi bi-tags-fill"></i> Produtos</h2>
           </div>
           <?=Sessao::mensagem('produto')?>
           <div class="search">
            <div class="content-search">
                <input type="text" class="search" id="filtrar-tabela-produto" placeholder="Pesquisar produto..."><button><i class="bi bi-search"></i></button>
            </div>
        </div>
      
        <div class="for-button">
            <a href="<?=URL?>/produtos/cadastrar"> <button class="btn-add">Adicionar Produto <i class="bi bi-plus-lg"></i> </button></a>
            <a href="<?=URL?>/vendas/dadosParaCompra"><button class="btn-add">Vender Produto <i class="bi bi-cart4"></i></button></a>

        </div>

                <?php 
                    if($dados['produtos'] == false):
                    ?>
                        <h1 class="text-default">Nenhum produto cadastrado <i class="bi bi-x-octagon-fill"></i></h1>
                    <?php
                    else:
                    ?>
                          <table>
                    <thead>
                        <tr>
                            <td>Nome </td>
                            <td>Marca</td>
                            <td>Estoque</td>
                            <td>Preço</td>
                            <td>Informações</td>
                            
                        </tr>
                    </thead>
                    <tbody>
                      
                    <?php foreach($dados['produtos'] as $produtos):?>
                        <tr class="tabela-produto">
                            <td class="nome-produto"><?=$produtos->nome_produto?></td>
                            <td><?=$produtos->marca_produto?></td>
                            <td><?=$produtos->quant_produto?></td>
                            <td><?=str_replace(".",",",number_format($produtos->preco_produto,2))?>R$</td>
                            <td><a href="<?=URL?>/produtos/infoProduto/<?=$produtos->id?>"><button class="btn btn-info" >Informações <i class="bi bi-clipboard-data"></i></button></a></td>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                </table> 
                    <?php
                    endif;
                    ?>
        
                           
        </div>
        <!-- ------------------------------------------FORMULARIO PARA ADICIONAR CLIENTE------------------------------------------------------- -->
        <div class="card-table" id="ContentFor">
            <div class="title-card">
                <h2><i class="bi bi-people-fill"></i> Clientes Cadastrados</h2>
           </div>
          
           <?=Sessao::mensagem('cliente')?>
           <div class="search">
            <div class="content-search">
                <input type="text" class="search" id="filtrar-tabela-cliente" placeholder="Pesquisar Cliente..."><button><i class="bi bi-search"></i></button>
            </div>
        </div>
      
        <div class="for-button">
            <a href="<?=URL?>/clientes/cadastrar">  <button class="btn-add"> <i class="bi bi-person-plus-fill"></i> Adicionar Cliente</button></a>
        </div>

                <?php if($dados['clientes'] == 0):?>
                    <h1 class="text-default">Nenhum cliente cadastrado <i class="bi bi-x-octagon-fill"></i></h1>

                <?php else:?>
                    <table>
                    <thead>
                        <tr>
                            <td>Nome </td>
                            <td>Endereço</td>
                            <td>Telefone</td>
                            <td>CPF/CNPJ</td>
                            <td>Informações</td>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($dados['clientes'] as $clientes):?>
                          <tr class="tabela-cliente">
                            <td class="nome-cliente"><?=$clientes->nome_cliente?></td>
                            <td><?=$clientes->endereco_cliente?></td>
                            <td><?=$clientes->telefone_cliente?></td>
                            <td><?=$clientes->cpf_cnpj_cliente?></td>
                            <td><a href="<?=URL?>/clientes/infoCliente/<?=$clientes->id?>"><button class="btn btn-info" >Informações <i class="bi bi-clipboard-data"></i></button></a></td>
                        </tr>
                    <?php endforeach;?>
                   
                    </tbody>
                    
                </table>
                <?php endif;?>
                
               
                
        </div>


             <!-- ---------------------------------------Configurações da conta-------------------------------------------------------------- -->

             <div class="card-table" id="ContentFive">
           
                <div class="title-card">
                     <h2><i class="bi bi-gear-fill"></i> Configurações da Conta</h2>
                </div>
                <?=Sessao::mensagem('conta')?>
                <div class="form-update">
                   
                    
                    <?php foreach($dados['meusDados'] as $dados):?>
                        <form method="post" action="<?=URL?>/admins/editarConta/<?=$dados->id?>" enctype="multipart/form-data">
                        
                            <fieldset>   
                                    <label>Nome: </label>
                                    <input type="text" name="nome_admin" value="<?=$dados->nome?>" placeholder="Digite o nome do novo admin">
                            </fieldset>

                            <fieldset>   
                                <label>Email: </label>
                                <input type="text" name="email_admin" value="<?=$dados->email?>" placeholder="Email do Admin">
                            </fieldset>
            
                            <fieldset>   
                                <label>Senha: </label>
                                <input type="password" name="senha_admin" value="<?=$dados->senha?>" placeholder="Senha do admin">
                        </fieldset>
            
                        <fieldset>   
                            <label>Confirmar senha: </label>
                            <input type="password" name="confirmar_senha_admin" value="<?=$dados->senha?>" placeholder="Confirma senha">
                        </fieldset>
                        <fieldset>
                            <label>Foto:</label>
                            <?=empty($dados->foto) ? '' : ' <a href="'.URL.'/admins/excluirFoto/'.$dados->id.'" class="link">Excluir foto de perfil <i class="bi bi-person-square"></i></a>'?>
                            <label class="labelInput" >
                            <input type="file" accept="image/*" id="foto"  name="foto_admin" onchange="loadFile(event)"/>
                            <span><img src="<?=empty($dados->foto) ? URL.'/images/user.svg' : URL.'/img_user/fotos_admins/'.$dados->foto?>" title="Escolha uma imagem" name="foto_admin" id="output"/></span>
                            </label>

                           
                        </fieldset>
                        
                     
                        <fieldset>

                                <button><i class="bi bi-arrow-clockwise"></i>  Atualizar Dados</button>
                              
                        </fieldset>
                       

                        </form>
                        
                   <?php endforeach;?>
                </div>
            </div>
                        

            


        <div class="footer">Gomess Produções - Todos os direitos reservados</div>
    </main>

    
    
     <!-- -----------------------------------------------JANELAS MODAIS---------------------------------------------- -->
    


    <div id="modalExcluirAdmin" class="modal-container">
        <div class="modal-content">
            <button class="fechar">X</button>
            <h2 class="subtitulo">Tem certeza que deseja excluir esse admin?</h2>
            <form action="<?=URL?>/admins/deletarAdmin">
                <input type="text" name="id_admin" id="id_admin" hidden>
                <button class="btn-question btn-yes">Sim</button> 
                <a class="btn-question btn-no">Não</a>
            </form>
        </div>
    </div>


    <div id="modalFinalizarServico" class="modal-container">
        <div class="modal-content">
            <button class="fechar">X</button>
            <h2 class="subtitulo">Tem certeza que deseja finalizar esse serviço?</h2>
            <form action="">
                <input type="text" name="id_servico" id="id_servico"  hidden>
                <button class="btn-question btn-yes">Sim</button> <a class="btn-question btn-no">Não</a>
            </form>
            
        </div>
    </div>
    
  
   <script src="<?=URL?>/js/script.js"></script>
  
</body>
</html>
