  /* Calcular Valor */
  function calcular(){
    /* Pegando valores */
   
    let quantProduto = document.querySelectorAll(".quant_produto");
    let precoProduto = document.querySelectorAll(".preco_produto");
    let tdsValores = document.querySelectorAll('.total_produto');
    /* let valorVenda = document.querySelector('.valor_venda'); */

    let total_produto = 0;
    let valorPagar = 0;

    for (var i = 0;i < quantProduto.length; i++ ){
        valorPagar = Number(quantProduto[i].innerHTML) * parseFloat(precoProduto[i].innerHTML.toString().replace(",","."))
        tdsValores[i].innerHTML = valorPagar.toFixed(2);
        total_produto += valorPagar;
         /* valorVenda.innerHTML = total_produto.toFixed(2).replace(".",","); */
    }
    total_a_pagar = document.querySelector('.total_a_pagar');
    valor_pagar = document.querySelector('.valor_pagar');
    desconto_venda = document.querySelector('.desconto_venda');

    total_a_pagar.innerHTML = valor_pagar.innerHTML.toString().replace(",",".") - desconto_venda.innerHTML.toString().replace(",",".");
  
    /* console.log(total_produto + parseFloat(valor_servico - valor_desconto)); */
}   
calcular();

/* Apenas números nesse campo */
var filtroTeclas = function(event) {
    return ((event.charCode >= 48 && event.charCode <= 57) || (event.keyCode == 46 || event.charCode == 44 || event.charCode == 37))
    }

    /* ---------------------------------------------------------------------------------------------------- */
   