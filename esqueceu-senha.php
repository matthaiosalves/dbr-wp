<?php
/*
Template Name: Esqueceu senha
*/
get_header(); ?>

<div class="row" style="margin-top:90px;">
  <!-- Coluna principal -->
  <div class="col l8 s12" style="padding:0;">
    <div class="sobre">
      <h1><?php the_title(); ?></h1>
      <div class="divider"></div>

      <p>
        Preencha o formulário caso você tenha esquecido a sua senha.
      </p>

      <form action="https://diario.forcasarmadasbrhb.net/form/esqueci" method="POST">
        <div class="form-group">
          <label for="email" class="browser-default active" style="color:#000;font-weight:bold;font-size:20px;">
            E-mail
          </label>
          <input type="email" class="browser-default btn100" id="email" name="email" required="" style="height:40px;padding-left:5px;" placeholder="Digite aqui o e-mail que você usou no cadastro">
        </div><br>

        <!-- <div style="display: flex;justify-content: center;margin-bottom:10px;">
                <div id="captcha_element2"></div>
            </div> -->

        <input type="submit" value="É isso!" class="btn red btn100" style="font-size:20px;font-weight:bold;">
      </form>
    </div>
  </div>

  <!-- SIDEBAR (coluna lateral) -->
  <div class="col l4 s12">
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>