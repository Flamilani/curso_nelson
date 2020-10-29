<div class="container mt-3">
<?php require 'inc/aside.php'; ?>  
  <div class="col-sm-8">
  <h3><?php echo $aula_info['titulo']; ?></h3>
  <?php if(!empty($aula_info['url'])): ?> 
  <div class="embed-responsive embed-responsive-16by9">
   <iframe class="embed-responsive-item" src="<?php echo $aula_info['url']; ?>" frameborder="0" allowfullscreen></iframe>
   </div>
   <?php endif; ?>
	<?php echo $aula_info['descricao']; ?><br />
	<?php if (isset($_SESSION['alerta_atividade_salva']) && !empty($_SESSION['alerta_atividade_salva'])) {
  echo $_SESSION['alerta_atividade_salva'];
 unset($_SESSION['alerta_atividade_salva']);
 } ?>
 <?php if(empty($atividade['url_video_aluno'])): ?> 
<form method="POST" autocomplete="off">
<div class="form-group mt-3">
<label for="aula">Envie sua atividade em Vídeo (YouTube)</label>
 <input type="text" class="form-control" name="url_video_aluno" placeholder="https://youtu.be/codigo" />
    </div>
	<input class="btn btn-success" type="submit" value="Salvar vídeo" />
</form>
<?php endif; ?>
<?php if(!empty($atividade['url_video_aluno'])): ?> 
	<div class="card mt-3">
  <h5 class="card-header text-white bg-info">Sua atividade foi enviada para ser avaliada</h5>
  <div class="card-body">
  <div class="embed-responsive embed-responsive-16by9 mt-3">
   <iframe class="embed-responsive-item" src="<?php echo $atividade['url_video_aluno']; ?>" frameborder="0" allowfullscreen></iframe>
   </div>
  </div>
</div>
   <?php endif; ?>
   <?php if(!empty($atividade['avaliacao'])): ?> 
	<div class="card mt-3">
  <h5 class="card-header text-white bg-success">Sua avaliação: <?php echo $atividade['avaliacao']; ?></h5>
  <div class="card-body">
  <?php if(!empty($atividade['url_video_observacao'])): ?> 
  <div class="embed-responsive embed-responsive-16by9 mt-3">
   <iframe class="embed-responsive-item" src="<?php echo $atividade['url_video_observacao']; ?>" frameborder="0" allowfullscreen></iframe>
   </div>
   <?php endif; ?>
   <p class="mt-3">
   <?php echo $atividade['observacao']; ?>
   </p>
  </div>
</div>
   <?php endif; ?>
  </div>
</div>
</div>
