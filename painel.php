<?php
/*
Template Name: Painel
*/
get_header();


if (!is_user_logged_in()) {
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


      <a href="<?php echo home_url('/painel/minhas'); ?>" class="btn btn100 transparent" style="text-align:inherit;margin-bottom:5px;color:#000;">Minhas notícias</a>

      <a href="<?php echo home_url('/painel/adm'); ?>" class="btn btn100 transparent" style="text-align:inherit;margin-bottom:5px;color:#000;">Permissões - ADM</a>
      <h6 style="margin-top:50px;font-size: 20px;font-weight:bold;text-transform:uppercase;color:#f94623;">Textos do site</h6>

      <a href="<?php echo home_url('/painel/paginas'); ?>" class="btn btn100 transparent" style="text-align:inherit;margin-bottom:5px;color:#000;">O DBR</a>

      <ul class="collapsible">
        <li class="">
          <div class="collapsible-header" tabindex="0"><i class="material-icons">filter_drama</i>Inscrições</div>
          <div class="collapsible-body" style="">
            <div style="padding:10px;background:#ffa800;">
              Nickname: Tom-BTM<br>
              Por que devemos te contratar? R: Sou dedicado, e esforçado, gosto de aprender e ajudar<br>
              Horários para ajudar o DBR: 18:00 ás 00:00 <a href="https://diario.forcasarmadasbrhb.net/painel/dInscricao/338" class="right black-text tooltipped" data-position="left" data-tooltip="Arquivar inscrição">
                <svg class="svg-inline--fa fa-trash fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="trash" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                  <path fill="currentColor" d="M0 84V56c0-13.3 10.7-24 24-24h112l9.4-18.7c4-8.2 12.3-13.3 21.4-13.3h114.3c9.1 0 17.4 5.1 21.5 13.3L312 32h112c13.3 0 24 10.7 24 24v28c0 6.6-5.4 12-12 12H12C5.4 96 0 90.6 0 84zm415.2 56.7L394.8 467c-1.6 25.3-22.6 45-47.9 45H101.1c-25.3 0-46.3-19.7-47.9-45L32.8 140.7c-.4-6.9 5.1-12.7 12-12.7h358.5c6.8 0 12.3 5.8 11.9 12.7z"></path>
                </svg><!-- <i class="fas fa-trash"></i> -->
              </a>
            </div>
            <div style="padding:10px;background:#ffa800;">
              Nickname: Cr.Edu16<br>
              Por que devemos te contratar? R: Pois gostaria de fazer parte da equipe do DBR e contribuir com o s meus conhecimentos para realizar as notícias.<br>
              Horários para ajudar o DBR: Das 15hrs até as 18hrs <a href="https://diario.forcasarmadasbrhb.net/painel/dInscricao/337" class="right black-text tooltipped" data-position="left" data-tooltip="Arquivar inscrição">
                <svg class="svg-inline--fa fa-trash fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="trash" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                  <path fill="currentColor" d="M0 84V56c0-13.3 10.7-24 24-24h112l9.4-18.7c4-8.2 12.3-13.3 21.4-13.3h114.3c9.1 0 17.4 5.1 21.5 13.3L312 32h112c13.3 0 24 10.7 24 24v28c0 6.6-5.4 12-12 12H12C5.4 96 0 90.6 0 84zm415.2 56.7L394.8 467c-1.6 25.3-22.6 45-47.9 45H101.1c-25.3 0-46.3-19.7-47.9-45L32.8 140.7c-.4-6.9 5.1-12.7 12-12.7h358.5c6.8 0 12.3 5.8 11.9 12.7z"></path>
                </svg><!-- <i class="fas fa-trash"></i> -->
              </a>
            </div>
            <div style="padding:10px;background:#ffa800;">
              Nickname: Dayane...Minie<br>
              Por que devemos te contratar? R: Pois serei um membro dedicad<br>
              Horários para ajudar o DBR: Das 16:30 ás 21:45 <a href="https://diario.forcasarmadasbrhb.net/painel/dInscricao/336" class="right black-text tooltipped" data-position="left" data-tooltip="Arquivar inscrição">
                <svg class="svg-inline--fa fa-trash fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="trash" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                  <path fill="currentColor" d="M0 84V56c0-13.3 10.7-24 24-24h112l9.4-18.7c4-8.2 12.3-13.3 21.4-13.3h114.3c9.1 0 17.4 5.1 21.5 13.3L312 32h112c13.3 0 24 10.7 24 24v28c0 6.6-5.4 12-12 12H12C5.4 96 0 90.6 0 84zm415.2 56.7L394.8 467c-1.6 25.3-22.6 45-47.9 45H101.1c-25.3 0-46.3-19.7-47.9-45L32.8 140.7c-.4-6.9 5.1-12.7 12-12.7h358.5c6.8 0 12.3 5.8 11.9 12.7z"></path>
                </svg><!-- <i class="fas fa-trash"></i> -->
              </a>
            </div>
            <div style="padding:10px;background:#ffa800;">
              Nickname: gedeoni<br>
              Por que devemos te contratar? R: Sou uma pessoa dedicada, já fiz parte de um Jornal em outra Instituição, gosto de criar notícias e colunas.<br>
              Horários para ajudar o DBR: 17h às 23h <a href="https://diario.forcasarmadasbrhb.net/painel/dInscricao/335" class="right black-text tooltipped" data-position="left" data-tooltip="Arquivar inscrição">
                <svg class="svg-inline--fa fa-trash fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="trash" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                  <path fill="currentColor" d="M0 84V56c0-13.3 10.7-24 24-24h112l9.4-18.7c4-8.2 12.3-13.3 21.4-13.3h114.3c9.1 0 17.4 5.1 21.5 13.3L312 32h112c13.3 0 24 10.7 24 24v28c0 6.6-5.4 12-12 12H12C5.4 96 0 90.6 0 84zm415.2 56.7L394.8 467c-1.6 25.3-22.6 45-47.9 45H101.1c-25.3 0-46.3-19.7-47.9-45L32.8 140.7c-.4-6.9 5.1-12.7 12-12.7h358.5c6.8 0 12.3 5.8 11.9 12.7z"></path>
                </svg><!-- <i class="fas fa-trash"></i> -->
              </a>
            </div>
            <div style="padding:10px;background:#ffa800;">
              Nickname: WkYxnTGh<br>
              Por que devemos te contratar? R: 1<br>
              Horários para ajudar o DBR: 1 <a href="https://diario.forcasarmadasbrhb.net/painel/dInscricao/334" class="right black-text tooltipped" data-position="left" data-tooltip="Arquivar inscrição">
                <svg class="svg-inline--fa fa-trash fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="trash" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                  <path fill="currentColor" d="M0 84V56c0-13.3 10.7-24 24-24h112l9.4-18.7c4-8.2 12.3-13.3 21.4-13.3h114.3c9.1 0 17.4 5.1 21.5 13.3L312 32h112c13.3 0 24 10.7 24 24v28c0 6.6-5.4 12-12 12H12C5.4 96 0 90.6 0 84zm415.2 56.7L394.8 467c-1.6 25.3-22.6 45-47.9 45H101.1c-25.3 0-46.3-19.7-47.9-45L32.8 140.7c-.4-6.9 5.1-12.7 12-12.7h358.5c6.8 0 12.3 5.8 11.9 12.7z"></path>
                </svg><!-- <i class="fas fa-trash"></i> -->
              </a>
            </div>
            <div style="padding:10px;background:#ffa800;">
              Nickname: Altz<br>
              Por que devemos te contratar? R: Teste<br>
              Horários para ajudar o DBR: Teste <a href="https://diario.forcasarmadasbrhb.net/painel/dInscricao/43" class="right black-text tooltipped" data-position="left" data-tooltip="Arquivar inscrição">
                <svg class="svg-inline--fa fa-trash fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="trash" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                  <path fill="currentColor" d="M0 84V56c0-13.3 10.7-24 24-24h112l9.4-18.7c4-8.2 12.3-13.3 21.4-13.3h114.3c9.1 0 17.4 5.1 21.5 13.3L312 32h112c13.3 0 24 10.7 24 24v28c0 6.6-5.4 12-12 12H12C5.4 96 0 90.6 0 84zm415.2 56.7L394.8 467c-1.6 25.3-22.6 45-47.9 45H101.1c-25.3 0-46.3-19.7-47.9-45L32.8 140.7c-.4-6.9 5.1-12.7 12-12.7h358.5c6.8 0 12.3 5.8 11.9 12.7z"></path>
                </svg><!-- <i class="fas fa-trash"></i> -->
              </a>
            </div>
          </div>
        </li>
        <li class="">
          <div class="collapsible-header" tabindex="0"><i class="material-icons">place</i>Mensagens</div>
          <div class="collapsible-body" style="">

          </div>
        </li>
      </ul>

      <h6 style="margin-top:30px;font-size: 20px;font-weight:bold;text-transform:uppercase;color:#f94623;">Guias</h6>

      <!-- Listas os posts de guia que devo cria ainda -->

    </div>
  </div>

  <!-- SIDEBAR (coluna lateral) -->
  <div class="col l4 s12">
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>