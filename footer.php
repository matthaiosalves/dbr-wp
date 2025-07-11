<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Diário_Brasileiro_Habbo
 */

?>

</div> <!-- .container -->

<footer class="page-footer">
	<div class="container">
		<div class="row">
			<div class="col l2 s12">
				<img src="https://diario.forcasarmadasbrhb.net/assets/images/dbr.png" alt="DBR Logo">
			</div>
			<div class="col l10 s12">
				<p>Este site não possui vínculos com o Exército Brasileiro, não é de propriedade ou operado pela Sulake Corporation Oy e não é parte do Habbo Hotel®. Desenvolvido por sr.carolvitoria e majoryanzinho.</p>
			</div>
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">
			© 2012 - 2025 Copyright Diário Brasileiro, DBR
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="https://diario.forcasarmadasbrhb.net/assets/js/script.js"></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v5.0&appId=1304937852983491&autoLogAppEvents=1"></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

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


</body>

</html>