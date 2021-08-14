<?php
  
    Sessao::estaLogado($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=URL?>/css/style.css">
    <link rel="icon" href="<?=URL?>/images/icone-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Adicionar Serviço</title>
</head>
<body>

<section class="section-page">
            <div class="container-page">
                <a href="<?=URL?>/admins/home" class="voltar"><i class="bi bi-arrow-left"></i> Voltar</a>

                
                <fieldset><h2>Adicionar Serviço <i class="bi bi-calendar-plus-fill"></i></h2></fieldset> 
                <fieldset><h2>Dados do Cliente <i class="bi bi-people-fill"></i></h2></fieldset>  
                <div class="for-button">
              <button class="btn-add" id="botaoTabelaClientes"> Vincular Cliente <i class="bi bi-person-plus-fill"></i></button>
            </div>
                <?=Sessao::mensagem('servico');?>
                <form method="post" action="<?=URL?>/servicos/cadastrar">
           <table>
           <input type="text" name="id_cliente" id="id_cliente" hidden>
               <tr>
                    <td><label>Nome: </label></td>
                    <td class="campo"><input type="text"  id="nome_cliente" name="nome_cliente" placeholder="Digite o nome do cliente ou empresa"></td>

               </tr>

               <tr>
                   <td><label>Telefone: </label></td>
                   <td class="campo"><input type="text" name="telefone_cliente" id="telefone_cliente"  placeholder="Digite o telefone do cliente"></td>
                   
               </tr>

               <tr>
                <td><label>Endereço: </label></td>
                <td class="campo"><input type="text" id="endereco_cliente"  name="endereco_cliente"  placeholder="Digite o endereço do cliente"></td>
                
            </tr>
            <tr>
              <td><label>CPF/CNPJ: </label></td>
              <td class="campo"><input type="text" name="cpf_cnpj_cliente" id="cpf_cliente"  placeholder="Digite o CPF ou CNPJ do cliente"></td>
              
          </tr>

           </table>

           <fieldset><h2>Aparelho do Cliente <i class="bi bi-laptop"></i></h2></fieldset>             
             
          
             <table>
              <tr>  
                  <td> <label>Aparelho: </label></td> 
                  <td class="campo"><input type="text" name="aparelho_cliente" id="aparelho_cliente" placeholder="Digite o nome do aparelho"></td>
              </tr>

              <tr>   
                  <td><label>Marca: </label></td>
                  <td class="campo"><input type="text" name="marca_aparelho" id="marca_aparelho" placeholder="Digite a marca marca do parelho"></td>                
              </tr>

              <tr>   
                <td><label>Modelo: </label></td>
                <td class="campo"><input type="text" name="modelo_aparelho" id="modelo_aparelho" placeholder="Digite o modelo do aparelho"></td>                
            </tr>
             <tr>   
                 <td><label>Problema: </label></td>
                 <td class="campo"><textarea name="problema_aparelho" id="" placeholder="Qual o problema relatado pelo cliente"></textarea></td>
             </tr>

                 <tr>
                     <td><label>Data de Entrada: </label></td>
                     <td class="campo"><input type="text" name="data_entrada" id="data_entrada" placeholder="Data de entrada"></td>
                 </tr>
             </table>
           <fieldset>
            <button class="btn-finalizar"><i class="bi bi-plus-lg"></i> Adicionar Serviço</button>

           </fieldset>
      
        </form>
      
    </div>
</section>


<footer class="footer-page">Gomess Produções - Todos os direitos reservados</footer>
        <!-- -----------------------------------------------JANELAS MODAIS---------------------------------------------- -->
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


    <!-- ------------------------------------------------------------------------------------------------------ -->

        <script src="https://unpkg.com/imask"></script>
    <script>
        /* Mascara para o telefone e cpf do cliente */
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

    /* Filtro para a tabela modal cliente */
    //pegando valor de um campo de texto
    var campoFiltro = document.querySelector("#filtrar-tabela-cliente-modal");
    //o input verifica o que foi digitado
    campoFiltro.addEventListener("input",function(){
        console.log(this.value);
        //aqui pega o tr
        var users = document.querySelectorAll(".tabela-cliente-modal");
        
        if(this.value.length > 0){
            for(var i =0;i<users.length;i++){
                var user = users[i];
                //buscando dentro do td o nome
                var tdNome = user.querySelector(".nome_cliente");
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

    function buttonClose(){
                    const alert = document.querySelector(".alert");
                    alert.style.display = 'none';
                 }

            /* Janelas Modais */
     function iniciaModal(modalID){
        const modal = document.getElementById(modalID);
        if(modal){
            modal.classList.add('mostrar');
             modal.addEventListener('click',(e)=>{
            if(e.target.id == modalID || e.target.className == 'fechar' || e.target.className == 'btn-question btn-no' || e.target.className == 'btn-question btn-yes' || e.target.id == 'btn-vincular'){
                modal.classList.remove('mostrar');
            }
        });
        }
        
    }


          const botaoTabelaClientes = document.querySelector("#botaoTabelaClientes");
          botaoTabelaClientes.addEventListener('click', ()=>{
              iniciaModal('modalTabelaClientes');
          }); 


       /* ------------------------------------------------------------------------------------------------ */
        /* Script para pegar dados da tabela cliente */
        var nome = document.getElementById('nome_cliente'),
        endereco = document.getElementById('endereco_cliente'),
        telefone = document.getElementById('telefone_cliente'),
        cpf = document.getElementById('cpf_cliente'),
        id = document.getElementById('id_cliente'),
        tdNome = null,
        tdId = null,
        tdCpf = null,
        tdTelefone = null,
        tdEndereco = null;

   
    function adicionar(id_alvo) {
        var trID = document.getElementById(id_alvo);
        tdNome = trID.querySelector('[data-nome]').dataset.nome;
        tdEndereco = trID.querySelector('[data-endereco]').dataset.endereco;
        tdTelefone = trID.querySelector('[data-telefone]').dataset.telefone;
        tdId = trID.querySelector('[data-id]').dataset.id;
        tdCpf = trID.querySelector('[data-cpf]').dataset.cpf;

        id.value = tdId;
        nome.value = tdNome;
        endereco.value = tdEndereco;
        telefone.value = tdTelefone;
        cpf.value = tdCpf;

        
    }

    var data = new Date();
    var data_entrada = document.getElementById('data_entrada');
    var dia = String(data.getDate()).padStart(2, '0');
    var mes = String(data.getMonth() + 1).padStart(2, '0');
    var ano = data.getFullYear();
    data_entrada.value = dia + '/' + mes + '/' + ano;
          </script>
</body>
</html>
