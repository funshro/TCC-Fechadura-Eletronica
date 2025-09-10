const button = document.querySelector("button");
const modal = document.querySelector("#dialog_cadastro");
const fechar = document.querySelector(".f")

button.onclick = function (){
    modal.showModal();
}

fechar.onclick = function(){
    modal.close();
}


// const buttonsAlterar = document.querySelectorAll(".alterar");
// const modal1 = document.querySelector("#dialog_cadastro1");
// const fechar1 = document.querySelector(".f1");


// buttonsAlterar.forEach(button => {
//     button.onclick = function () {
        
//         // Obter os dados armazenados nos atributos data-* do botão clicado
//         const uid = this.getAttribute('data-uid');
//         const nome = this.getAttribute('data-nome');
//         const email = this.getAttribute('data-email');
        
//         // Preencher os campos do modal com os dados correspondentes
//         document.querySelector('#uid2').value = uid;
//         document.querySelector('#nome2').value = nome;
//         document.querySelector('#email2').value = email;
        
//         modal1.showModal();
//     };
// });

// fechar1.onclick = function() {
//     modal1.close();
// };
