<aside>
  <?php
  // Calcula o início e fim da semana atual (segunda 00h a domingo 23:59)
  $today = current_time('timestamp');
  $week_day = date('N', $today); // 1 (segunda) - 7 (domingo)
  $start_of_week = strtotime('last monday', $today);
  if ($week_day == 1) {
    // Hoje já é segunda, pega o começo de hoje
    $start_of_week = strtotime('today', $today);
  }
  $end_of_week = strtotime('next sunday 23:59:59', $start_of_week);

  // Busca posts do tipo 'noticia' publicados nesta semana
  $args = [
    'post_type' => 'noticia',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'date_query' => [
      [
        'after' => date('Y-m-d H:i:s', $start_of_week),
        'before' => date('Y-m-d H:i:s', $end_of_week),
        'inclusive' => true,
      ],
    ],
    'fields' => 'ids'
  ];

  $query = new WP_Query($args);

  $author_count = [];

  if ($query->have_posts()) {
    foreach ($query->posts as $post_id) {
      $author_id = get_post_field('post_author', $post_id);
      if (!isset($author_count[$author_id])) {
        $author_count[$author_id] = 0;
      }
      $author_count[$author_id]++;
    }
  }

  wp_reset_postdata();

  if (!empty($author_count)) {
    arsort($author_count); // Ordena decrescente
    $max_posts = reset($author_count);
    $top_authors = array_keys($author_count, $max_posts);

    foreach ($top_authors as $featured_author_id) {
      $user_info = get_userdata($featured_author_id);
      $display_name = $user_info ? $user_info->display_name : 'Desconhecido';
      $habbo_nick = $display_name; // Adapte aqui se quiser outro campo
  ?>
      <div class="destaque">
        <h1>Membro destaque</h1>
        <div class="membro_destaque">
          <div style="background-image:url('https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?php echo urlencode($habbo_nick); ?>&action=std&direction=3&head_direction=3&gesture=sml&size=l');"></div>
          <p><?php echo esc_html($display_name); ?></p>
        </div>
      </div>
    <?php
    }
  } else {
    // Ninguém postou na semana, mostra Rainer
    ?>
    <div class="destaque">
      <h1>Membro destaque</h1>
      <div class="membro_destaque">
        <div style="background-image:url('https://www.habbo.com.br/habbo-imaging/avatarimage?user=Rainer&action=std&direction=3&head_direction=3&gesture=sml&size=l');"></div>
        <p>Rainer</p>
      </div>
    </div>
  <?php
  }
  ?>

  <div class="categorias">
    <h1>Pode escolher!</h1>
    <div>
      <?php
      $categories = get_categories(array(
        'hide_empty' => false
      ));
      foreach ($categories as $category) {
        $cat_link = home_url('/categoria/' . $category->slug);
        echo '<a href="' . esc_url($cat_link) . '">' . esc_html($category->name) . '</a>';
      }
      ?>
    </div>
  </div>
  <div class="twitter">
    <h1>Exército Brasileiro no Twitter</h1>
    <a class="twitter-timeline" data-height="700" data-dnt="true" data-theme="light" href="https://twitter.com/exbrhabbo_?ref_src=twsrc%5Etfw"></a>
  </div>
</aside>