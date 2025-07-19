<?php
/*
Template Name: Todas Noticias
*/

// PROCESSAMENTO DE POST (antes de qualquer saída)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'], $_POST['action_type'])) {
  $current_user = wp_get_current_user();
  $post_id     = intval($_POST['post_id']);
  $action_type = sanitize_text_field($_POST['action_type']);

  if (current_user_can('administrator')) {
    if ($action_type === 'publish') {
      wp_update_post([
        'ID'          => $post_id,
        'post_status' => 'publish'
      ]);
    } elseif ($action_type === 'draft') {
      wp_update_post([
        'ID'          => $post_id,
        'post_status' => 'draft'
      ]);
    } elseif ($action_type === 'delete') {
      wp_delete_post($post_id, true);
    } elseif ($action_type === 'destacar') {
      update_post_meta($post_id, 'destaque_noticia', '1');
    } elseif ($action_type === 'remover_destaque') {
      delete_post_meta($post_id, 'destaque_noticia');
    }
    wp_safe_redirect(esc_url_raw($_SERVER['REQUEST_URI']));
    exit;
  }
}

// Só ADMIN pode acessar!
if (!is_user_logged_in() || !current_user_can('administrator')) {
  global $wp_query;
  $wp_query->set_404();
  status_header(404);
  nocache_headers();
  include(get_query_template('404'));
  exit;
}

get_header();


// Consulta TODAS as notícias (sem filtro de autor)
$args = [
  'post_type'      => 'noticia',
  'post_status'    => ['publish', 'draft'],
  'posts_per_page' => -1,
  'orderby'        => 'date',
  'order'          => 'DESC'
];
$query = new WP_Query($args);
?>

