// Garante o helper c disponível globalmente para selecionar elementos facilmente
if (typeof window.c !== "function") {
    window.c = (selector) => document.querySelector(selector);
}

// Inicializa componentes do Materialize (caso use Materialize CSS)
M.AutoInit();

/**
 * Controlador dos destaques rotativos da home.
 * Agora pega o número total de destaques de cada coluna dinamicamente.
 */
const destaques = {
    isFirstRun: true,
    isRotating: true,
    currentDestaque1: 1,
    currentDestaque2: 2,

    getTotal(colIndex) {
        // Retorna a quantidade de destaques na coluna informada
        const col = c(`.destaques .col:nth-child(${colIndex})`);
        return col ? col.querySelectorAll('.noticia').length : 0;
    },

    atualizar() {
        const pageTitle = c('title')?.innerText;
        if (this.isRotating && pageTitle === 'Início - Diário Brasileiro') {
            const totalDestaques1 = this.getTotal(1);
            const totalDestaques2 = this.getTotal(2);

            if (this.currentDestaque1 > totalDestaques1) this.currentDestaque1 = 1;
            if (this.currentDestaque2 > totalDestaques2) this.currentDestaque2 = 1;

            if (!this.isFirstRun) {
                c(`.destaques .col:nth-child(1) .noticia.show`)?.classList.remove('show');
                c(`.destaques .col:nth-child(2) .noticia.show`)?.classList.remove('show');
            }

            c(`.destaques .col:nth-child(1) .noticia:nth-child(${this.currentDestaque1})`)?.classList.add('show');
            c(`.destaques .col:nth-child(2) .noticia:nth-child(${this.currentDestaque2})`)?.classList.add('show');

            this.currentDestaque1++;
            this.currentDestaque2++;

            if (this.isFirstRun) this.isFirstRun = false;
        }

        setTimeout(() => this.atualizar(), 3000);
    }
};

/**
 * Gerencia a busca e paginação de notícias.
 */
const News = {
    page: 2,
    hasMore: true,

    /**
     * Busca notícias de acordo com categoria e palavra-chave.
     * Utiliza fetch + arrow functions e faz tratamento de erro.
     */
    search(cat, keyword) {
        if (!this.hasMore) return;

        const url = `${BASE}ajax/news`;
        const params = {
            method: 'POST',
            body: JSON.stringify({
                page: this.page,
                cat,
                keyword
            })
        };

        fetch(url, params)
            .then(response => {
                if (!response.ok) throw new Error('Erro ao buscar notícias');
                return response.json();
            })
            .then(json => {
                if (json.status === 1) {
                    json.noticias.forEach(item => {
                        const newsTemplate = c('#exemplos a').cloneNode(true);
                        newsTemplate.href = `${BASE}noticia/${item.id}/${item.slug}`;
                        newsTemplate.querySelector('.imagem').style.backgroundImage = `url(${item.banner})`;
                        newsTemplate.querySelector('.conteudo p:nth-child(1)').innerText = item.titulo;

                        // Formatação de data
                        const [year, month, dayTime] = item.data.split('-');
                        const [day] = dayTime.split(' ');
                        const meses = [
                            '', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                        ];
                        const dataFormatada = `${day} de ${meses[parseInt(month, 10)]} ${year}`;
                        newsTemplate.querySelector('.conteudo p:nth-child(2)').innerText = `${dataFormatada} - ${item.autor}`;
                        newsTemplate.querySelector('.conteudo p:nth-child(3)').innerText = `${dataFormatada} - ${item.subtitulo}`;

                        c('.leia_mais').append(newsTemplate);
                    });
                    this.page = json.page;
                } else {
                    this.hasMore = false;
                }
            })
            .catch(error => {
                // Aqui pode-se mostrar uma mensagem de erro para o usuário, se desejado
                // console.error(error);
            });
    }
};

$(document).ready(() => {
    // Dropdown customizado do Materialize
    $('.login-dropdown, .perfil-dropdown').dropdown({
        autoTrigger: false,
        coverTrigger: false,
        constrainWidth: false,
        closeOnClick: false
    });

    // Scroll infinito: busca mais notícias ao chegar no fim da página
    $(document).scroll(() => {
        const scrollBottom = $(window).scrollTop() + $(window).height();
        const docHeight = document.body.clientHeight;
        const pageTitle = c('title')?.innerText;

        if (docHeight === scrollBottom) {
            let cat = '';
            let keyword = '';
            const urlParams = new URLSearchParams(window.location.search);
            keyword = urlParams.get('keyword');

            if (pageTitle === 'Categoria - Diário Brasileiro') {
                cat = c('.leia_mais h1')?.getAttribute('data-categoria') || '';
            }

            News.search(cat, keyword);
        }
    });

    // Hover para exibir manualmente os destaques
    $('.destaques .noticia')
        .mouseenter(function () {
            destaques.isRotating = false;
            const colIndex = $(this).parent().index() + 1;
            const noticiaIndex = $(this).index() + 1;

            c(`.destaques .col:nth-child(${colIndex}) .noticia.show`)?.classList.remove('show');
            c(`.destaques .col:nth-child(${colIndex}) .noticia:nth-child(${noticiaIndex})`)?.classList.add('show');

            if (colIndex === 1) {
                destaques.currentDestaque1 = noticiaIndex + 1;
            } else {
                destaques.currentDestaque2 = noticiaIndex + 1;
            }
        })
        .mouseleave(function () {
            destaques.isRotating = true;
        });
});

// Função externa presumida necessária para funcionamento do sistema
ping();
destaques.atualizar();
