<?php
/*
Template Name: Painel
*/
get_header();


if (!is_user_logged_in() || !current_user_can('contributor')) {
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
      <h1>Painel da Equipe</h1>
      <div class="divider"></div>

      <div style="display:flex;align-items: center;">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/diario.png" alt="Banner dbr" width="125">
        <p>
          Estamos felizes em saber que você faz parte da equipe do DBR. É uma honra ver seu empenho para que o Diário continue sendo a maior e melhor fonte de notícias militares. Escolha abaixo o que veio fazer!
        </p>
      </div>

      <a href="<?php echo admin_url('post-new.php?post_type=noticia'); ?>"
        class="btn btn100 transparent"
        style="text-align:inherit;margin-bottom:5px;color:#000;">
        Central de criação de notícias
      </a>

      <?php if (current_user_can('administrator')): ?>
        <a href="<?php echo home_url('/painel/noticias'); ?>" class="btn btn100 transparent" style="text-align:inherit;margin-bottom:5px;color:#000;">
          Todas as notícias
        </a>
      <?php endif; ?>

      <?php if (current_user_can('contributor')): ?>
        <a href="<?php echo home_url('/painel/minhas'); ?>" class="btn btn100 transparent" style="text-align:inherit;margin-bottom:5px;color:#000;">Minhas notícias</a>
      <?php endif; ?>

      <!-- <a href="<?php echo home_url('/painel/adm'); ?>" class="btn btn100 transparent" style="text-align:inherit;margin-bottom:5px;color:#000;">Permissões - ADM</a> -->

      <!-- <a href="<?php echo home_url('/painel/paginas'); ?>" class="btn btn100 transparent" style="text-align:inherit;margin-bottom:5px;color:#000;">O DBR</a> -->

    </div>
  </div>

  <!-- SIDEBAR (coluna lateral) -->
  <div class="col l4 s12">
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>