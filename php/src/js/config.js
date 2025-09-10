const button = document.querySelectorAll(".editar");

// Modal - Nome
const modal = document.querySelector("#dialog_cadastro");
const fechar = modal.querySelector(".f");

button[0].onclick = function (){
    modal.showModal();
}
fechar.onclick = function(){
    modal.close();
}

// Model - Email
const modal1 = document.querySelector("#dialog_cadastro1");
const fechar1 = modal1.querySelector(".f1");

button[1].onclick = function (){
    modal1.showModal();
}
fechar1.onclick = function(){
    modal1.close();
}

// Model - Email
const modal2 = document.querySelector("#dialog_cadastro2");
const fechar2 = modal2.querySelector(".f2");

button[2].onclick = function (){
    modal2.showModal();
}
fechar2.onclick = function(){
    modal2.close();
}

// Modal - foto
const botao = document.querySelector(".enviar")
const modal3 = document.querySelector("#dialog_cadastro3");
const fechar3 = document.querySelector(".f3");

botao.onclick = function(){
    modal3.showModal();
}
fechar3.onclick = function(){
    modal3.close();
}