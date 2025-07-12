<?php
/*
Template Name: Cadastrar-se
*/

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nick'], $_POST['email'], $_POST['senhaa'])) {
  // Sanitize
  $username = sanitize_user(trim($_POST['nick']));
  $email    = sanitize_email(trim($_POST['email']));
  $password = $_POST['senhaa'];

  // Validações
  if (username_exists($username)) $errors[] = 'Usuário já existe.';
  if (email_exists($email)) $errors[] = 'E-mail já cadastrado.';
  if (!is_email($email)) $errors[] = 'E-mail inválido.';
  if (strlen($password) < 6) $errors[] = 'A senha deve ter pelo menos 6 caracteres.';

  // Se não houver erros, cria usuário
  if (empty($errors)) {
    $user_id = wp_create_user($username, $password, $email);
    if (!is_wp_error($user_id)) {
      // Loga automaticamente
      wp_set_auth_cookie($user_id, true);
      wp_set_current_user($user_id);
      do_action('wp_login', $username, get_user_by('id', $user_id));

      // Redireciona para home
      wp_redirect(home_url('/'));
      exit;
    } else {
      $errors[] = $user_id->get_error_message();
    }
  }
}

get_header(); ?>

<div class="row" style="margin-top:90px;">
  <!-- Coluna principal -->
  <div class="col l8 s12" style="padding:0;">
    <div class="sobre">
      <h1><?php the_title(); ?></h1>
      <div class="divider"></div>

      <div style="display:flex;align-items: center;">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/diario.png" alt="Banner dbr" class="responsive-img" width="125">
        <p>
          Queremos você conectado com a gente. Seja lendo, escrevendo, divulgando ou fazendo o que você sabe fazer: o DBR está de portas abertas! Seja um membro do site fazendo seu cadastro logo abaixo. As palavras fazem conexões. Seja bem-vindo!
        </p>
      </div>

      <?php if (!empty($errors)): ?>
        <div class="alert alert-danger" style="background:#ffe5e5;color:#b71c1c;padding:10px;margin:15px 0;">
          <ul>
            <?php foreach ($errors as $err): ?>
              <li><?php echo esc_html($err); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="POST">
        <div class="form-group">
          <label for="nick" class="browser-default active" style="color:#000;font-weight:bold;font-size:20px;">
            Nick no Habbo Hotel BR/PT
          </label>
          <input type="text" class="browser-default btn100" id="nick" name="nick" required style="height:40px;padding-left:5px;" placeholder="Exemplo: Altz" value="<?php echo isset($_POST['nick']) ? esc_attr($_POST['nick']) : ''; ?>">
        </div><br>

        <div class="form-group">
          <label for="email" style="color:#000;font-weight:bold;font-size:20px;" class="active">
            E-mail
          </label>
          <input type="email" class="browser-default btn100" id="email" name="email" required style="height:40px;padding-left:5px;" placeholder="Exemplo: fulaninho@hotmail.com (NÃO USE O MESMO E-MAIL DO SEU HABBO)" value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>">
        </div><br>

        <div class="form-group">
          <label for="senhaa" style="color:#000;font-weight:bold;font-size:20px;" class="active">
            Senha
          </label>
          <input type="password" class="browser-default btn100" id="senhaa" name="senhaa" required style="height:40px;padding-left:5px;" placeholder="Digite uma senha diferente da do seu habbo aqui">
        </div><br>

        <div class="form-group">
          <label style="color:#000;font-weight:bold;font-size:20px;">Cole na sua missão</label>
          <input type="hidden" name="codigo_hb" value="DBR7457">
          <p style="height:50px;background:#ffa800;line-height:50px;color:#fff;font-weight:bold;text-align:center;border-radius:2px;font-size:30px;margin-top: 0;">DBR7457</p>
        </div>

        <div style="display: flex;justify-content: center;margin-bottom:10px;">
          <div id="captcha_element2">
            <!-- Coloque seu reCAPTCHA aqui, se usar -->
          </div>
        </div>

        <input type="submit" value="É isso! Seja bem-vindo." class="btn red btn100" style="font-size:20px;font-weight:bold;">
      </form>
    </div>
  </div>

  <!-- SIDEBAR (coluna lateral) -->
  <div class="col l4 s12">
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>