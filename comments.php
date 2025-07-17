<?php if (post_password_required()) return; ?>

<?php if (!is_user_logged_in()) : ?>
	<h5 style="font-weight:bold;font-size:20px;">
		Efetue o
		<a href="<?php echo home_url('/login'); ?>" style="color:#ffa800;">login</a>
		ou
		<a href="<?php echo home_url('/cadastrar-se'); ?>" style="color:#ffa800;">cadastre-se</a>
		para poder comentar.
	</h5>
<?php else: ?>
	<?php
	$user_id = get_current_user_id();
	$verificado = intval(get_field('verificado_habbo', 'user_' . $user_id));
	?>
	<?php if (!$verificado): ?>
		<div class="card-panel yellow lighten-3 black-text" style="margin:15px 0; font-weight:bold;">
			Para comentar, é necessário <span style="color:#ffa800;">verificar sua identidade Habbo</span> no perfil.
			<br>
			<a href="<?php echo home_url('/perfil'); ?>" style="color:#ffa800; text-decoration:underline;">Clique aqui para verificar</a>
		</div>
	<?php elseif (comments_open()) : ?>
		<form action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post" style="margin-bottom:10px;">
			<?php comment_id_fields(get_the_ID()); ?>
			<label for="comment" style="color:#000;font-weight:bold;font-size:15px;">Comente</label><br>
			<div style="display:flex;align-items:center;">
				<textarea name="comment" id="comment" style="max-width:559px;resize:none;padding-left:4px;overflow: hidden;" placeholder="Envie um comentário" required></textarea>
				<button class="waves-effect btn"><i class="material-icons">send</i></button>
			</div>
		</form>
	<?php else: ?>
		<p style="padding:20px;text-align:center;">Os comentários estão fechados para este item.</p>
	<?php endif; ?>
<?php endif; ?>

<?php
if (have_comments()):
?>
	<div class="comentarios">
		<?php foreach ($comments as $comment):
			$habbo_nick = get_comment_author($comment->comment_ID);
			$habbo_nick_url = urlencode(str_replace(' ', '', $habbo_nick));
			$comment_id = $comment->comment_ID;
			$date_str = get_comment_date('d \d\e F \d\e Y \à\s H:i', $comment_id);
			if (current_user_can('administrator')) {
				$delete_link = admin_url('comment.php?action=deletecomment&c=' . $comment_id . '&_wpnonce=' . wp_create_nonce('delete-comment_' . $comment_id));
			} else {
				$delete_link = false;
			}
		?>
			<div class="comentario">
				<div class="avatar">
					<img src="https://diario.forcasarmadasbrhb.net/throne.php?habbo=<?php echo esc_attr($habbo_nick_url); ?>" alt="Avatar no habbo">
				</div>
				<div class="info">
					<p class="texto z-depth-2">
						<?php echo esc_html(get_comment_text($comment_id)); ?>
						<?php if ($delete_link): ?>
							<a href="<?php echo esc_url($delete_link); ?>" class="right black-text tooltipped" data-position="left" data-tooltip="Deletar mensagem" onclick="return confirm('Tem certeza que deseja apagar este comentário?');">
								<svg class="svg-inline--fa fa-trash fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="trash" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
									<path fill="currentColor" d="M0 84V56c0-13.3 10.7-24 24-24h112l9.4-18.7c4-8.2 12.3-13.3 21.4-13.3h114.3c9.1 0 17.4 5.1 21.5 13.3L312 32h112c13.3 0 24 10.7 24 24v28c0 6.6-5.4 12-12 12H12C5.4 96 0 90.6 0 84zm415.2 56.7L394.8 467c-1.6 25.3-22.6 45-47.9 45H101.1c-25.3 0-46.3-19.7-47.9-45L32.8 140.7c-.4-6.9 5.1-12.7 12-12.7h358.5c6.8 0 12.3 5.8 11.9 12.7z"></path>
								</svg>
							</a>
						<?php endif; ?>
					</p>
					<p class="autor">
						<a href="https://exbrhb.net/perfil/<?php echo esc_attr($habbo_nick_url); ?>">
							<?php echo esc_html($habbo_nick); ?>
						</a>
						-
						<span style="font-weight:normal;"><?php echo $date_str; ?></span>
					</p>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
<?php else: ?>
	<p>Nenhum comentário ainda.</p>
<?php endif; ?>