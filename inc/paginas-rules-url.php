<?php
// Adiciona o prefixo '/diario/' para todas as páginas
function dbr_page_rewrite_rules($rules)
{
  $newRules = array();
  $pages = get_pages();
  foreach ($pages as $page) {
    $slug = $page->post_name;
    $newRules['diario/' . $slug . '/?$'] = 'index.php?pagename=' . $slug;
  }
  return $newRules + $rules;
}
add_filter('rewrite_rules_array', 'dbr_page_rewrite_rules');

// Ajusta os links gerados pelo WordPress para as páginas
function dbr_page_link($link, $post)
{
  if ($post->post_type == 'page') {
    $url = home_url(user_trailingslashit('diario/' . $post->post_name));
    return $url;
  }
  return $link;
}
add_filter('page_link', 'dbr_page_link', 10, 2);

// Força o WP a atualizar as regras ao ativar o tema/plugin
function dbr_flush_rewrite_rules()
{
  flush_rewrite_rules();
}
add_action('after_switch_theme', 'dbr_flush_rewrite_rules');
