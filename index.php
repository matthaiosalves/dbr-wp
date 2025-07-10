<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
				<!-- Colunas -->
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
				<!-- Equipe (avatars e links) -->
				<!-- Cole aqui todos os avatares exatamente como seu HTML -->
				<a href="https://exbrhb.net/perfil/Evilaso" target="_blank">
					<img src="https://www.habbo.com.br/habbo-imaging/avatarimage?user=Evilaso&action=std&direction=3&head_direction=3&gesture=sml&size=l" alt="Avatar no habbo" style="z-index:1;margin-top:-85px;height:133px;margin-right:-35px; margin-left:-11px;" class="tooltipped" data-position="bottom" data-tooltip="AC, Evilaso" />
				</a>
				<!-- ...continue todos os avatares como no HTML original... -->
			</div>
		</div>

		<form action="https://diario.forcasarmadasbrhb.net/" method="GET">
			<div class="search-bar">
				<input class="search-input browser-default" type="text" id="keyword" name="keyword" placeholder="Pesquisar notícia...">
				<button class="search-button browser-default" type="submit"><i class="fa fa-search" style="font-size: 18px;"></i></button>
			</div>
		</form>

		<div class="leia_mais">
			<h1>Leia mais</h1>
			<!-- Cole aqui TODOS os blocos de notícia do "Leia mais" igual ao seu HTML -->
			<a href="https://diario.forcasarmadasbrhb.net/noticia/4959/aberta-as-inscricoes-da-espcex">
				<div class="noticia">
					<div class="imagem" style="background-image:url('https://imgur.com/Ko4MtlJ.png');"></div>
					<div class="conteudo">
						<p>ABERTA ÀS INSCRIÇÕES DA ESPCEx!!</p>
						<p>
							09 de
							Julho de 2025 -
							joaovitor989 </p>
						<p>Está aberta às inscrições para se tornar um Cadete do nosso Exército Brasileiro.</p>
					</div>
				</div>
			</a>
			<!-- ...continue TODOS os outros blocos de notícia do "Leia mais" igual seu HTML -->
		</div>
	</div>
	<div class="col l4 s12">
		<?php get_template_part('sidebar'); ?>
	</div>
</div>

<?php get_footer(); ?>