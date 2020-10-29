<div class="container mt-3">
<h3><a class="btn btn-success" href="<?= BASE; ?>admin" role="button">
<i class="fa fa-arrow-left" aria-hidden="true"></i>
</a> Alunos</h3> <hr>

<?php if (isset($_SESSION['alerta_add_aluno']) && !empty($_SESSION['alerta_add_aluno'])) {
  echo $_SESSION['alerta_add_aluno'];
 unset($_SESSION['alerta_add_aluno']);
 } ?>

<?php if (isset($_SESSION['alerta_deletar_aluno']) && !empty($_SESSION['alerta_deletar_aluno'])) {
  echo $_SESSION['alerta_deletar_aluno'];
 unset($_SESSION['alerta_deletar_aluno']);
 } ?>

<?php if (isset($_SESSION['alerta_editar_aluno']) && !empty($_SESSION['alerta_editar_aluno'])) {
  echo $_SESSION['alerta_editar_aluno'];
 unset($_SESSION['alerta_editar_aluno']);
 } ?>

<form method="POST">
<div class="form-row">
    <div class="form-group col-md-6">
    <label for="nome">Nome Completo</label>
    <input type="text" class="form-control" name="nome" placeholder="Nome Completo">
    </div>
    <div class="form-group col-md-4">
    <label for="email">E-mail</label>
    <input type="email" class="form-control" name="email" placeholder="E-mail">
    </div>
    <div class="form-group col-md-2">
        <input type="submit" class="btn btn-success margin-btn" value="Adicionar Aluno" />
    </div>
  </div>
  </form>  
  <?php if(!empty($alunos)): ?>  
<table class="table table-striped text-center bg-white">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th class="text-left" scope="col">Nome</th>
      <th class="text-left" scope="col">E-mail</th>
      <th class="text-center" scope="col">Senha</th>
<!--       <th class="text-center" scope="col">Envio</th> -->
      <th class="text-center" scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($alunos as $aluno): ?>
    <tr>
      <th scope="row"><?php echo $this->zeroPad($aluno['id']); ?></th>
      <td class="text-left"><?php echo $aluno['nome']; ?></td>
      <td class="text-left"><?php echo $aluno['email']; ?></td>
     <td>
     <?php echo $aluno['senha']; ?>
  <!--    <a class="btn btn-info" href="<?php echo BASE; ?>admin/alunos/editar_senha/<?php echo $aluno['id']; ?>">Alterar Senha</a> -->
     </td> 
   <!--   <td>
     <a class="btn btn-info" href="<?php echo BASE; ?>admin/alunos/enviar/<?php echo $aluno['id']; ?>">Enviar </a>
     </td>  -->
     <td>	<a class="btn btn-info" href="<?php echo BASE; ?>admin/alunos/editar/<?php echo $aluno['id']; ?>">
		<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
		<a onclick="return confirmDelete()" class="btn btn-danger" href="<?php echo BASE; ?>admin/alunos/deletar/<?php echo $aluno['id']; ?>">
		<i class="fa fa-trash" aria-hidden="true"></i></a>
    </td>
    </tr>
	<?php endforeach; ?>
  </tbody>
</table>
<?php else: ?>
    <div class="alert alert-primary text-center" role="alert">
    Nenhum aluno matriculado no momento.
</div>
  <?php endif; ?>
</div>