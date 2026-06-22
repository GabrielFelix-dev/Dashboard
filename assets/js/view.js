
document.addEventListener('DOMContentLoaded', () => {


    // Referências ao Modal e seus botões de fechar
    const modal = document.getElementById('viewProductModal');
    const closeModalBtns = document.querySelectorAll('#closeModalBtn, #closeModalFooter');

    // Todos os botões "Visualizar" no dropdown
    const viewButtons = document.querySelectorAll('.btn-view');

    // Abre o modal ao clicar em "Visualizar"
    viewButtons.forEach(btn => {
        btn.addEventListener('click', (event) => {
            event.preventDefault(); // Evita que o link atualize a página
            modal.classList.add('active');

            // Passo a passo para preencher o modal com os dados do produto:

            // 1. O 'btn' é o botão específico que foi clicado
            // O dataset converte "data-nome" em "btn.dataset.nome"
            const nomeProduto = btn.dataset.nome;
            const categoriaProduto = btn.dataset.categoria;
            const precoProduto = btn.dataset.preco;
            const estoqueProduto = btn.dataset.estoque;
            const descricaoProduto = btn.dataset.descricao;


            // 2. Agora você seleciona os elementos HTML de dentro do seu modal_visualizar.php
            const modalNomeElemento = document.querySelector('.modal-name');
            const modalCategoriaElemento = document.querySelector('.modal-category');
            const modalPrecoElemento = document.querySelector('.modal-preco');
            const modalDescricaoElemento = document.querySelector('.modal-description');
            const modalEstoqueElemento = document.querySelector('.modal-estoque');

            // 3. E por fim, substitui o texto estático pelos dados dinâmicos do botão
            modalNomeElemento.textContent = nomeProduto;
            modalCategoriaElemento.textContent = categoriaProduto;
            modalPrecoElemento.textContent = precoProduto;
            modalDescricaoElemento.textContent = descricaoProduto;
            modalEstoqueElemento.textContent = estoqueProduto;

            // 4. Depois que os textos forem trocados, a classe 'active' é adicionada para o modal aparecer na tela
            modal.classList.add('active');

            // Opcional: Aqui você fecharia o dropdown que ficou aberto
            const dropdown = btn.closest('.action-dropdown');
            if (dropdown) dropdown.classList.remove('show');
        });
    });

    // Fecha o modal ao clicar no 'X' ou em 'Fechar'
    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            modal.classList.remove('active');
        });
    });

    // Fecha o modal ao clicar no fundo desfocado (fora do card)
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.classList.remove('active');
        }
    });
});