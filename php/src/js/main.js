    // Pegando os section e nav-itens e aplicando alguns efeitos na navbar 
    const sections = $('section');
    const navItems = $('.nav-item');

    $(window).on('scroll', function () {
        const header = $('header');
        const scrollPosition = $(window).scrollTop() - header.outerHeight();

        let activeSectionIndex = 0;

        if (scrollPosition <= 0) {
            header.css('box-shadow', 'none');
        } else {
            header.css('box-shadow', '4px 4px 10px rgba(0, 0, 0, 0.5');
            header.css('transition', 'all .4s ease')
        }

        sections.each(function(i) {
            const section = $(this);
            const sectionTop = section.offset().top - 96;
            const sectionBottom = sectionTop+ section.outerHeight();

            if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                activeSectionIndex = i;
                return false;
            }
        })
    
        //removendo e adicionando a classe active do css nos itens da navbar
        navItems.removeClass('active');
        $(navItems[activeSectionIndex]).addClass('active');
    });

const elements = document.querySelectorAll('.animate-right');

function animateElements() {
  elements.forEach(element => {
    const inView = element.getBoundingClientRect().top < window.innerHeight;
    if (inView) {
      element.classList.add('active');
    }
  });
}

window.addEventListener('scroll', animateElements);
animateElements(); // Executar a função ao carregar a página

const slidingBoxes = document.querySelectorAll('.animate-bottom');

function animateBottomBoxes() {
  slidingBoxes.forEach(element => {
    const inView = element.getBoundingClientRect().top < window.innerHeight;
    if (inView) {
      element.classList.add('active');
    }
  });
}

window.addEventListener('scroll', animateBottomBoxes);
animateBottomBoxes();

