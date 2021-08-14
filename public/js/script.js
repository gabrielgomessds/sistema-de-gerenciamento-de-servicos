
 /* ---------------------------------------------------------------------------- */
 
 /* Codigo para esconder mensagens de alert */

 function buttonClose(){
    const alert = document.querySelector(".alert");
   alert.style.display = 'none';
 }
 /* ----------------------------------------------------------------------------- */
 /* Código para retrair o menu */
    function toggleMenu(){
        let toggle = document.querySelector(".toggle");
        let menu = document.querySelector(".menu");
        let main = document.querySelector(".main");
    

        toggle.classList.toggle("active");
        menu.classList.toggle("active");
        main.classList.toggle("active");
    
    }
/* ------------------------------------------------------------------------------ */
/* Código para esconder os content atraves do menu  */

    window.onload = function () {


    if (!window.localStorage.getItem('start')) {

            const firstLink = document.getElementById('ContentOne_link');
            const firstCity = document.getElementById('ContentOne');

            firstLink.className += ' active';
            firstCity.style.display = 'block';

    } else {

            let cityLinkId = document.getElementById(window.localStorage.getItem('cityLinkId'));
            cityLinkId.className += ' active';

            let cityId = document.getElementById(window.localStorage.getItem('cityId'));
            cityId.style.display = 'grid';

    }

    window.localStorage.setItem('start', 1);
    }

    function openCity(element, evt, cityName) {

    /* Reset class tablinks */
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    /* Reset class tabcontent */
            tabcontent = document.getElementsByClassName("card-table");
            for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
    }


            /* set and get localstorage link */
            window.localStorage.setItem('cityLinkId', cityName);
            let getCityLinkId = window.localStorage.getItem('cityLinkId');

            let cityLinkId = document.getElementById(window.localStorage.getItem('cityLinkId'));
            cityLinkId.className += ' active';


            /* set and get localstorage content */
            let cityTabContent = cityName.split('_');
            window.localStorage.setItem('cityId', cityTabContent[0]);

            let cityId = document.getElementById(window.localStorage.getItem('cityId'));
            cityId.style.display = 'flex';
    }

    /* ---------------------------------------------------------------------------------- */
    /* Codigo para enviar imagem */
    var loadFile = function(event) {
        var output1 = document.getElementById('output');
        output1.src = URL.createObjectURL(event.target.files[0]);
    };
    /* ----------------------------------------------------------------------------------- */

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

    const botaoExcluirAdmin = document.querySelectorAll('.botaoExcluirAdmin');
    botaoExcluirAdmin.forEach((e) => {
        e.addEventListener('click', function(botao) {
        var prodID = botao.target.id;
        console.log(prodID)
        document.getElementById('id_admin').value = prodID
        iniciaModal("modalExcluirAdmin", prodID);
});
})


    const botaoFinalizaServico = document.querySelectorAll(".botaoFinalizaServico");
    botaoFinalizaServico.forEach((e) => {
        e.addEventListener('click', function(botao) {
        var prodID = botao.target.id;
        document.getElementById('id_servico').value = prodID
        iniciaModal("modalFinalizarServico", prodID);
});
})

const botaoVenderProduto = document.querySelectorAll(".botaoVenderProduto");
botaoVenderProduto.forEach((e) => {
    e.addEventListener('click', function(botao) {
    var prodID = botao.target.id;
    document.getElementById('id_produto').value = prodID
    iniciaModal("modalVenderProduto", prodID);
});
})

/* ----------------------------------------------------------------------------------------------------------- */

  /* Filtro para a tabela cliente */
    //pegando valor de um campo de texto
    var campoFiltro = document.querySelector("#filtrar-tabela-servico");
    //o input verifica o que foi digitado
    campoFiltro.addEventListener("input",function(){
        /* console.log(this.value); */
        //aqui pega o tr
        var users = document.querySelectorAll(".tabela-servico");
        
        if(this.value.length > 0){
            for(var i =0;i<users.length;i++){
                var user = users[i];
                //buscando dentro do td o nome
                var tdNome = user.querySelector(".cliente-servico");
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




/* Filtro para a tabela admin */
    //pegando valor de um campo de texto
    var campoFiltro = document.querySelector("#filtrar-tabela-admin");
    //o input verifica o que foi digitado
    campoFiltro.addEventListener("input",function(){
        /* console.log(this.value); */
        //aqui pega o tr
        var users = document.querySelectorAll(".tabela-admin");
        
        if(this.value.length > 0){
            for(var i =0;i<users.length;i++){
                var user = users[i];
                //buscando dentro do td o nome
                var tdNome = user.querySelector(".nome-admin");
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
    var campoFiltro = document.querySelector("#filtrar-tabela-cliente");
    //o input verifica o que foi digitado
    campoFiltro.addEventListener("input",function(){
        /* console.log(this.value); */
        //aqui pega o tr
        var users = document.querySelectorAll(".tabela-cliente");
        
        if(this.value.length > 0){
            for(var i =0;i<users.length;i++){
                var user = users[i];
                //buscando dentro do td o nome
                var tdNome = user.querySelector(".nome-cliente");
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


    /* Filtro para a tabela produto */
    //pegando valor de um campo de texto
    var campoFiltro = document.querySelector("#filtrar-tabela-produto");
    //o input verifica o que foi digitado
    campoFiltro.addEventListener("input",function(){
        /* console.log(this.value); */
        //aqui pega o tr
        var users = document.querySelectorAll(".tabela-produto");
        
        if(this.value.length > 0){
            for(var i =0;i<users.length;i++){
                var user = users[i];
                //buscando dentro do td o nome
                var tdNome = user.querySelector(".nome-produto");
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


  /* Filtro para a tabela vendas */
    //pegando valor de um campo de texto
    var campoFiltro = document.querySelector("#filtrar-tabela-vendas");
    //o input verifica o que foi digitado
    campoFiltro.addEventListener("input",function(){
        /* console.log(this.value); */
        //aqui pega o tr
        var users = document.querySelectorAll(".tabela-venda");
        
        if(this.value.length > 0){
            for(var i =0;i<users.length;i++){
                var user = users[i];
                //buscando dentro do td o nome
                var tdNome = user.querySelector(".nome-cliente");
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
    

   


    