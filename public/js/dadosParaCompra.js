 /* ____________________________________________FECHAR ALERT___________________________________________________________ */
 function buttonClose(){
    const alert = document.querySelector(".alert");
   alert.style.display = 'none';
 }


 /* ______________________________________CHAMAR JANELA MODAL______________________________________________________________ */

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

    const botaoChamaProdutos = document.querySelector("#botaoChamaProdutos");
    botaoChamaProdutos.addEventListener('click', ()=>{
        iniciaModal('modalTabelaProdutos');
    }); 

    const botaoTabelaClientes = document.querySelectorAll('.botaoTabelaClientes');
    botaoTabelaClientes.forEach((e) => {
        e.addEventListener('click', function(botao) {
        var prodID = botao.target.id;
        document.getElementById('id_produto').value = prodID
        iniciaModal("modalTabelaClientes", prodID);
});
})
    
    const botaoAddProduto = document.querySelectorAll('.botaoAddProduto');
    const nomeProdutoAqui = document.querySelector(".nomeProdutoAqui");
    botaoAddProduto.forEach((e) => {
        e.addEventListener('click', function(botao) {
        var prodID = botao.target.id;
      /*   console.log(prodID) */
        document.getElementById('id_produto').value = prodID
        nomeProdutoAqui.innerHTML = e.parentNode.parentNode.childNodes[1].innerHTML +" "+ e.parentNode.parentNode.childNodes[3].innerHTML;
        iniciaModal("modalAddProduto", prodID);
});
})


        /* Script para pegar dados da tabela cliente */
        var nome = document.getElementById('nome_cliente'),
        endereco = document.getElementById('endereco_cliente'),
        telefone = document.getElementById('telefone_cliente'),
        cpf = document.getElementById('cpf_cliente'),
        id = document.getElementById('id_cliente'),
        /* _____________________________________________________ */
        id_cliente = document.getElementById('id_compra_cliente'),
        nome_cliente = document.getElementById('nome_compra_cliente'),
        telefone_cliente = document.getElementById('telefone_compra_cliente'),
        endereco_cliente = document.getElementById('endereco_compra_cliente'),
        cpf_cnpj_cliente = document.getElementById('cpf_cnpj_compra_cliente'),
        /* ____________________________________________________________ */
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
        /* ______________________________________ */
        id_cliente.value = tdId;
        nome_cliente.value = tdNome;
        telefone_cliente.value = tdTelefone;
        endereco_cliente.value = tdEndereco;
        cpf_cnpj_cliente.value = tdCpf;

        
    }

    /* ___________________________TRASFERIR DADOS PARA O FORM NO MODAL DE PRODUTO_____________________________________________ */
   
    var cliente_nome = document.querySelector('#nome_cliente');
    var nome_model = document.querySelector('#nome_compra_cliente');
    cliente_nome.addEventListener('keyup', function () {
        nome_model.value = cliente_nome.value;

        });

    var cliente_telefone = document.querySelector('#telefone_cliente');
    var telefone_model = document.querySelector('#telefone_compra_cliente');
    cliente_telefone.addEventListener('keyup', function () {
        telefone_model.value = cliente_telefone.value;

        });

        var cliente_endereco = document.querySelector('#endereco_cliente');
    var endereco_model = document.querySelector('#endereco_compra_cliente');
    cliente_endereco.addEventListener('keyup', function () {
        endereco_model.value = cliente_endereco.value;

        });

        var cliente_cpf_cnpj = document.querySelector('#cpf_cliente');
    var cpf_cnpj_model = document.querySelector('#cpf_cnpj_compra_cliente');
    cliente_cpf_cnpj.addEventListener('keyup', function () {
        cpf_cnpj_model.value = cliente_cpf_cnpj.value;

        });


        /* ____________________PEGAR A DATA ATUAL______________________________________________________________________ */
        
        let data_compra = document.querySelector("#data_compra");
        var data = new Date();
        var dia = String(data.getDate()).padStart(2, '0');
        var mes = String(data.getMonth() + 1).padStart(2, '0');
        var ano = data.getFullYear();
        data_compra.value = dia + '/' + mes + '/' + ano;
    