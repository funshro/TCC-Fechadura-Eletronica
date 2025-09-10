// Gemini

const body = document.querySelector('body'),
    sidebar = body.querySelector('.sidebar'),
    toggle = body.querySelector('.toggle'),
    searchBtn = body.querySelector('.search-box'),
    modeSwitch = body.querySelector('.toggle-switch'),
    modeText = body.querySelector('.mode-text');

// Verifica se o tema escuro já está armazenado no localStorage
if (localStorage.getItem('darkMode') === 'true') {
    body.classList.add('dark');
    modeText.innerText = "Light Mode";
}

toggle.addEventListener('click', () => {
    sidebar.classList.toggle("close");
});

modeSwitch.addEventListener('click', () => {
    body.classList.toggle("dark");

    if(body.classList.contains("dark")){
        modeText.innerText = "Light Mode";
        localStorage.setItem('darkMode', 'true');
    } else {
        modeText.innerText = "Dark Mode";
        localStorage.removeItem('darkMode');
    }
});

/*
    const imgDiv = document.querySelector('.image-upload');
const img = document.querySelector('#image_preview');
const file = document.querySelector('#image_field');

file.addEventListener('change', function() {
  const chosedfile = this.files[0];
  if (chosedfile) {
    const reader = new FileReader();

    reader.addEventListener('load', function() {
      img.setAttribute('src', reader.result);
      // Armazena a URL da imagem no localStorage
      localStorage.setItem('profileImage', reader.result);
    });

    reader.readAsDataURL(chosedfile);
  }
});

// Carregar a imagem do localStorage ao carregar a página
window.onload = function() {
  const savedImage = localStorage.getItem('profileImage');
  if (savedImage) {
    img.setAttribute('src', savedImage);
  }
};

*/

// const searchInput = document.querySelector('#header_main input');
// const tableBody = document.querySelector('table tbody');

// searchInput.addEventListener('input', () => {
//     const searchTerm = searchInput.value.toLowerCase();
//     const rows = tableBody.querySelectorAll('tr');

//     rows.forEach(row => {
//         const nameCell = row.querySelector('td:first-child');
//         const name = nameCell.textContent.toLowerCase();

//         if (name.includes(searchTerm)) {
//             row.style.display = '';
//         } else {
//             row.style.display = 'none';
//         }
//     });
// });

// Filtragem de dados
const inputBusca = document.getElementById('input_busca');
const tabelaHistorico = document.getElementById('tabela_historico');

inputBusca.addEventListener('keyup', () => {
  let expressao = inputBusca.value.toLowerCase();

  let linhas = tabelaHistorico.getElementsByTagName('tr');

  // Convertendo HTMLCollection para Array e iterando sobre as linhas
  for (let linha of linhas) {
    let conteudoLinha = linha.textContent.toLowerCase();

    if (conteudoLinha.includes(expressao)) {
      linha.style.display = ''; // Exibe a linha
    } else {
      linha.style.display = 'none'; // Oculta a linha
    }
  }
});

