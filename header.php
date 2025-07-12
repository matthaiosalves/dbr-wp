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
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>

	<link rel="icon" type="image/x-icon" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/favicon.ico'); ?>" />

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="Leia, em primeira mão, as notícias do Exército Brasileiro!">
	<meta property="og:site_name" content="Diário Brasileiro - Rainer">
	<meta property="og:title" content="Diário Brasileiro - Rainer">
	<meta property="og:description" content="Leia, em primeira mão, as notícias do Exército Brasileiro!">
	<meta property="og:url" content="<?php echo esc_url(home_url('/')); ?>">
	<meta property="og:locale" content="pt_BR">
	<meta property="og:image" content="https://i.imgur.com/VCYRVsP.png">
	<meta name="twitter:site" content="@exbrhabbo_" />
	<meta name="twitter:title" content="Diário Brasileiro - Rainer" />
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:creator" content="@exbrhabbo_" />
	<meta name="theme-color" content="#ffa800">
	<link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Teko&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/normalize.css" />
	<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/main.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script data-ad-client="ca-pub-3124063303337744" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
		const c = el => document.querySelector(el);
		const ca = el => document.querySelectorAll(el);
		const BASE = '<?php echo home_url('/'); ?>';
	</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<!-- Login Dropdown (mantido do original, você pode tirar depois) -->
	<ul id="login" class="dropdown-content">
		<form action="<?php echo esc_url(wp_login_url()); ?>" method="POST" autocomplete="username">
			<div class="form-group">
				<label for="user_login">Nick</label>
				<input type="text" name="log" id="user_login" placeholder="Digite seu nickname" class="browser-default" required autocomplete="username">
			</div>
			<div class="form-group">
				<label for="user_pass">Senha</label>
				<input type="password" name="pwd" id="user_pass" placeholder="Digite sua senha" class="browser-default" required autocomplete="current-password">
			</div>
			<a href="<?php echo esc_url(wp_lostpassword_url()); ?>" style="line-height:0;margin-top:15px;margin-bottom:20px;text-align:end;color:red;">Esqueci minha senha</a>
			<div id="captcha_element"></div>
			<input type="submit" value="VAMOS LÁ!" class="btn btn100 red" />
			<input type="hidden" name="redirect_to" value="<?php echo esc_url(home_url('/')); ?>">
		</form>
	</ul>

	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper">
				<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
				<a href="<?php echo home_url('/'); ?>" class="show-on-medium-and-down" style="height:55px;background:unset;display: none;line-height: 65px;text-align: center;">
					<img
						src="<?php echo get_template_directory_uri(); ?>/assets/images/dbr.png"
						alt="DBR Logo"
						width="64"
						onerror="this.onerror=null;this.src='<?php echo get_template_directory_uri(); ?>/assets/images/dbr.png';">

				</a>
				<ul class="hide-on-med-and-down">
					<li>
						<a href="<?php echo home_url('/'); ?>" style="display:flex;justify-content:center;align-items:center;height:55px;background:unset;">
							<img
								src="<?php echo get_template_directory_uri(); ?>/assets/images/dbr.png"
								alt="DBR Logo"
								width="64"
								onerror="this.onerror=null;this.src='<?php echo get_template_directory_uri(); ?>/assets/images/dbr.png';">
						</a>
					</li>
					<li><a href="<?php echo home_url('/'); ?>">INÍCIO</a></li>
					<li><a href="<?php echo home_url('/sobre'); ?>">O DBR</a></li>
					<li><a href="<?php echo home_url('/colunas-posts'); ?>">COLUNAS E POSTS</a></li>
					<li><a href="<?php echo home_url('/equipe'); ?>">EQUIPE</a></li>
					<li><a href="<?php echo home_url('/seja-do-dbr'); ?>">SEJA DO DBR</a></li>
					<li><a href="https://diario-br.blogspot.com.br">ARQUIVO</a></li>
					<li><a href="<?php echo home_url('/fale-conosco'); ?>">FALE CONOSCO</a></li>

					<?php if (is_user_logged_in()):
						$user = wp_get_current_user();
						$user_name = $user->display_name ? $user->display_name : $user->user_login;
					?>
						<li class="right" style="margin-right:25px;">
							<a class="dropdown-trigger perfil-dropdown" href="#!" data-target="perfil_drop">
								<div class="avata">
									<img src="https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?php echo esc_attr($user_name); ?>&action=std&direction=3&head_direction=3&gesture=sml&size=m" alt="avatar no habbo" width="50">
								</div>
								<span><?php echo esc_html($user_name); ?></span>
							</a>
							<ul id="perfil_drop" class="dropdown-content" tabindex="0">
								<p tabindex="0">Olá, <?php echo esc_html($user_name); ?>!</p>
								<div class="avata" tabindex="0">
									<img src="https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?php echo esc_attr($user_name); ?>&action=std&direction=3&head_direction=3&gesture=sml&size=l" alt="Avatar no habbo">
								</div>
								<a href="<?php echo home_url('/painel'); ?>" class="btn red btn100" tabindex="0">Painel da Equipe</a>
								<a href="<?php echo wp_logout_url(home_url('/')); ?>" class="btn red btn100" tabindex="0">Sair</a>
							</ul>
						</li>
					<?php else: ?>
						<li class="right"><a href="<?php echo home_url('/cadastrar-se'); ?>">CADASTRE-SE</a></li>
						<li class="right"><a class="dropdown-trigger login-dropdown" href="#!" data-target="login">LOGIN</a></li>
					<?php endif; ?>
				</ul>

			</div>
		</nav>
	</div>
	<ul id="slide-out" class="sidenav">
		<li><a href="<?php echo home_url('/'); ?>">INÍCIO</a></li>
		<li>
			<div class="divider"></div>
		</li>
		<li><a href="<?php echo home_url('/sobre'); ?>">O DBR</a></li>
		<li><a href="<?php echo home_url('/colunas-posts'); ?>">COLUNAS E POSTS</a></li>
		<li><a href="<?php echo home_url('/equipe'); ?>">EQUIPE</a></li>
		<li><a href="<?php echo home_url('/seja-do-dbr'); ?>">SEJA DO DBR</a></li>
		<li><a href="https://diario-br.blogspot.com.br">ARQUIVO</a></li>
		<li><a href="<?php echo home_url('/fale-conosco'); ?>">FALE CONOSCO</a></li>
		<li>
			<div class="divider"></div>
		</li>
		<li><a href="<?php echo home_url('/login'); ?>">LOGIN</a></li>
		<li><a href="<?php echo home_url('/cadastrar-se'); ?>">CADASTRE-SE</a></li>
	</ul>
	<div class="container" style="margin-top:10px;">