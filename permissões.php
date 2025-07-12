<?php
/*
Template Name: Permissões
*/
get_header();

if (!is_user_logged_in() || !current_user_can('administrator')) {
  global $wp_query;
  $wp_query->set_404();
  status_header(404);
  nocache_headers();
  include(get_query_template('404'));
  exit;
}
?>

<div class="row" style="margin-top:90px;">
  <!-- Coluna principal -->
  <div class="col l8 s12" style="padding:0;">
    <div class="sobre">
      <h1><?php the_title(); ?></h1>
      <div class="divider"></div>
      <?php the_content(); ?>
    </div>
  </div>

  <!-- SIDEBAR (coluna lateral) -->
  <div class="col l4 s12">
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>