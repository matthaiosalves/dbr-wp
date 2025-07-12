<?php
/*
Template Name: Equipe
*/

get_header();

// Defina a ordem dos cargos/roles que quer exibir (exceto 'subscriber')
$roles_order = [
  'administrator'        => 'Administradores',
  'editor'               => 'Editores',
  'author'               => 'Autores',
  'contributor'          => 'Colaboradores',
  'developer'            => 'Desenvolvedores', // caso exista
  'diretor'              => 'Diretores',       // cargos personalizados
  'jornalista'           => 'Jornalistas',
  'colunista'            => 'Colunistas',
  'redator'              => 'Redatores',
  // Adicione outros conforme sua necessidade!
];

// Monta um array: role => [users]
$users_by_role = [];
foreach ($roles_order as $role => $label) {
  $users = get_users(['role' => $role]);
  if (!empty($users)) {
    $users_by_role[$role] = [
      'label' => $label,
      'users' => $users,
    ];
  }
}
?>

<div class="row" style="margin-top:90px;">
  <!-- Coluna principal -->
  <div class="col l8 s12" style="padding:0;">
    <div class="sobre">
      <h1>EQUIPE</h1>
      <div class="divider"></div>

      <p>
        <img style="margin: 0 auto; display: block; margin-top: 20px; max-width: 100%;" class="responsive-img" src="https://diario.exbrhb.net/assets/images/diario.png" alt="Banner DBR">
      </p>
      <p style="text-align:center;">
        O Diário Brasileiro possui uma equipe que tem como princípios a dedicação e principalmente o amor ao trabalho feito. Fazemos todo o possível para que as informações cheguem com rapidez e eficiência a você. Confira abaixo nosso quadro da equipe!
      </p>

      <?php foreach ($users_by_role as $role => $role_data): ?>
        <h5 style="margin-bottom:-25px;"><?php echo esc_html($role_data['label']); ?></h5>
        <div style="display:flex;flex-wrap:wrap;">
          <?php foreach ($role_data['users'] as $user): ?>
            <?php
            $nickname = $user->display_name; // agora usa display_name!
            ?>
            <div style="width: 160px;height: 160px;position:relative;border: 15px solid #ed1c24;border-radius:100px;margin: 30px 25px 0px 0px;">
              <div style="width:170px;height:140px;overflow:hidden;" class="avatar">
                <div class="material-placeholder">
                  <img class="materialboxed"
                    src="https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?php echo urlencode($nickname); ?>&action=std&direction=3&head_direction=3&gesture=sml&size=l"
                    alt="Avatar no habbo" style="margin-top:-30px;">
                </div>
              </div>
              <div style="background:#ffa800;color:#fff;width:170px;height:40px;position:absolute;right: -18px;bottom:-35px;font-weight:bold;text-align:center;line-height:40px;-webkit-box-shadow: 6px 6px 2px -2px rgba(0,0,0,0.5);-moz-box-shadow: 6px 6px 2px -2px rgba(0,0,0,0.5);box-shadow: 5px 5px 2px -2px rgba(0,0,0,0.5);">
                <?php echo esc_html($nickname); ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <br><br>
      <?php endforeach; ?>

      <div style="clear: both"></div>
    </div>
  </div>
  <!-- SIDEBAR (coluna lateral) -->
  <div class="col l4 s12">
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>