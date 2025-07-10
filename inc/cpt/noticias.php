<?php
function cptui_register_my_cpts_noticia()
{
  $labels = [
    "name" => "Notícias",
    "singular_name" => "Notícia",
  ];
  $args = [
    "label" => "Notícias",
    "labels" => $labels,
    "public" => true,
    "has_archive" => false,
    "rewrite" => [
      'slug' => 'noticia/%noticia_id%',
      'with_front' => false
    ],
    "supports" => ["title", "editor", "thumbnail", "excerpt"],
    "show_in_rest" => true,
  ];
  register_post_type("noticia", $args);
}
add_action('init', 'cptui_register_my_cpts_noticia');
