<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Diário_Brasileiro_Habbo
 */

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Início - Diário Brasileiro</title>
	<link rel="shortcut icon" type="image/x-icon" href="https://diario.forcasarmadasbrhb.net/assets/images/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="Leia, em primeira mão, as notícias do Exército Brasileiro!">
	<meta property="og:site_name" content="Diário Brasileiro - Rainer">
	<meta property="og:title" content="Diário Brasileiro - Rainer">
	<meta property="og:description" content="Leia, em primeira mão, as notícias do Exército Brasileiro!">
	<meta property="og:url" content="https://diario.forcasarmadasbrhb.net/">
	<meta property="og:locale" content="pt_BR">
	<meta property="og:image" content="https://i.imgur.com/VCYRVsP.png">
	<meta name="twitter:site" content="exbrhabbo_" />
	<meta name="twitter:title" content="Diário Brasileiro - Rainer" />
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="exbrhabbo_" />
	<meta name="twitter:creator" content="exbrhabbo_" />
	<meta name="theme-color" content="#ffa800">

	<link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Teko&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://diario.forcasarmadasbrhb.net/assets/css/normalize.css" />
	<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
	<link rel="stylesheet" type="text/css" href="https://diario.forcasarmadasbrhb.net/assets/css/main.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script data-ad-client="ca-pub-3124063303337744" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
		const c = el => document.querySelector(el)
		const ca = el => document.querySelectorAll(el)
		const BASE = 'https://diario.forcasarmadasbrhb.net/'
	</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<!-- Login Dropdown (mantido do original, você pode tirar depois) -->
	<ul id="login" class="dropdown-content">
		<form action="https://diario.forcasarmadasbrhb.net/login/logar" method="POST">
			<div class="form-group">
				<label for="nickname">Nick</label>
				<input type="text" name="nickname" id="nickname" placeholder="Digite seu nickname" class="browser-default" required>
			</div>
			<div class="form-group">
				<label for="senha">Senha</label>
				<input type="password" name="senha" id="senha" placeholder="Digite sua senha" class="browser-default" required>
			</div>
			<a href="https://diario.forcasarmadasbrhb.net/esqueci-minha-senha" style="line-height:0;margin-top:15px;margin-bottom:20px;text-align:end;color:red;">Esqueci minha senha</a>
			<div id="captcha_element"></div>
			<input type="submit" value="VAMOS LÁ!" class="btn btn100 red" />
		</form>
	</ul>

	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper">
				<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
				<a href="https://diario.forcasarmadasbrhb.net/" class="show-on-medium-and-down" style="height:55px;background:unset;display: none;line-height: 65px;text-align: center;">
					<img src="https://diario.forcasarmadasbrhb.net/assets/images/dbr.png" alt="DBR Logo" width="64">
				</a>
				<ul class="hide-on-med-and-down">
					<li>
						<a href="https://diario.forcasarmadasbrhb.net/" style="display:flex;justify-content:center;align-items:center;height:55px;background:unset;">
							<img src="https://diario.forcasarmadasbrhb.net/assets/images/dbr.png" alt="DBR Logo" width="64">
						</a>
					</li>
					<li><a href="https://diario.forcasarmadasbrhb.net/">INÍCIO</a></li>
					<li><a href="https://diario.forcasarmadasbrhb.net/diario/sobre">O DBR</a></li>
					<li><a href="https://diario.forcasarmadasbrhb.net/diario/colunas-posts">COLUNAS E POSTS</a></li>
					<li><a href="https://diario.forcasarmadasbrhb.net/diario/equipe">EQUIPE</a></li>
					<li><a href="https://diario.forcasarmadasbrhb.net/diario/seja-do-dbr">SEJA DO DBR</a></li>
					<li><a href="https://diario-br.blogspot.com.br">ARQUIVO</a></li>
					<li><a href="https://diario.forcasarmadasbrhb.net/diario/fale-conosco">FALE CONOSCO</a></li>
					<li class="right"><a href="https://diario.forcasarmadasbrhb.net/cadastrar-se">CADASTRE-SE</a></li>
					<li class="right"><a class="dropdown-trigger login-dropdown" href="#!" data-target="login">LOGIN</a></li>
				</ul>
			</div>
		</nav>
	</div>
	<ul id="slide-out" class="sidenav">
		<li><a href="https://diario.forcasarmadasbrhb.net/">INÍCIO</a></li>
		<li>
			<div class="divider"></div>
		</li>
		<li><a href="https://diario.forcasarmadasbrhb.net/diario/sobre">O DBR</a></li>
		<li><a href="https://diario.forcasarmadasbrhb.net/diario/colunas-posts">COLUNAS E POSTS</a></li>
		<li><a href="https://diario.forcasarmadasbrhb.net/diario/equipe">EQUIPE</a></li>
		<li><a href="https://diario.forcasarmadasbrhb.net/diario/seja-do-dbr">SEJA DO DBR</a></li>
		<li><a href="https://diario-br.blogspot.com.br">ARQUIVO</a></li>
		<li><a href="https://diario.forcasarmadasbrhb.net/diario/fale-conosco">FALE CONOSCO</a></li>
		<li>
			<div class="divider"></div>
		</li>
		<li><a href="https://diario.forcasarmadasbrhb.net/login">LOGIN</a></li>
		<li><a href="https://diario.forcasarmadasbrhb.net/cadastrar-se">CADASTRE-SE</a></li>
	</ul>
	<div class="container" style="margin-top:10px;">