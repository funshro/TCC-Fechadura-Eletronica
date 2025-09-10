$(document).ready(function() { /*Iniciando o JQuery*/ 
    
    $('#mobile_btn').on('click', function(){ /* Pegando o id do botão "mobile_btn" - quando clicar vai executar tal função */ 
        $('#mobile_menu').toggleClass('active'); /* Toda vez que clicar no menu ele vai obter a classe de ativo */
        $('#mobile_btn').find('i').toggleClass('fa-x'); /* Toda vez que clicar no menu ele vai obter a classe de ativo - o find é porque não vamos trocar o mobile_btn, e sim o icone que está dentro dele com a tag "<i></i>" */
    });

});