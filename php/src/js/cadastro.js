//Modo escuro e claro
const mode = document.getElementById('mode_icon');

mode.addEventListener('click', () => {
    const form = document.getElementById('cadastro_form');

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


const form = document.getElementById('form');
const campos = document.querySelectorAll('.required');
const spans = document.querySelectorAll('.span-required');
const submitButton = document.getElementById('cadastro_button');
const linhaRed = document.querySelectorAll('.input-field');
const emailRegex = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/; //Verificalçao do Email

//Validação de campos
form.addEventListener('submit', (event) => {
    event.preventDefault();
    nameValidate();
    emailValidate();
    mainPasswordValidate();
    comparePassword();

    if (validando()) {
        // form.submit();
    }
});

//Funções para validação
function setError(index) {
    linhaRed[index].style.borderBottom = '2px solid #e63636';
    campos[index].style.color = '#e63636';
    spans[index].style.display = 'block';
    spans[index].style.color = '#e63636';
}

function removeError(index) {
    linhaRed[index].style.border = '';
    campos[index].style.color = '';
    spans[index].style.display = 'none';
}

function nameValidate() {
    if (campos[0].value.length < 3) {
        setError(0);
    } else {
        removeError(0);
    }
}

function emailValidate() {
    const emailField = campos[1].value;
   
    // Primeiro, verifica o formato do e-mail
    if (!emailRegex.test(emailField)) {
        setError(1);
        return;
    } else {
        removeError(1);
    }

    // Faz a requisição Ajax para verificar se o e-mail já existe
    $.ajax({
        url: 'http://localhost/php/valida.php',
        type: 'POST',
        data: { email: emailField }, //enviar a variável
        dataType: 'json',
        success: function(result) {
            if (result.status === 'failed') {
                setError(1);
                spans[1].textContent = 'Email já em uso';
            } else {
                removeError(1);
            }
        },
        error: function(errorMessage) {
            console.error('Erro na requisição:', errorMessage);
            console.log('Erro ao verificar o email'); //Ele provavelmente nao existe no banco por isso da erro, mas talvez seja erro tbm kkk
        }
    });
}


function mainPasswordValidate() {
    if (campos[2].value.length < 8) {
        setError(2);
    } else {
        removeError(2);
    }
    comparePassword();
}

function comparePassword() {
    if (campos[2].value === campos[3].value && campos[3].value.length >= 8) {
        removeError(3);
    } else {
        setError(3);
    }
}

function validando() {
    
    const validFinal = campos[0].value.length >= 3 &&
                    emailRegex.test(campos[1].value) &&
                    campos[2].value.length >= 8 &&
                    campos[2].value === campos[3].value;

    submitButton.disabled = !validFinal;
    return validFinal;
}


