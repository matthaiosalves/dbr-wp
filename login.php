<?php
/*
Template Name: Login
*/

$msg = '';
if (isset($_GET['login']) && $_GET['login'] == 'failed') {
  $msg = '<div class="card-panel red lighten-2 white-text" style="margin: 15px 0;">Usuário ou senha inválidos.</div>';
}
if (is_user_logged_in()) {
  wp_redirect(home_url('/painel'));
  exit;
}
get_header();
?>

<div class="row" style="margin-top:90px;">
  <div class="col l8 s12" style="padding:0;">
    <div class="sobre">
      <h1>Login</h1>
      <div class="divider"></div>
      <?php if (!empty($msg)) echo $msg; ?>

      <form action="<?php echo esc_url(wp_login_url()); ?>" method="POST" autocomplete="off" style="margin-top:30px;">
        <div class="form-group">
          <label for="user_login" class="browser-default active" style="color:#000;font-weight:bold;font-size:20px;">
            Nickname
          </label>
          <input type="text" class="browser-default btn100" id="user_login" name="log" required style="height:40px;padding-left:5px;" placeholder="Exemplo: Altz" autofocus>
        </div><br>

        <div class="form-group">
          <label for="user_pass" style="color:#000;font-weight:bold;font-size:20px;" class="active">
            Senha
          </label>
          <input type="password" class="browser-default btn100" id="user_pass" name="pwd" required style="height:40px;padding-left:5px;" placeholder="Digite uma senha diferente da do seu habbo aqui">
        </div><br>

        <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" style="line-height:0;margin-top: -10px;margin-bottom: 30px;text-align:end;color:red;display: block;font-weight: bold;">Esqueci minha senha</a>

        <!-- CAPTCHAs ou honeypot (opcional)
        <input type="text" name="dbr_honey" style="display:none;">
        -->

        <input type="submit" value="É isso! Seja bem-vindo." class="btn red btn100" style="font-size:20px;font-weight:bold;">
      </form>
    </div>
  </div>
  <div class="col l4 s12">
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>