  /* Calcular Valor */
  function calcular(){
    /* Pegando valores */
   
    let quantProduto = document.querySelectorAll(".quant_produto");
    let precoProduto = document.querySelectorAll(".preco_produto");
    let tdsValores = document.querySelectorAll('.total_produto');
   

    let total_produto = 0;
    let valorPagar = 0;

    for (var i = 0;i < quantProduto.length; i++ ){
        valorPagar = Number(quantProduto[i].innerHTML) * parseFloat(precoProduto[i].innerHTML.toString().replace(",","."))
        tdsValores[i].innerHTML = valorPagar.toFixed(2);
        total_produto += valorPagar;
    }
   
    valor_pagar = document.querySelector('.valor_pagar');
    desconto_venda = document.querySelector('.desconto_venda');
    total_a_pagar = document.querySelector('.total_a_pagar');
    
    total_a_pagar = valor_pagar - desconto_venda;
  
    /* console.log(total_produto + parseFloat(valor_servico - valor_desconto)); */
}   
calcular();

/* Apenas números nesse campo */
var filtroTeclas = function(event) {
    return ((event.charCode >= 48 && event.charCode <= 57) || (event.keyCode == 46 || event.charCode == 44 || event.charCode == 37))
    }

    /* ---------------------------------------------------------------------------------------------------- */
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