<div class="row" style="margin-top:90px;">
  <div class="col l8 s12" style="padding:0;">
    <div class="c_criacao">
      <h1><?php the_title(); ?></h1>
      <div class="divider"></div>
      <?php the_content(); ?>

      <!-- CAMPO DE BUSCA -->
      <div style="margin: 25px 0 15px 0;">
        <input id="busca-noticia" type="text" class="browser-default" style="padding:8px 16px;width:70%;max-width:320px;border-radius:8px;border:1px solid #ddd;" placeholder="Buscar por título ou conteúdo...">
        <button id="btn-buscar-noticia" class="btn laranja">Buscar</button>
      </div>

      <div id="noticias-list"></div>
      <div id="noticias-paginacao" style="margin: 18px 0; display: flex; gap: 10px;justify-content:center;"></div>

      <script>
        const todasNoticias = [
          <?php
          if ($query->have_posts()) :
            $query->rewind_posts();
            while ($query->have_posts()) : $query->the_post();
              $data = [
                'post_id'   => get_the_ID(),
                'titulo'    => get_the_title(),
                'thumb'     => get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: 'https://i.imgur.com/lZfeVv9.png',
                'permalink' => get_permalink(),
                'edit_link' => get_edit_post_link(),
                'status'    => get_post_status(),
                'data'      => get_the_date('d \d\e F'),
                'autor'     => get_the_author(),
                'is_destacada' => get_post_meta(get_the_ID(), 'destaque_noticia', true) == '1',
                'conteudo'  => mb_substr(wp_strip_all_tags(get_the_content()), 0, 240)
              ];
              echo json_encode($data, JSON_UNESCAPED_UNICODE) . ",\n";
            endwhile;
          endif;
          wp_reset_postdata();
          ?>
        ];
        const isAdmin = true;
      </script>

      <script>
        let noticiasExibidas = [...todasNoticias];
        let paginaAtual = 1;
        const porPagina = 5;

        function renderNoticias() {
          const list = document.getElementById('noticias-list');
          list.innerHTML = '';
          const total = noticiasExibidas.length;
          const totalPaginas = Math.ceil(total / porPagina);
          const inicio = (paginaAtual - 1) * porPagina;
          const fim = inicio + porPagina;
          const subset = noticiasExibidas.slice(inicio, fim);

          if (subset.length === 0) {
            list.innerHTML = '<p style="margin:2em 0;">Nenhuma notícia encontrada.</p>';
            renderPaginacao(totalPaginas);
            return;
          }

          subset.forEach(post => {
            list.innerHTML += `
            <div class="noticia noticia-click" data-href="${post.permalink}" style="display:flex;align-items:flex-start;margin-bottom:20px;cursor:pointer;">
              <div class="banner" style="background-image:url('${post.thumb}');width:250px;max-width:100%;height:165px;background-size:cover;background-position:center;border-radius:8px;margin-right:18px;"></div>
              <div class="info" style="max-width:285px;width:100%;">
                <p style="font-size:1.13em;font-weight:bold;">${post.titulo}</p>
                <p>${post.data} - ${post.autor}.</p>
                <p class="aguardando" style="font-size:15px;">
                  Status: ${post.status === 'draft' ? '<span style="color:#BD2507;">Rascunho</span>' : '<span style="color:green;">Postada</span>'}
                </p>
              </div>
              <div style="width:130px;min-width:130px;">
                <a href="${post.edit_link}" class="btn btn100 transparent laranja" style="margin-bottom:8px;" onclick="event.stopPropagation();">Editar</a>
                ${renderAcoes(post)}
              </div>
            </div>`;
          });

          renderPaginacao(totalPaginas);

          setTimeout(function() {
            document.querySelectorAll('.noticia-click').forEach(function(div) {
              div.onclick = function(e) {
                if (e.target.closest('form') || e.target.tagName === "BUTTON" || e.target.tagName === "A") return;
                window.open(div.getAttribute('data-href'), '_blank');
              };
            });
          }, 50);
        }

        function renderAcoes(post) {
          let html = '';
          if (post.status === 'draft') {
            html += `<form method="post" style="display:inline;" onClick="event.stopPropagation();">
              <input type="hidden" name="post_id" value="${post.post_id}">
              <input type="hidden" name="action_type" value="publish">
              <button type="submit" class="btn btn100 transparent laranja" style="margin-bottom:8px;">POSTAR</button>
            </form>`;
          } else {
            html += `<form method="post" style="display:inline;" onClick="event.stopPropagation();">
              <input type="hidden" name="post_id" value="${post.post_id}">
              <input type="hidden" name="action_type" value="draft">
              <button type="submit" class="btn btn100 transparent verde" style="margin-bottom:8px;">POSTADA</button>
            </form>`;
          }
          if (!post.is_destacada) {
            html += `<form method="post" style="display:inline;" onClick="event.stopPropagation();">
              <input type="hidden" name="post_id" value="${post.post_id}">
              <input type="hidden" name="action_type" value="destacar">
              <button type="submit" class="btn btn100 transparent laranja" style="margin-bottom:8px;">DESTACAR</button>
            </form>`;
          } else {
            html += `<form method="post" style="display:inline;" onClick="event.stopPropagation();">
              <input type="hidden" name="post_id" value="${post.post_id}">
              <input type="hidden" name="action_type" value="remover_destaque">
              <button type="submit" class="btn btn100 transparent verde" style="margin-bottom:8px;">DESTACADA</button>
            </form>`;
          }
          html += `<form method="post" style="display:inline;" onClick="event.stopPropagation();">
            <input type="hidden" name="post_id" value="${post.post_id}">
            <input type="hidden" name="action_type" value="delete">
            <button type="submit" class="btn btn100" style="background:#e96a6a;color:#fff;margin-bottom:8px;">Deletar</button>
          </form>`;
          return html;
        }

        // Paginação "por demanda"
        function renderPaginacao(totalPaginas) {
          const pag = document.getElementById('noticias-paginacao');
          pag.innerHTML = '';
          if (totalPaginas <= 1) return;
          let inicio = Math.max(1, paginaAtual - 2);
          let fim = Math.min(totalPaginas, inicio + 4);
          if (fim - inicio < 4) inicio = Math.max(1, fim - 4);

          if (paginaAtual > 1) {
            pag.innerHTML += `<button class="btn" onclick="irParaPagina(1)">&laquo;</button>`;
            pag.innerHTML += `<button class="btn" onclick="irParaPagina(${paginaAtual - 1})">&lt;</button>`;
          }
          for (let i = inicio; i <= fim; i++) {
            pag.innerHTML += `<button class="btn" style="padding:4px 12px;${i === paginaAtual ? 'background:#ffa800;color:#fff;' : ''}" onclick="irParaPagina(${i})">${i}</button>`;
          }
          if (paginaAtual < totalPaginas) {
            pag.innerHTML += `<button class="btn" onclick="irParaPagina(${paginaAtual + 1})">&gt;</button>`;
            pag.innerHTML += `<button class="btn" onclick="irParaPagina(${totalPaginas})">&raquo;</button>`;
          }
        }

        function irParaPagina(num) {
          paginaAtual = num;
          renderNoticias();
        }

        document.getElementById('btn-buscar-noticia').onclick = function() {
          const busca = document.getElementById('busca-noticia').value.toLowerCase().trim();
          paginaAtual = 1;
          if (!busca) {
            noticiasExibidas = [...todasNoticias];
          } else {
            noticiasExibidas = todasNoticias.filter(n =>
              n.titulo.toLowerCase().includes(busca) ||
              n.conteudo.toLowerCase().includes(busca)
            );
          }
          renderNoticias();
        };

        document.getElementById('busca-noticia').onkeypress = function(e) {
          if (e.key === 'Enter') document.getElementById('btn-buscar-noticia').click();
        };

        renderNoticias();
      </script>
    </div>
  </div>

  <!-- SIDEBAR -->
  <div class="col l4 s12">
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>