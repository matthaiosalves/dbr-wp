<?php
add_action('wp_ajax_dbr_ajax_search', 'dbr_ajax_search');
add_action('wp_ajax_nopriv_dbr_ajax_search', 'dbr_ajax_search');
function dbr_ajax_search()
{
  $keyword = sanitize_text_field($_GET['keyword'] ?? '');
  $query = new WP_Query([
    'post_type' => 'noticia',
    'posts_per_page' => 20,
    's' => $keyword,
    'post_status' => 'publish',
  ]);
  $results = [];
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $img = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
      if (!$img) $img = 'https://i.imgur.com/EmBfP1e.png';
      $results[] = [
        'title' => get_the_title(),
        'link' => get_permalink(),
        'img' => $img,
        'author' => get_the_author(),
        'date' => get_the_date('d \d\e F \d\e Y'),
        'excerpt' => get_the_excerpt(),
      ];
    }
    wp_reset_postdata();
  }
  wp_send_json($results);
}
