<?php
/*
Template Name: Login
*/
get_header(); ?>

<div class="row" style="margin-top:90px;">
  <!-- Coluna principal -->
  <div class="col l8 s12" style="padding:0;">
    <div class="sobre">
      <h1><?php the_title(); ?></h1>
      <div class="divider"></div>

      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/diario.png" class="responsive-img" alt="Banner dbr">
      <p>
        Preencha todos os dados para efetuar o login.
      </p>


      <form action="https://diario.forcasarmadasbrhb.net/login/logar" method="POST">
        <div class="form-group">
          <label for="nick" class="browser-default active" style="color:#000;font-weight:bold;font-size:20px;">
            Nickname
          </label>
          <input type="text" class="browser-default btn100" id="nick" name="nick" required="" style="height:40px;padding-left:5px;" placeholder="Exemplo: Altz">
        </div><br>

        <div class="form-group">
          <label for="senhaa" style="color:#000;font-weight:bold;font-size:20px;" class="active">
            Senha
          </label>
          <input type="password" class="browser-default btn100" id="senhaa" name="senhaa" required="" style="height:40px;padding-left:5px;" placeholder="Digite uma senha diferente da do seu habbo aqui">
        </div><br>

        <a href="https://diario.forcasarmadasbrhb.net/esqueci-minha-senha" style="line-height:0;margin-top: -10px;margin-bottom: 30px;text-align:end;color:red;display: block;font-weight: bold;">Esqueci minha senha</a>

        <div style="display: flex;justify-content: center;margin-bottom:10px;">
          <div id="captcha_element2"></div>
        </div>

        <input type="submit" value="É isso! Seja bem-vindo." class="btn red btn100" style="font-size:20px;font-weight:bold;">
      </form>
    </div>
  </div>

  <!-- SIDEBAR (coluna lateral) -->
  <div class="col l4 s12">
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>