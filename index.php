<?php

/**
 * The main template file
 *
 * @package Diário_Brasileiro_Habbo
 */

get_header(); ?>

<div class="destaques">
	<div class="row" style="margin-bottom:0;">
		<div class="col l6 s12" style="padding:0 .15rem;">
			<div class="noticia" style="background-image:url('https://imgur.com/Ko4MtlJ.png');">
				<a href="https://diario.forcasarmadasbrhb.net/noticia/4959/aberta-as-inscricoes-da-espcex">
					<div class="categoria">EsPCEx</div>
					<p>
						ABERTA ÀS INSCRIÇÕES DA ESPCEx!!
						<span class="por">
							09 de Julho - joaovitor989
						</span>
					</p>
				</a>
			</div>
			<div class="noticia" style="background-image:url('https://i.imgur.com/LGyzr9P.png');">
				<a href="https://diario.forcasarmadasbrhb.net/noticia/4958/veja-os-aprovados-da-epcar-20252">
					<div class="categoria">EPCAr</div>
					<p>
						Veja os aprovados da EPCAr 2025.2
						<span class="por">
							06 de Julho - Hiccup
						</span>
					</p>
				</a>
			</div>
			<div class="noticia" style="background-image:url('https://i.imgur.com/Eonwg8j.png');">
				<a href="https://diario.forcasarmadasbrhb.net/noticia/4954/venha-fazer-parte-da-laranjinha">
					<div class="categoria">Aeronáutica no Ar</div>
					<p>
						Venha fazer parte da laranjinha!
						<span class="por">
							05 de Julho - mique_004
						</span>
					</p>
				</a>
			</div>
		</div>
		<div class="col l6 s12" style="padding:0 .15rem;">
			<div class="noticia" style="background-image:url('https://i.imgur.com/LGyzr9P.png');">
				<a href="https://diario.forcasarmadasbrhb.net/noticia/4953/se-inicia-a-epcar-20252">
					<div class="categoria">EPCAr</div>
					<p>
						Se inicia a EPCAr 2025.2
						<span class="por">
							05 de Julho - Hiccup
						</span>
					</p>
				</a>
			</div>
			<div class="noticia" style="background-image:url('https://i.imgur.com/Kx65qEi.png');">
				<a href="https://diario.forcasarmadasbrhb.net/noticia/4952/inscricoes-abertas-copa-br">
					<div class="categoria">ArenaBR</div>
					<p>
						INSCRIÇÕES ABERTAS - COPA BR
						<span class="por">
							18 de Junho - Luba012
						</span>
					</p>
				</a>
			</div>
			<div class="noticia" style="background-image:url('https://i.imgur.com/l6qgkll_d.webp?maxwidth=760&fidelity=grand');">
				<a href="https://diario.forcasarmadasbrhb.net/noticia/4951/feliz-aniversario-jhoao">
					<div class="categoria">Aniversário</div>
					<p>
						FELIZ ANIVERSÁRIO JHOAO.:!
						<span class="por">
							17 de Junho - Cr.Edu16
						</span>
					</p>
				</a>
			</div>
		</div>
	</div>
</div>

<div class="row" style="margin-bottom:0;">
	<div class="col l8 s12" style="padding:0;">
		<div class="colunas">
			<h1>Colunas</h1>
			<div class="gallery js-flickity" data-flickity-options='{ "freeScroll": true, "groupCells":true, "autoPlay": 2000, "cellAlign": "left", "prevNextButtons": false, "pageDots": false }' style="overflow:hidden;margin-top:10px;">
				<!-- Colunas fixas (continue conforme seu HTML original) -->
				<a href="https://diario.forcasarmadasbrhb.net/noticia/4958/veja-os-aprovados-da-epcar-20252" class="gallery-cell">
					<div class="coluna">
						<h5>EPCAr</h5>
						<div class="noticia" style="background-image:url('https://i.imgur.com/LGyzr9P.png');background-repeat: no-repeat;background-size: cover;background-position: center center;">
							Veja os aprovados da EPCAr 2025.2
						</div>
					</div>
				</a>
				<a href="https://diario.forcasarmadasbrhb.net/noticia/4954/venha-fazer-parte-da-laranjinha" class="gallery-cell">
					<div class="coluna">
						<h5>Aeronáutica no Ar</h5>
						<div class="noticia" style="background-image:url('https://i.imgur.com/Eonwg8j.png');background-repeat: no-repeat;background-size: cover;background-position: center center;">
							Venha fazer parte da laranjinha!
						</div>
					</div>
				</a>
				<a href="https://diario.forcasarmadasbrhb.net/noticia/4953/se-inicia-a-epcar-20252" class="gallery-cell">
					<div class="coluna">
						<h5>EPCAr</h5>
						<div class="noticia" style="background-image:url('https://i.imgur.com/LGyzr9P.png');background-repeat: no-repeat;background-size: cover;background-position: center center;">
							Se inicia a EPCAr 2025.2
						</div>
					</div>
				</a>
				<a href="https://diario.forcasarmadasbrhb.net/noticia/4952/inscricoes-abertas-copa-br" class="gallery-cell">
					<div class="coluna">
						<h5>ArenaBR</h5>
						<div class="noticia" style="background-image:url('https://i.imgur.com/Kx65qEi.png');background-repeat: no-repeat;background-size: cover;background-position: center center;">
							INSCRIÇÕES ABERTAS - COPA BR
						</div>
					</div>
				</a>
				<!-- ...continue todas as colunas do seu HTML igual estava... -->
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

<?php get_footer(); ?>