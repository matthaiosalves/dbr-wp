<?php

/**
 * The main template file
 *
 * @package Diário_Brasileiro_Habbo
 */

get_header(); ?>

<div class="destaques">
	<div class="row" style="margin-bottom:0;">
		<?php
		$max_destaques = 6;
		$noticias = [];

		// 1º passo: pega 1 post de cada categoria, do tipo noticia
		$categorias = get_categories([
			'type'       => 'noticia',
			'orderby'    => 'count',
			'order'      => 'DESC',
			'hide_empty' => true
		]);
		foreach ($categorias as $cat) {
			$q = new WP_Query([
				'post_type'      => 'noticia',
				'posts_per_page' => 1,
				'cat'            => $cat->term_id,
				'post_status'    => 'publish',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'post__not_in'   => array_column($noticias, 'ID')
			]);
			if ($q->have_posts()) {
				$q->the_post();
				$noticias[] = [
					'ID'     => get_the_ID(),
					'link'   => get_permalink(),
					'img'    => get_the_post_thumbnail_url(null, 'large') ?: 'https://i.imgur.com/Ko4MtlJ.png',
					'titulo' => get_the_title(),
					'cat'    => get_the_category(),
					'data'   => get_the_date('d \d\e F'),
					'autor'  => get_the_author()
				];
				wp_reset_postdata();
			}
			if (count($noticias) >= $max_destaques) break;
		}

		// 2º passo: completa até 6 posts mais recentes (sem repetir)
		if (count($noticias) < $max_destaques) {
			$faltam = $max_destaques - count($noticias);
			$q = new WP_Query([
				'post_type'      => 'noticia',
				'posts_per_page' => $faltam,
				'post_status'    => 'publish',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'post__not_in'   => array_column($noticias, 'ID')
			]);
			while ($q->have_posts()) {
				$q->the_post();
				$noticias[] = [
					'ID'     => get_the_ID(),
					'link'   => get_permalink(),
					'img'    => get_the_post_thumbnail_url(null, 'large') ?: 'https://i.imgur.com/Ko4MtlJ.png',
					'titulo' => get_the_title(),
					'cat'    => get_the_category(),
					'data'   => get_the_date('d \d\e F'),
					'autor'  => get_the_author()
				];
			}
			wp_reset_postdata();
		}

		// Divide em duas colunas de até 3
		$colA = array_slice($noticias, 0, 3);
		$colB = array_slice($noticias, 3, 3);
		?>

		<div class="col l6 s12" style="padding:0 .15rem;">
			<?php foreach ($colA as $not) : ?>
				<div class="noticia" style="background-image:url('<?php echo esc_url($not['img']); ?>');">
					<a href="<?php echo esc_url($not['link']); ?>">
						<div class="categoria">
							<?php echo !empty($not['cat'][0]->name) ? esc_html($not['cat'][0]->name) : ''; ?>
						</div>
						<p>
							<?php echo esc_html($not['titulo']); ?>
							<span class="por">
								<?php echo esc_html($not['data']); ?> - <?php echo esc_html($not['autor']); ?>
							</span>
						</p>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="col l6 s12" style="padding:0 .15rem;">
			<?php foreach ($colB as $not) : ?>
				<div class="noticia" style="background-image:url('<?php echo esc_url($not['img']); ?>');">
					<a href="<?php echo esc_url($not['link']); ?>">
						<div class="categoria">
							<?php echo !empty($not['cat'][0]->name) ? esc_html($not['cat'][0]->name) : ''; ?>
						</div>
						<p>
							<?php echo esc_html($not['titulo']); ?>
							<span class="por">
								<?php echo esc_html($not['data']); ?> - <?php echo esc_html($not['autor']); ?>
							</span>
						</p>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<div class="row" style="margin-bottom:0;">
	<div class="col l8 s12" style="padding:0;">

		<div class="colunas">
			<h1>Colunas</h1>
			<div class="gallery js-flickity"
				data-flickity-options='{ "freeScroll": true, "groupCells": true, "autoPlay": 2000, "cellAlign": "left", "prevNextButtons": false, "pageDots": false }'
				style="overflow:hidden;margin-top:10px;">
				<?php
				$max_colunas = 8;
				$colunas = [];

				// 1º passo: pega até 1 noticia de cada categoria (do tipo noticia)
				$categorias = get_categories([
					'type'       => 'noticia',
					'orderby'    => 'count',
					'order'      => 'DESC',
					'hide_empty' => true
				]);
				foreach ($categorias as $cat) {
					$q = new WP_Query([
						'post_type'      => 'noticia',
						'posts_per_page' => 1,
						'cat'            => $cat->term_id,
						'post_status'    => 'publish',
						'orderby'        => 'date',
						'order'          => 'DESC',
						'post__not_in'   => array_column($colunas, 'ID')
					]);
					if ($q->have_posts()) {
						$q->the_post();
						$colunas[] = [
							'ID'     => get_the_ID(),
							'link'   => get_permalink(),
							'img'    => get_the_post_thumbnail_url(null, 'large') ?: 'https://i.imgur.com/Ko4MtlJ.png',
							'cat'    => get_the_category(),
							'titulo' => get_the_title()
						];
						wp_reset_postdata();
					}
					if (count($colunas) >= $max_colunas) break;
				}

				// 2º passo: completa com as mais recentes caso não tenha 8 (sem repetir)
				if (count($colunas) < $max_colunas) {
					$faltam = $max_colunas - count($colunas);
					$q = new WP_Query([
						'post_type'      => 'noticia',
						'posts_per_page' => $faltam,
						'post_status'    => 'publish',
						'orderby'        => 'date',
						'order'          => 'DESC',
						'post__not_in'   => array_column($colunas, 'ID')
					]);
					while ($q->have_posts()) {
						$q->the_post();
						$colunas[] = [
							'ID'     => get_the_ID(),
							'link'   => get_permalink(),
							'img'    => get_the_post_thumbnail_url(null, 'large') ?: 'https://i.imgur.com/Ko4MtlJ.png',
							'cat'    => get_the_category(),
							'titulo' => get_the_title()
						];
					}
					wp_reset_postdata();
				}
				?>

				<?php foreach ($colunas as $col): ?>
					<?php $cat_name = !empty($col['cat'][0]->name) ? esc_html($col['cat'][0]->name) : ''; ?>
					<a href="<?php echo esc_url($col['link']); ?>" class="gallery-cell">
						<div class="coluna">
							<h5><?php echo $cat_name; ?></h5>
							<div class="noticia"
								style="background-image:url('<?php echo esc_url($col['img']); ?>');background-repeat: no-repeat;background-size: cover;background-position: center center;">
								<?php echo esc_html($col['titulo']); ?>
							</div>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="equipe">
			<h1>Essa é nossa equipe!</h1>
			<div style="position:relative;min-height:90px;overflow:hidden;">
				<div style="height:40px;width:470px;background:#f94623;z-index:-1;margin-top: 20px;"></div>
				<div style="height:40px;width:470px;background:#F9BA23;margin-top:10px;position:absolute;right:0;z-index:-1;"></div>
				<?php
				$role_order = [
					'administrator',
					'editor',
					'author',
					'contributor'
				];
				?>
				<?php foreach ($role_order as $role): ?>
					<?php
					$users = get_users([
						'role'    => $role,
						'exclude' => [],
						'orderby' => 'display_name',
						'order'   => 'ASC',
					]);
					?>
					<?php if ($users): ?>
						<?php foreach ($users as $user): ?>
							<?php if (in_array('subscriber', $user->roles)) continue; ?>
							<?php
							$nome_publico = $user->display_name;
							$perfil_url = 'https://exbrhb.net/perfil/' . urlencode($nome_publico);
							?>
							<a href="<?php echo esc_url($perfil_url); ?>" target="_blank">
								<img src="https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?php echo esc_attr($nome_publico); ?>&action=std&direction=3&head_direction=3&gesture=sml&size=l"
									alt="Avatar no habbo"
									style="z-index:1;margin-top:-85px;height:133px;margin-right:-35px; margin-left:-11px;"
									class="tooltipped"
									data-position="bottom"
									data-tooltip="<?php echo esc_attr(ucfirst($role)) . ', ' . esc_attr($nome_publico); ?>" />
							</a>
						<?php endforeach; ?>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>

		<div id="search-area">
			<form id="search-form" action="javascript:void(0);">
				<div class="search-bar">
					<input class="search-input browser-default" type="text" id="keyword" name="keyword" placeholder="Pesquisar notícia...">
					<button class="search-button browser-default" type="submit"><i class="fa fa-search" style="font-size: 18px;"></i></button>
				</div>
			</form>
			<div id="search-loading" style="display:none;margin:20px;text-align:center;">
				<img src="https://i.imgur.com/GnyDvKN.gif" alt="Carregando..." width="40">
			</div>
			<div id="search-results"></div>
		</div>

		<div class="leia_mais" id="leia-mais">
			<h1>Leia mais</h1>
			<?php
			$paged = get_query_var('paged') ? get_query_var('paged') : 1;
			$query = new WP_Query([
				'post_type' => 'noticia',
				'posts_per_page' => 10,
				'post_status' => 'publish',
				'paged' => $paged,
			]);
			if ($query->have_posts()):
				while ($query->have_posts()): $query->the_post();
					$img = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
					if (!$img) $img = 'https://i.imgur.com/EmBfP1e.png';
					$author = get_the_author();
					$date = get_the_date('d \d\e F \d\e Y');
			?>
					<a href="<?php the_permalink(); ?>">
						<div class="noticia">
							<div class="imagem" style="background-image:url('<?php echo esc_url($img); ?>');"></div>
							<div class="conteudo">
								<p><?php the_title(); ?></p>
								<p><?php echo $date; ?> - <?php echo esc_html($author); ?></p>
								<p><?php echo esc_html(get_the_excerpt()); ?></p>
							</div>
						</div>
					</a>
			<?php
				endwhile;
				// PAGINAÇÃO:
				echo '<div class="paginacao" style="text-align:center; margin:30px 0;">';
				echo paginate_links([
					'total' => $query->max_num_pages,
					'current' => $paged,
					'end_size' => 2,
					'mid_size' => 2,
					'prev_text' => '« Anterior',
					'next_text' => 'Próxima »',
				]);
				echo '</div>';
				wp_reset_postdata();
			else:
				echo '<p>Nenhuma notícia encontrada.</p>';
			endif;
			?>
		</div>

	</div>
	<div class="col l4 s12">
		<?php get_template_part('sidebar'); ?>
	</div>
