<div class="container mt-3">
<h3><a class="btn btn-success" href="<?= BASE; ?>admin/alunos" role="button">
<i class="fa fa-arrow-left" aria-hidden="true"></i>
</a> Alunos</h3> <hr>

<?php if (isset($_SESSION['alerta_editar_aluno']) && !empty($_SESSION['alerta_editar_aluno'])) {
  echo $_SESSION['alerta_editar_aluno'];
 unset($_SESSION['alerta_editar_aluno']);
 } ?>

<form method="POST">
<div class="form-row">
    <div class="form-group col-md-6">
    <label for="nome">Nome Completo</label>
    <input type="text" class="form-control" name="nome" value="<?php echo $aluno['nome']; ?>">
    </div>
    <div class="form-group col-md-4">
    <label for="email">E-mail</label>
    <input type="email" class="form-control" name="email" value="<?php echo $aluno['email']; ?>">
    </div>
    <div class="form-group col-md-2">
        <input type="submit" class="btn btn-success margin-btn" value="Atualizar Aluno" />
    </div>
  </div>
  </form>  
  </div>