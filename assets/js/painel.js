
lucide.createIcons();

document.addEventListener('DOMContentLoaded', () => {
    const logoToggle = document.getElementById('logoToggle');
    const navMenu = document.getElementById('navMenu');

    logoToggle.addEventListener('click', () => {
        navMenu.classList.toggle('active');
    });
});

document.addEventListener('DOMContentLoaded', () => {
    // Pega todos os botões que abrem o menu de ações
    const toggleButtons = document.querySelectorAll('.action-toggle');

    toggleButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            // Impede que o clique se propague e ative o fechamento global imediatamente
            event.stopPropagation();

            const dropdown = button.nextElementSibling; // Pega a div .action-dropdown logo abaixo do botão

            // Fecha todos os outros menus antes de abrir este (para não ficar com vários abertos)
            document.querySelectorAll('.action-dropdown.show').forEach(menu => {
                if (menu !== dropdown) {
                    menu.classList.remove('show');
                }
            });

            // Alterna a visibilidade do menu clicado
            dropdown.classList.toggle('show');
        });
    });

    // Fecha o menu se o usuário clicar em qualquer outro lugar da tela
    document.addEventListener('click', (event) => {
        document.querySelectorAll('.action-dropdown.show').forEach(menu => {
            menu.classList.remove('show');
        });
    });
});


