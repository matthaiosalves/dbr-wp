<?php
/*
Template Name: Perfil
*/
$msg = '';
if (!is_user_logged_in()) {
  wp_redirect(wp_login_url(get_permalink()));
  exit;
}

$current_user = wp_get_current_user();
$user_id = $current_user->ID;

if (!session_id()) session_start();

if (empty($_SESSION['dbr_habbo_verification_code'][$user_id]) || empty($_SESSION['dbr_habbo_verification_expire'][$user_id]) || $_SESSION['dbr_habbo_verification_expire'][$user_id] < time()) {
  $_SESSION['dbr_habbo_verification_code'][$user_id] = 'DBR' . sprintf('%04d', rand(0, 9999));
  $_SESSION['dbr_habbo_verification_expire'][$user_id] = time() + 60;
}
$verification_code = $_SESSION['dbr_habbo_verification_code'][$user_id];
$expire_ts = $_SESSION['dbr_habbo_verification_expire'][$user_id];

$verificado = intval(get_user_meta($user_id, 'verificado_habbo', true));

// Lógica de alteração de senha (igual já estava)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST['dbr_honey'])) {
  $senha_atual = $_POST['senha_atual'] ?? '';
  $nova_senha = $_POST['nova_senha'] ?? '';
  $confirma_senha = $_POST['confirma_senha'] ?? '';

  if (empty($senha_atual) || empty($nova_senha) || empty($confirma_senha)) {
    $msg = '<div class="card-panel yellow lighten-2 black-text" style="margin: 15px 0;">Preencha todos os campos.</div>';
  } elseif (!wp_check_password($senha_atual, $current_user->user_pass, $current_user->ID)) {
    $msg = '<div class="card-panel red lighten-2 white-text" style="margin: 15px 0;">Senha atual incorreta.</div>';
  } elseif ($nova_senha !== $confirma_senha) {
    $msg = '<div class="card-panel red lighten-2 white-text" style="margin: 15px 0;">A nova senha e a confirmação não coincidem.</div>';
  } elseif (strlen($nova_senha) < 6) {
    $msg = '<div class="card-panel yellow lighten-2 black-text" style="margin: 15px 0;">A nova senha deve ter pelo menos 6 caracteres.</div>';
  } else {
    wp_set_password($nova_senha, $current_user->ID);
    wp_set_auth_cookie($current_user->ID, true);
    $msg = '<div class="card-panel green lighten-2 white-text" style="margin: 15px 0;">Senha alterada com sucesso!</div>';
  }
}

get_header();
?>

<div class="row" style="margin-top:90px;">
  <div class="col l8 s12" style="padding:0;">
    <div class="sobre">
      <h1>Perfil</h1>
      <div class="divider"></div>

      <?php if (!empty($msg)) echo $msg; ?>

      <?php if (!isset($_POST['nova_senha']) || !empty($msg)) : ?>
        <form action="" method="POST" autocomplete="off" style="margin-top:30px;">
          <div class="form-group" style="margin-bottom: 20px;">
            <label for="senha_atual" class="browser-default active" style="color:#000;font-weight:bold;font-size:20px;">Senha Atual</label>
            <input id="senha_atual" name="senha_atual" type="password" class="browser-default btn100" autocomplete="current-password" required style="height:40px;padding-left:5px;">
          </div>
          <div class="form-group" style="margin-bottom: 20px;">
            <label for="nova_senha" class="browser-default active" style="color:#000;font-weight:bold;font-size:20px;">Nova Senha</label>
            <input id="nova_senha" name="nova_senha" type="password" class="browser-default btn100" autocomplete="new-password" required style="height:40px;padding-left:5px;">
          </div>
          <div class="form-group" style="margin-bottom: 20px;">
            <label for="confirma_senha" class="browser-default active" style="color:#000;font-weight:bold;font-size:20px;">Confirmar Nova Senha</label>
            <input id="confirma_senha" name="confirma_senha" type="password" class="browser-default btn100" autocomplete="new-password" required style="height:40px;padding-left:5px;">
          </div>
          <!-- Honeypot para anti-spam -->
          <input type="text" name="dbr_honey" style="display:none;">
          <br>
          <input type="submit" value="Alterar senha" class="btn red btn100">
        </form>
      <?php endif; ?>

      <div class="form-group" style="margin-top:50px;">
        <?php if ($verificado) : ?>
          <div class="card-panel green lighten-2 white-text" style="margin: 15px 0; text-align:center; font-size:20px; font-weight:bold;">
            ✅ Identidade verificada com sucesso!
          </div>
        <?php else : ?>
          <label class="browser-default active" style="color:#000;font-weight:bold;font-size:20px;">
            Cole na sua missão
          </label>
          <input type="hidden" name="codigo_hb" id="codigo_hb" value="<?php echo esc_attr($verification_code); ?>">
          <p id="codigo-habbo" style="height:50px;background:#ffa800;line-height:50px;color:#fff;font-weight:bold;text-align:center;border-radius:2px;font-size:30px;margin-top: 0;">
            <?php echo esc_html($verification_code); ?>
          </p>
          <div id="timer" style="font-weight:bold;color:#333;text-align:center;margin-top:0;margin-bottom:12px;">
            Novo código em: <span id="timer-count"></span>
          </div>
          <!-- Botão opcional, mas agora não faz sentido: -->
          <!-- <button id="novo-codigo-btn" class="btn" style="margin-top:10px;">Gerar novo código</button> -->
          <button id="verificar-codigo-btn" class="btn" style="margin-top:10px;">Confirmar identidade</button>
          <p id="msg-habbo-verifica" style="margin-top:12px;"></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="col l4 s12">
    <?php get_sidebar(); ?>
  </div>
</div>

<script>
  let expireTs = <?php echo intval($expire_ts); ?>;
  let timerEl = document.getElementById('timer-count');
  let codeEl = document.getElementById('codigo-habbo');
  let codeInput = document.getElementById('codigo_hb');
  let interval;

  function refreshCode() {
    fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=novo_codigo_habbo', {
        method: 'POST',
        credentials: 'same-origin'
      })
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          codeEl.textContent = data.data.code;
          codeInput.value = data.data.code;
          expireTs = Math.floor(Date.now() / 1000) + 60;
          startTimer();
        }
      });
  }

  function startTimer() {
    clearInterval(interval);
    interval = setInterval(function() {
      let now = Math.floor(Date.now() / 1000);
      let secondsLeft = expireTs - now;
      if (secondsLeft < 0) secondsLeft = 0;
      let min = Math.floor(secondsLeft / 60);
      let sec = secondsLeft % 60;
      timerEl.textContent = `${min < 10 ? '0'+min : min}:${sec < 10 ? '0'+sec : sec}`;
      if (secondsLeft <= 0) {
        clearInterval(interval);
        refreshCode();
      }
    }, 200);
  }

  <?php if (!$verificado) : ?>
    startTimer();
  <?php endif; ?>

  document.getElementById('verificar-codigo-btn') && document.getElementById('verificar-codigo-btn').addEventListener('click', function(e) {
    e.preventDefault();
    var msgEl = document.getElementById('msg-habbo-verifica');
    msgEl.textContent = 'Verificando...';
    fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=verifica_habbo_missao', {
        method: 'POST',
        credentials: 'same-origin'
      })
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          msgEl.innerHTML = "<span style='color:green'>" + data.data.msg + "</span>";
          setTimeout(function() {
            window.location.reload();
          }, 1200);
        } else {
          msgEl.innerHTML = "<span style='color:red'>" + (data.data ? data.data.msg : "Erro!") + "</span>";
        }
      });
  });
</script>

<?php get_footer(); ?>