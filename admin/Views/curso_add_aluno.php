<div class="container mt-3">
<h3><a class="btn btn-success" href="<?= BASE; ?>admin/cursos" role="button">
<i class="fa fa-arrow-left" aria-hidden="true"></i>
</a> 
Adicionar Aluno no Curso de <?php echo $curso['nome']; ?></h3> <hr>
<?php if (isset($_SESSION['alerta_add_aluno_curso']) && !empty($_SESSION['alerta_add_aluno_curso'])) {
  echo $_SESSION['alerta_add_aluno_curso'];
 unset($_SESSION['alerta_add_aluno_curso']);
 } ?>
 <?php if (isset($_SESSION['alerta_deletar_aluno_curso']) && !empty($_SESSION['alerta_deletar_aluno_curso'])) {
  echo $_SESSION['alerta_deletar_aluno_curso'];
 unset($_SESSION['alerta_deletar_aluno_curso']);
 } ?>
 <?php if(!empty($aluno)): ?>  
<form method="POST" class="form-row">
  <div class="form-group col-md-6 mr-3 mb-2">
  <label for="aluno" class="sr-only">Aluno</label>    
    <select class="form-control" name="id_aluno" id="id_aluno" required>
    <option value="0">Selecione</option>
			<?php foreach($listaAlunos as $aluno): ?> 
			<option value="<?php echo $aluno['id']; ?>"><?php echo $aluno['nome']; ?></option>
			<?php endforeach; ?>
		</select>
  </div>
  <input type="submit" class="btn btn-success mb-2" value="Adicionar Aluno" />
</form>  
<br />
<div class="row">
  <?php foreach($exibirAlunos as $ac): ?>   
  <div class="col-sm-3">
    <div class="card mb-3">
  <h5 class="card-header"><?php echo $ac["nome"]; ?>
     <a onclick="return confirmDelete()" 
     data-toggle="tooltip" title="Deletar <?php  echo $ac["nome"]; ?>" class="btn btn-danger btn-sm pull-right" 
     href="<?php echo BASE; ?>admin/cursos/deletar_aluno_curso/<?php echo $ac['id']; ?>" role="button">
     <i class="fa fa-trash" aria-hidden="true"></i></a> 
     <a data-toggle="tooltip" title="Editar <?php  echo $ac["nome"]; ?>" class="btn btn-info btn-sm pull-right mr-2" 
     href="prof-editar.php?id=<?php echo $ac["id"]; ?>" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
    </h5>
    
     <div class="card-body text-center">
     <div class="border mx-auto mb-3 p-2"><i class="fa fa-user fa-5x text-secondary" aria-hidden="true"></i></div>
     <div class="text-center mb-2"><?php echo $ac["email"]; ?></div>
    </div>
</div>
</div>
   <?php endforeach; ?>   
</div>
  <?php else: ?>
    <div class="alert alert-primary text-center" role="alert">
Nenhum aluno matriculado. <br />
<a href="<?= BASE; ?>admin/alunos">Clique aqui</a> para se matricular novos alunos
</div>
  <?php endif; ?>