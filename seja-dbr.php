<?php
/*
Template Name: Seja do DBR
*/


// PROCESSAMENTO DO FORMULÁRIO
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST['dbr_honey'])) {
  $nickname = sanitize_text_field($_POST['nickname_dbr'] ?? '');
  $motivo = sanitize_text_field($_POST['motivo'] ?? '');
  $horarios = sanitize_text_field($_POST['horarios'] ?? '');

  if ($nickname && $motivo && $horarios) {
    $webhook_url = get_field('discord_webhook_url_seja_dbr', 'option');
    $ip_user = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field($_SERVER['REMOTE_ADDR']) : 'N/A';

    if ($webhook_url) {
      $mensagem = "**Nova inscrição pelo site!**\n"
        . "**Nickname:** {$nickname}\n"
        . "**Motivo:** {$motivo}\n"
        . "**Horários:** {$horarios}\n"
        . "**IP:** {$ip_user}";

      $payload = [
        'content' => $mensagem,
      ];

      $response = wp_remote_post($webhook_url, [
        'body'    => json_encode($payload),
        'headers' => ['Content-Type' => 'application/json'],
        'timeout' => 10
      ]);

      if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) == 204) {
        // SUCESSO! Redireciona para evitar reenvio
        wp_redirect(add_query_arg('enviado', '1', get_permalink()));
        exit;
      } else {
        // ERRO no envio
        wp_redirect(add_query_arg('erro', '1', get_permalink()));
        exit;
      }
    } else {
      wp_redirect(add_query_arg('erro', '2', get_permalink()));
      exit;
    }
  } else {
    wp_redirect(add_query_arg('erro', '3', get_permalink()));
    exit;
  }
}

// Mensagem após redirect
if (isset($_GET['enviado'])) {
  $msg = '<div class="card-panel green lighten-2 white-text" style="margin: 15px 0;">Inscrição enviada com sucesso! Aguarde o contato de um administrador.</div>';
} elseif (isset($_GET['erro'])) {
  if ($_GET['erro'] == '1') {
    $msg = '<div class="card-panel red lighten-2 white-text" style="margin: 15px 0;">Ocorreu um erro ao enviar. Tente novamente.</div>';
  } elseif ($_GET['erro'] == '2') {
    $msg = '<div class="card-panel red lighten-2 white-text" style="margin: 15px 0;">Webhook do Discord não configurado nas opções do tema.</div>';
  } elseif ($_GET['erro'] == '3') {
    $msg = '<div class="card-panel yellow lighten-2 black-text" style="margin: 15px 0;">Preencha todos os campos.</div>';
  }
}

get_header(); ?>

<div class="row" style="margin-top:90px;">
  <div class="col l8 s12" style="padding:0;">
    <div class="sobre">
      <h1><?php the_title(); ?></h1>
      <div class="divider"></div>
      <div style="display:flex;align-items: center;">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/diario.png" alt="Banner dbr" class="responsive-img" width="150">
        <p>
          Preencha o formulário ou procure um dos nossos administradores no Habbo e fale sobre o seu interesse de se juntar ao DBR.
        </p>
      </div>

      <?php if (!empty($msg)) echo $msg; ?>

      <form action="" method="POST" id="seja_membro" autocomplete="off">
        <div>
          <label for="nickname_dbr" class="active">Nickname</label>
          <input placeholder="Exemplo: Altz" id="nickname_dbr" name="nickname_dbr" type="text" class="browser-default" value="<?php echo isset($_POST['nickname_dbr']) ? esc_attr($_POST['nickname_dbr']) : ''; ?>">
        </div>

        <div>
          <label for="motivo" class="active">Por que devemos te contratar?</label>
          <input placeholder="Exemplo: Pois sou um membro dedicado." id="motivo" name="motivo" type="text" class="browser-default" value="<?php echo isset($_POST['motivo']) ? esc_attr($_POST['motivo']) : ''; ?>">
        </div>

        <div>
          <label for="horarios" class="active">Horários para ajudar o DBR</label>
          <input placeholder="Exemplo: Das 14h às 18h." id="horarios" name="horarios" type="text" class="browser-default" value="<?php echo isset($_POST['horarios']) ? esc_attr($_POST['horarios']) : ''; ?>">
        </div>
        <!-- Honeypot para anti-spam -->
        <input type="text" name="dbr_honey" style="display:none;">
        <br>
        <input type="submit" value="Enviar inscrição" class="btn red btn100">
      </form>
    </div>
  </div>

  <div class="col l4 s12">
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>