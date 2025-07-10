<?php
function noticia_custom_rewrite($post_link, $post)
{
  if ($post->post_type == 'noticia') {
    return home_url('noticia/' . $post->ID . '/' . $post->post_name);
  }
  return $post_link;
}
add_filter('post_type_link', 'noticia_custom_rewrite', 10, 2);

// Adicionar a regra de rewrite
function noticia_rewrite_rules()
{
  add_rewrite_rule(
    '^noticia/([0-9]+)/([^/]+)/?$',
    'index.php?post_type=noticia&p=$matches[1]',
    'top'
  );
}
add_action('init', 'noticia_rewrite_rules');
