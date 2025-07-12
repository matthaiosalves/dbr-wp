<?php
/*
Template Name: Fale Conosco 
*/

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST['dbr_honey'])) {
  $nickname = sanitize_text_field($_POST['nickname_dbr'] ?? '');
  $comentario = sanitize_textarea_field($_POST['comentario'] ?? '');

  if ($nickname && $comentario) {
    $webhook_url = get_field('discord_webhook_url_fale_conosco', 'option');
    $ip_user = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field($_SERVER['REMOTE_ADDR']) : 'N/A';

    if ($webhook_url) {
      $mensagem = "**Nova mensagem pelo formulário de sugestão!**\n"
        . "**Nickname:** {$nickname}\n"
        . "**Mensagem:** {$comentario}\n"
        . "**IP:** {$ip_user}";
      $payload = ['content' => $mensagem];

      $response = wp_remote_post($webhook_url, [
        'body'    => json_encode($payload),
        'headers' => ['Content-Type' => 'application/json'],
        'timeout' => 10
      ]);

      if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) == 204) {
        $msg = '<div class="card-panel green lighten-2 white-text" style="margin: 15px 0;">Mensagem enviada com sucesso! Obrigado por sua sugestão.</div>';
      } else {
        $msg = '<div class="card-panel red lighten-2 white-text" style="margin: 15px 0;">Ocorreu um erro ao enviar. Tente novamente.</div>';
      }
    } else {
      $msg = '<div class="card-panel red lighten-2 white-text" style="margin: 15px 0;">Webhook do Discord não configurado nas opções do tema.</div>';
    }
  } else {
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
          Caso você tenha alguma ideia, sugestão ou uma notícia que queira compartilhar com o DBR essa é a sua chance de fazer, basta preencher o formulário.
        </p>
      </div>

      <?php if (!empty($msg)) echo $msg; ?>

      <form action="" method="POST" id="seja_membro" autocomplete="off">
        <div>
          <label for="nickname_dbr" class="active">Nickname</label>
          <input placeholder="Exemplo: Altz" id="nickname_dbr" name="nickname_dbr" type="text" class="browser-default" value="<?php echo isset($_POST['nickname_dbr']) ? esc_attr($_POST['nickname_dbr']) : ''; ?>">
        </div>

        <div>
          <label for="comentario" class="active">Mensagem</label>
          <textarea name="comentario" id="comentario" style="resize:none;padding-left:4px;overflow: hidden;" placeholder="Digite sua mensagem aqui" onkeyup="M.textareaAutoResize($('#comentario'))"><?php echo isset($_POST['comentario']) ? esc_textarea($_POST['comentario']) : ''; ?></textarea>
        </div>
        <!-- Honeypot para anti-spam -->
        <input type="text" name="dbr_honey" style="display:none;">
        <br>
        <input type="submit" value="Enviar" class="btn red btn100">
      </form>
    </div>
  </div>

  <div class="col l4 s12">
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>