</div>

<script>
	document.getElementById('search-form').addEventListener('submit', function(e) {
		e.preventDefault();
		let term = document.getElementById('keyword').value.trim();
		let loading = document.getElementById('search-loading');
		let leiaMais = document.getElementById('leia-mais');
		if (!term) return;

		loading.style.display = 'block';
		leiaMais.innerHTML = ""; // Limpa enquanto busca

		fetch('<?php echo admin_url("admin-ajax.php"); ?>?action=dbr_ajax_search&keyword=' + encodeURIComponent(term))
			.then(response => response.json())
			.then(data => {
				loading.style.display = 'none';
				if (data.length > 0) {
					leiaMais.innerHTML = `<h1>Resultados encontrados</h1>` +
						data.map(item =>
							`<a href="${item.link}">
              <div class="noticia">
                <div class="imagem" style="background-image:url('${item.img}');"></div>
                <div class="conteudo">
                  <p>${item.title}</p>
                  <p>${item.date} - ${item.author}</p>
                  <p>${item.excerpt}</p>
                </div>
              </div>
            </a>`
						).join('');
				} else {
					leiaMais.innerHTML = `<h1>Resultados encontrados</h1><p>Nenhuma notícia encontrada.</p>`;
				}
			})
			.catch(err => {
				loading.style.display = 'none';
				leiaMais.innerHTML = `<p>Erro ao buscar resultados.</p>`;
			});
	});
</script>

<?php get_footer(); ?>