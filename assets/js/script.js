M.AutoInit();


const destaques = {
    primeira: 1,
    status: 1,
    destaque1: 1,
    destaque2: 2,
    atualizar() {
        let pagName = c('title').innerText
        if (this.status === 1 && pagName == 'Início - Diário Brasileiro') {
            if (this.destaque1 == 4) {
                this.destaque1 = 1
            }
            if (this.destaque2 == 4) {
                this.destaque2 = 1
            }

            if (this.primeira != 1) {
                c(`.destaques .col:nth-child(1) .noticia.show`).classList.remove('show');
            }

            if (this.primeira != 1) {
                c(`.destaques .col:nth-child(2) .noticia.show`).classList.remove('show');
            }

            c(`.destaques .col:nth-child(1) .noticia:nth-child(${this.destaque1})`).classList.add('show');


            c(`.destaques .col:nth-child(2) .noticia:nth-child(${this.destaque2})`).classList.add('show');

            this.destaque1++
            this.destaque2++

            if (this.primeira === 1) {
                this.primeira = 0
            }
        }

        setTimeout(() => {
            this.atualizar();
        }, 3000);
    }
}

const News = {
    page: 2,
    continue: true,
    search(cat, keyword) {
        if (this.continue) {
            let url = `${BASE}ajax/news`
            let params = {
                method: 'POST',
                body: JSON.stringify({
                    page: News.page,
                    cat: cat,
                    keyword: keyword
                })

            }
            fetch(url, params)
                .then((r) => r.json())
                .then((json) => {
                    if (json.status == 1) {
                        json.noticias.map((item, index) => {
                            let modelo_noticia = c('#exemplos a').cloneNode(true)

                            modelo_noticia.href = `${BASE}noticia/${item.id}/${item.slug}`

                            modelo_noticia.querySelector('.imagem').style.backgroundImage = `url(${item.banner})`

                            modelo_noticia.querySelector('.conteudo p:nth-child(1)').innerText = item.titulo

                            let dt = item.data.split('-')
                            let meses = {
                                '01': 'Janeiro',
                                '02': 'Fevereiro',
                                '03': 'Março',
                                '04': 'Abril',
                                '05': 'Maio',
                                '06': 'Junho',
                                '07': 'Julho',
                                '08': 'Agosto',
                                '09': 'Setembro',
                                '10': 'Outubro',
                                '11': 'Novembro',
                                '12': 'Dezembro'
                            }
                            let dta = dt[2].split(' ')
                            let mes = meses[dt[1]]
                            let data = `${dta[0]} de ${mes} ${dt[0]}`

                            modelo_noticia.querySelector('.conteudo p:nth-child(2)').innerText = `${data} - ${item.autor}`

                            modelo_noticia.querySelector('.conteudo p:nth-child(3)').innerText = `${data} - ${item.subtitulo}`



                            c(".leia_mais").append(modelo_noticia)
                        })

                        this.page = json.page
                    } else {
                        this.continue = false
                    }
                })
                .catch((erro) => {
                    // erro em falhas
                })
        }
    }
}

function limpar() {
    // console.clear();
    setTimeout(() => {
        limpar()
    }, 2000);
}

$(document).ready(function () {
    limpar()
    $('.login-dropdown, .perfil-dropdown').dropdown({
        autoTrigger: false,
        coverTrigger: false,
        constrainWidth: false,
        closeOnClick: false
    });

    $(document).scroll(function () {
        let scrolT = $(window).scrollTop() + $(window).height();
        let h = document.body.clientHeight;
        let pagName = c('title').innerText

        if (h == scrolT) {
            let cat = '';
            let keyword = '';

            const urlParams = new URLSearchParams(window.location.search);
            keyword = urlParams.get('keyword');

            if (pagName == 'Início - Diário Brasileiro') {
                cat = ''
            } else if (pagName == 'Categoria - Diário Brasileiro') {
                cat = c('.leia_mais h1').getAttribute('data-categoria');
            }

            News.search(cat, keyword);
        }
    });

    $('.destaques .noticia').mouseenter(function () {
            destaques.status = 2;
            let indexPai = $(this).parent().index() + 1;
            let indexNoticia = $(this).index() + 1;

            c(`.destaques .col:nth-child(${indexPai}) .noticia.show`).classList.remove('show');
            c(`.destaques .col:nth-child(${indexPai}) .noticia:nth-child(${indexNoticia})`).classList.add('show');

            if (indexPai === 1) {
                destaques.destaque1 = indexNoticia + 1
            } else {
                destaques.destaque2 = indexNoticia + 1

            }
        })
        .mouseleave(function () {
            destaques.status = 1;
        });
});

ping()
destaques.atualizar();