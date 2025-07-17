<?php get_header(); ?>

<div style="text-align:center;">
  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner_dbr.png" alt="Banner DBR" style="max-width:100%;">
</div>

<div class="row" style="margin-top:10px;">
  <!-- Coluna principal -->
  <div class="col l8 s12" style="padding:0;">
    <div class="sobre">
      <!-- Breadcrumb -->
      <a href="<?php echo home_url(); ?>" class="breadcrumb">Página inicial</a>
      <?php
      $category = get_the_category();
      if (! empty($category)) {
        $cat_link = get_category_link($category[0]->term_id);
        echo '<a href="' . esc_url($cat_link) . '" class="breadcrumb">' . esc_html($category[0]->name) . '</a>';
      }
      ?>

      <p class="titulo"><?php the_title(); ?></p>
      <?php
      $author_id = get_post_field('post_author', get_the_ID());
      $author_display_name = get_the_author_meta('display_name', $author_id);
      ?>
      <p class="por">
        <?php echo esc_html($author_display_name); ?> -
        <?php echo get_the_date('d \d\e F \d\e Y \à\s H:i'); ?>
      </p>

      <div style="display:flex;align-items: center;">

        <div id="share">
          <svg class="svg-inline--fa fa-share-alt fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="share-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
            <path fill="currentColor" d="M352 320c-22.608 0-43.387 7.819-59.79 20.895l-102.486-64.054a96.551 96.551 0 0 0 0-41.683l102.486-64.054C308.613 184.181 329.392 192 352 192c53.019 0 96-42.981 96-96S405.019 0 352 0s-96 42.981-96 96c0 7.158.79 14.13 2.276 20.841L155.79 180.895C139.387 167.819 118.608 160 96 160c-53.019 0-96 42.981-96 96s42.981 96 96 96c22.608 0 43.387-7.819 59.79-20.895l102.486 64.054A96.301 96.301 0 0 0 256 416c0 53.019 42.981 96 96 96s96-42.981 96-96-42.981-96-96-96z"></path>
          </svg>
        </div>

        <?php
        // Pegue os dados dinâmicos do post atual:
        $url     = urlencode(get_permalink());
        $title   = urlencode(get_the_title());
        $site    = '@exbr_hb'; // Seu @ do Twitter (ou deixe vazio)
        $hashtag = 'DBR'; // Hashtag, se quiser

        // Para Twitter/X:
        $twitter_text = urlencode("Recomendo: " . get_the_title() . " " . get_permalink() . " $site #$hashtag");
        ?>

        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>"
          id="facebook-share-btt"
          rel="nofollow"
          target="_blank"
          class="facebook-share-button">
          <div style="width:30px;height:30px;line-height:30px;background:#45619e;font-size:13px;">
            <svg class="svg-inline--fa fa-facebook-f fa-w-9" aria-hidden="true" data-prefix="fab" data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 264 512" data-fa-i2svg="">
              <path fill="currentColor" d="M76.7 512V283H0v-91h76.7v-71.7C76.7 42.4 124.3 0 193.8 0c33.3 0 61.9 2.5 70.2 3.6V85h-48.2c-37.8 0-45.1 18-45.1 44.3V192H256l-11.7 91h-73.6v229"></path>
            </svg>
          </div>
          <p style="width:80px;display:flex;align-items:center;justify-content:center;">Facebook</p>
        </a>

        <a href="https://twitter.com/intent/tweet?text=<?php echo $twitter_text; ?>"
          id="twitterr-share-btt"
          rel="nofollow"
          target="_blank"
          class="twitterr-share-button">
          <div style="width:30px;height:30px;line-height:30px;background:#0db1f0;font-size:13px;">
            <svg class="svg-inline--fa fa-twitter fa-w-16" aria-hidden="true" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
            </svg>
          </div>
          <p style="width:80px;display:flex;align-items:center;justify-content:center;">Twitter</p>
        </a>

      </div>

      <div class="noticia">
        <?php
        $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($thumb_url) :
        ?>
          <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>" style="max-width:100%;width:100%;">
        <?php endif; ?>
        <?php the_content(); ?>
      </div>

    </div>


    <?php
    if (comments_open() || get_comments_number()) {
      comments_template();
    }
    ?>
  </div>

  <!-- SIDEBAR (coluna lateral) -->
  <div class="col l4 s12">
    <?php get_sidebar(); ?>
  </div>
</div>

<script>
  // Corrige o botão de compartilhamento Facebook
  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("facebook-share-btt").href = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href);
  }, false);
</script>

<?php get_footer(); ?>