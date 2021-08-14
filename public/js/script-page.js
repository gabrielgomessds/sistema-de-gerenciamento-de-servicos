 /* Form para enviar valor */
/* --------------------------------------------------------------------------------------- */
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

    const botaoexcluiServico = document.querySelector("#botaoexcluirServico");
    botaoexcluiServico.addEventListener('click', ()=>{
        iniciaModal('modalExcluirServico');
    }); 

    const botaoChamaProdutos = document.querySelector("#botaoChamaProdutos");
    botaoChamaProdutos.addEventListener('click', ()=>{
        iniciaModal('modalTabelaProdutos');
    }); 

    const botaoFinalizarServico = document.querySelector("#botaoFinalizarServico");
    botaoFinalizarServico.addEventListener('click', ()=>{
        iniciaModal('modalFinalizarServico');
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

    const botaoExcluirProduto = document.querySelectorAll('.botaoExcluirProduto');
    const nomeProdutoCompraAqui = document.querySelector(".nomeProdutoCompraAqui");
    botaoExcluirProduto.forEach((e) => {
        e.addEventListener('click', function(botao) {
        var prodID = botao.target.id;
        console.log(prodID)
        document.getElementById('id_produto_compra').value = prodID
        nomeProdutoCompraAqui.innerHTML = e.parentNode.parentNode.childNodes[1].innerHTML +" "+ e.parentNode.parentNode.childNodes[3].innerHTML;
        iniciaModal("modalExcluirProduto", prodID);
});
})
    /* ------------------------------------------------------------------------------------------------------ */
    /* Calcular Valor */
    function calcular(){
        /* Pegando valores */
        let valor_servico = document.getElementById("servico").value.toString().replace(",",".");
        let valor_desconto = document.getElementById("desconto").value.toString().replace(",",".");
       
        let quantProduto = document.querySelectorAll(".quant_produto");
        let precoProduto = document.querySelectorAll(".preco_produto");
        let tdsValores = document.querySelectorAll('.total_produto');
        let valorVenda = document.querySelector('.valor_venda');
        let valorServico = document.querySelector('.valor_servico');
       
        let total_produto = 0;
        let valorPagar = 0;

        for (var i = 0;i < quantProduto.length; i++ ){
            valorPagar = Number(quantProduto[i].innerHTML) * parseFloat(precoProduto[i].innerHTML.toString().replace(",","."))
            tdsValores[i].innerHTML = valorPagar.toFixed(2);
            total_produto += valorPagar;
            valorVenda.value = total_produto.toFixed(2);
            valorServico.value = valor_servico;
        }
        

        if(valor_desconto.indexOf("%") > -1){
           desconto_final = valor_desconto.replace('%','');
          
            let pagar = document.getElementById("pagar").innerHTML = (total_produto - ((desconto_final / 100) * total_produto)).toFixed(2).replace(".",",")
            /* desconto_porcent =  total_produto - ((desconto_final / 100) * total_produto).toFixed(2); */
            let pagar_total = document.querySelector(".total_pagar").value = pagar.replace(",",".");
            let total_desconto = document.querySelector('.total_desconto').value = ((desconto_final / 100) * total_produto).toFixed(2);
    

        }else{
            let pagar = document.getElementById("pagar").innerHTML =  ((total_produto + parseFloat(valor_servico - valor_desconto))).toFixed(2).replace(".",",")
            let pagar_total = document.querySelector(".total_pagar").value = pagar.replace(",",".");
            let total_desconto = document.querySelector('.total_desconto').value = valor_desconto


        }
       
      
        
        /* console.log(total_produto + parseFloat(valor_servico - valor_desconto)); */
    }   
    calcular();

    /* Apenas números nesse campo */
    var filtroTeclas = function(event) {
        return ((event.charCode >= 48 && event.charCode <= 57) || (event.keyCode == 46 || event.charCode == 44 || event.charCode == 37))
        }

        /* ---------------------------------------------------------------------------------------------------- */
       
 /* Filtro para a tabela produto */
    //pegando valor de um campo de texto
    var campoFiltro = document.querySelector("#filtrar-tabela-produto-modal");
    //o input verifica o que foi digitado
    campoFiltro.addEventListener("input",function(){
        /* console.log(this.value); */
        //aqui pega o tr
        var users = document.querySelectorAll(".tabela-modal-produto");
        
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

    /* Filtro para a tabela cliente */
    //pegando valor de um campo de texto
    var campoFiltro = document.querySelector("#filtrar-tabela-cliente-modal");
    //o input verifica o que foi digitado
    campoFiltro.addEventListener("input",function(){
        /* console.log(this.value); */
        //aqui pega o tr
        var users = document.querySelectorAll(".tabela-modal-cliente");
        
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


        /* Script para pegar dados da tabela cliente */
        var nome = document.getElementById('nome_cliente'),
        endereco = document.getElementById('endereco_cliente'),
        telefone = document.getElementById('telefone_cliente'),
        cpf = document.getElementById('cpf_cliente'),
        id = document.getElementById('id_cliente'),
        id_cliente = document.getElementById('id_compra_cliente'),
        tdNome = null,
        tdId = null,
        tdCpf = null,
        tdTelefone = null,
        tdEndereco = null;
        id_cliente.value = id.value;
   
    function adicionar(id_alvo) {
        var trID = document.getElementById(id_alvo);
        tdNome = trID.querySelector('[data-nome]').dataset.nome;
        tdEndereco = trID.querySelector('[data-endereco]').dataset.endereco;
        tdTelefone = trID.querySelector('[data-telefone]').dataset.telefone;
        tdId = trID.querySelector('[data-id]').dataset.id;
        tdCpf = trID.querySelector('[data-cpf]').dataset.cpf;

        id.value = tdId;
        id_cliente.value = tdId;
        nome.value = tdNome;
        endereco.value = tdEndereco;
        telefone.value = tdTelefone;
        cpf.value = tdCpf;

        
    }

    /* _________________FECHAR MENSAGEM__________________________________________________________________________________ */
    function buttonClose(){
        const alert = document.querySelector(".alert");
        alert.style.display = 'none';
     }

