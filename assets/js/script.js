if (typeof window.c !== "function") {
    window.c = (selector) => document.querySelector(selector);
}

M.AutoInit();

const TEMPO_ROTACAO = 5000;

const destaques = {
    isRotating: true,
    currentIndex: 1,

    getTotal() {
        const col1 = c('.destaques .col:nth-child(1)');
        return col1 ? col1.querySelectorAll('.noticia').length : 0;
    },

    mostrarParInvertido(index) {
        const total = this.getTotal();
        // Limpa todos os destaques atuais
        document.querySelectorAll('.destaques .col .noticia.show').forEach(noticia => noticia.classList.remove('show'));
        // Ativa o índice na coluna 1
        c(`.destaques .col:nth-child(1) .noticia:nth-child(${index})`)?.classList.add('show');
        // Ativa o espelhado na coluna 2
        c(`.destaques .col:nth-child(2) .noticia:nth-child(${total - index + 1})`)?.classList.add('show');
    },

    atualizar() {
        if (this.isRotating) {
            const total = this.getTotal();
            if (total === 0) return setTimeout(() => this.atualizar(), TEMPO_ROTACAO);
            if (this.currentIndex > total) this.currentIndex = 1;

            this.mostrarParInvertido(this.currentIndex);
            this.currentIndex++;
        }
        setTimeout(() => this.atualizar(), TEMPO_ROTACAO);
    }
};

$(document).ready(() => {
    $('.login-dropdown, .perfil-dropdown').dropdown({
        autoTrigger: false,
        coverTrigger: false,
        constrainWidth: false,
        closeOnClick: false
    });

    $('.destaques .noticia').mouseenter(function () {
        destaques.isRotating = false;
        const noticiaIndex = $(this).index() + 1;
        destaques.mostrarParInvertido(noticiaIndex);
    }).mouseleave(function () {
        destaques.isRotating = true;
    });
});

destaques.atualizar();

/**
 * Pontos implementados:
 * - Tempo de rotação ajustável por TEMPO_ROTACAO.
 * - Destaque invertido/espelhado entre as colunas.
 * - Hover manual respeita a lógica invertida.
 */
