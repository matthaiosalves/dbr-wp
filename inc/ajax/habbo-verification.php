<?php
// Ajax para verificar código
add_action('wp_ajax_verifica_habbo_missao', 'dbr_verifica_habbo_missao_ajax');
function dbr_verifica_habbo_missao_ajax()
{
  if (!is_user_logged_in()) {
    wp_send_json_error(['msg' => 'Você precisa estar logado para verificar.']);
  }

  $current_user = wp_get_current_user();
  $user_id = $current_user->ID;
  if (!session_id()) session_start();

  $verification_code = $_SESSION['dbr_habbo_verification_code'][$user_id] ?? '';
  if (!$verification_code) {
    wp_send_json_error(['msg' => 'Código de verificação não encontrado. Gere um novo código.']);
  }

  $display_name = $current_user->display_name;
  $api_url = 'https://www.habbo.com.br/api/public/users?name=' . urlencode($display_name);

  $response = wp_remote_get($api_url, ['timeout' => 8]);
  if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
    wp_send_json_error(['msg' => 'Erro ao consultar a API do Habbo.']);
  }

  $body = json_decode(wp_remote_retrieve_body($response), true);
  if (!$body || empty($body['motto'])) {
    wp_send_json_error(['msg' => 'Usuário não encontrado ou missão não disponível.']);
  }

  if (strpos($body['motto'], $verification_code) !== false) {
    update_user_meta($user_id, 'verificado_habbo', 1);
    wp_send_json_success(['msg' => 'Habbo verificado com sucesso!']);
  } else {
    update_user_meta($user_id, 'verificado_habbo', 0);
    wp_send_json_error(['msg' => 'Missão não contém o código. Copie e cole exatamente o código na sua missão do Habbo e clique novamente em confirmar.']);
  }
}

// Ajax para gerar novo código
add_action('wp_ajax_novo_codigo_habbo', function () {
  if (!is_user_logged_in()) {
    wp_send_json_error(['msg' => 'Faça login.']);
  }
  $user_id = get_current_user_id();
  if (!session_id()) session_start();

  // Bloqueio: só permite gerar novo código a cada 60s
  $last_gen = $_SESSION['dbr_habbo_verification_last_gen'][$user_id] ?? 0;
  if (time() - $last_gen < 60) {
    $resta = 60 - (time() - $last_gen);
    wp_send_json_error(['msg' => "Aguarde $resta segundos para gerar um novo código."]);
  }

  $code = 'DBR' . sprintf('%04d', rand(0, 9999));
  $_SESSION['dbr_habbo_verification_code'][$user_id] = $code;
  $_SESSION['dbr_habbo_verification_last_gen'][$user_id] = time();
  update_user_meta($user_id, 'verificado_habbo', 0); // volta para não verificado ao trocar
  wp_send_json_success(['code' => $code]);
});
