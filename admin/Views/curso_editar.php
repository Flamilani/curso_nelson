<div class="container mt-3">
<h3><a class="btn btn-success" href="<?= BASE; ?>admin/cursos" role="button">
<i class="fa fa-arrow-left" aria-hidden="true"></i>
</a> 
Editar Curso <?php echo $curso['nome']; ?></h3> <hr>
 
<form method="POST" enctype="multipart/form-data">
	<div class="form-group">
    <label for="nome">Nome do Curso</label>
    <input type="text" class="form-control" name="nome" value="<?php echo $curso['nome']; ?>">
  </div>
	<div class="form-group">
    <label for="descricao">Descrição</label>
    <textarea name="descricao" class="form-control" rows="3"><?php echo $curso['descricao']; ?></textarea>
  </div>
  <div class="form-group">
<label for="aula">URL do Vídeo (YouTube)</label>
 <input type="text" class="form-control" name="url" value="<?php echo $curso['url']; ?>" />
    </div>
<div class="form-group">
<?php if(!empty($curso['url'])): ?> 
    <iframe class="embed-responsive-item mt-3" src="<?php echo $curso['url']; ?>" frameborder="0" allowfullscreen></iframe>
    <?php endif; ?>
    </div>
	<input class="btn btn-success" type="submit" value="Atualizar" />

</form>

</div>