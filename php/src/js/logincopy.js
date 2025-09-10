//Modo escuro e claro
const mode = document.getElementById('mode_icon');

mode.addEventListener('click', () => {
    const form = document.getElementById('login_form');

    if(mode.classList.contains('fa-moon')) {
        mode.classList.remove('fa-moon');
        mode.classList.add('fa-sun');
        
        form.classList.add('dark');
        return;
    } 

    mode.classList.remove('fa-sun');
    mode.classList.add('fa-moon');
    form.classList.remove('dark');
    
});

const emailRegex = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
const form = document.getElementById('login_form');
const campos = document.querySelectorAll('.required');
const spans = document.querySelectorAll('.span-required');
const linhaRed = document.querySelectorAll('.input-field');



function setError(index) {
    linhaRed[index].style.borderBottom = '2px solid #e63636';
    spans[index].style.display = 'block'; 
    spans[index].style.color = '#e63636';
}


function removeError(index) {
    linhaRed[index].style.borderBottom = '';
    spans[index].style.display = 'none'; 
}

form.addEventListener('submit', (event) => {
    event.preventDefault();
    emailValidate();
});

function emailValidate() {
    const emailField = campos[0].value;

    if (!emailRegex.test(emailField)) {
        setError(0);
        return;
    } else {
        removeError(0);
    }

    // Verificando se existe o email
    $.ajax({
        url: 'http://localhost/php/logando.php',
        type: 'POST',
        data: { email: emailField }, //enviar a variável
        dataType: 'json',
        success: function(result) {
            if (result.status === 'failed') {
                setError(0);
                spans[0].textContent = 'Email inválido';
            } else {
                removeError(0);
                passwordValidate();
            }
        },
        error: function(errorMessage) {
            console.error('Erro na requisição:', errorMessage);
        }
    });
}

// form.addEventListener('login_button', (event) => {
//     event.preventDefault();
//     emailValidate();
//     // PasswordValidate();

//     // if (validando()) {
//     //     form.submit();
//     // }
// });

// function emailValidate() {
//     const emailField = campos[0].value;
   
//     if (!emailRegex.test(emailField)) {
//         setError(0);
//         return;
//     } else {
//         removeError(0);
//     }

//     // Verificando se existe o email
//     $.ajax({
//         url: 'http://localhost/php/logando.php',
//         type: 'POST',
//         data: { email: emailField }, //enviar a variável
//         dataType: 'json',
//         success: function(result) {
//             if (result.status === 'failed') {
//                 setError(0);
//                 spans[0].textContent = 'Senha ou Email incorreto';
                
//             } else {
//                 removeError(0);
//             }
//         },
//         error: function(errorMessage) {
//             console.error('Erro na requisição:', errorMessage);
//             console.log('Erro ao verificar o email'); //Ele provavelmente existe no banco por isso da erro, mas talvez seja erro tbm kkk
//         }
//     });
// }


// function PasswordValidate() {
//     if (campos[1].value.length < 8) {
//         setError(1);
//     } else {
//         removeError(1);
//     }

//     const senha = campos[1].value;

//     $.ajax({
//         url: 'http://localhost/php/logando.php',
//         type: 'POST',
//         data: {senha: senha}, 
//         dataType: 'json',
//         success: function(result) {
//             if (result.statuss === "failed") {
//                 setError(1);
//                 spans[1].textContent = 'Senha ou Email incorreto';
//                 alert("gay");
//             }else {
//                 window.location.href = 'menu.php';
//             }
//         },
//         error: function(errorMessage) {
//             console.error('Erro na requisição:', errorMessage);
//             console.log('Erro ao verificar senha'); //Ele provavelmente nao existe no banco por isso da erro, mas talvez seja erro tbm kkk
//         }
//     });
        
// }

function validando() {
    
    const validFinal = emailRegex.test(campos[0].value);

    submitButton.disabled = !validFinal;
}