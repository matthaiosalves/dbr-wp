<?php get_header(); ?>

<div class="row" style="margin-top:90px;">
  <!-- Coluna principal -->
  <div class="col l8 s12" style="padding:0;">
    <?php
    $cat = get_queried_object();
    $category_slug = $cat->slug ?? '';
    $category_name = single_cat_title('', false);
    ?>
    <form action="<?php echo esc_url(get_category_link($cat->term_id)); ?>" method="GET">
      <div class="search-bar">
        <input class="search-input browser-default" type="text" id="keyword" name="keyword" placeholder="Pesquisar notícia em <?php echo esc_attr($category_name); ?>...">
        <button class="search-button browser-default" type="submit">
          <svg class="svg-inline--fa fa-search fa-w-16" style="font-size: 18px;" aria-hidden="true" data-prefix="fa" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
          </svg>
        </button>
      </div>
    </form>

    <div class="leia_mais">
      <h1 data-categoria="<?php echo esc_attr($category_slug); ?>">
        Leia mais de <?php echo esc_html($category_name); ?>
      </h1>

      <?php if (have_posts()) : while (have_posts()) : the_post();
          $img = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
          if (!$img) $img = 'https://i.imgur.com/EmBfP1e.png';
          $author = get_the_author();
          $date = get_the_date('d \d\e F');
      ?>
          <a href="<?php the_permalink(); ?>">
            <div class="noticia">
              <div class="imagem" style="background-image:url('<?php echo esc_url($img); ?>');"></div>
              <div class="conteudo">
                <p><?php the_title(); ?></p>
                <p>
                  <?php echo $date; ?> - <?php echo esc_html($author); ?>
                </p>
                <p><?php echo esc_html(get_the_excerpt()); ?></p>
              </div>
            </div>
          </a>
        <?php endwhile;
      else: ?>
        <p>Nenhuma notícia encontrada nesta categoria.</p>
      <?php endif; ?>
    </div>
  </div>

  <div class="col l4 s12">
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>