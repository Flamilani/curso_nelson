<div class="container mt-3">
<h3><a class="btn btn-success" href="<?= BASE; ?>admin" role="button">
<i class="fa fa-arrow-left" aria-hidden="true"></i>
</a> Cursos</h3> <hr>

<!-- <button id="flip" class="btn btn-primary mb-3">Adicionar Curso</button>
<div id="panel">  
    <form method="POST">
    <div class="form-group">
            <label class="card-title">Título</label>
               <input type='text' name="titulo" id="titulo" class="form-control" />
        </div>
</div> -->

<table class="table table-striped bg-white">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Título</th>
      <th class="text-center" scope="col">Qtd. Aulas</th>
      <th class="text-center" scope="col">Qtd. Alunos</th>
      <th class="text-center" scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($cursos as $curso): ?>
    <tr>
      <th scope="row"><?php echo $curso['id']; ?></th>
      <td><?php echo $curso['nome']; ?></td>
      <td class="text-center"><a href="<?php echo BASE; ?>admin/cursos/aulas/<?php echo $curso['id']; ?>" class="btn btn-success">Aulas <!-- <span class="badge badge-light"><?php echo $curso['qtalunos']; ?></span> --></a></td>
      <td class="text-center"><a href="<?php echo BASE; ?>admin/cursos/alunos/<?php echo $curso['id']; ?>" class="btn btn-primary">Alunos <!-- <span class="badge badge-light"><?php echo $curso['qtalunos']; ?></span> --></a></td>
      <td class="text-center">
		<a class="btn btn-info" href="<?php echo BASE; ?>admin/cursos/editar/<?php echo $curso['id']; ?>">
		<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
	<!-- 	<a class="btn btn-danger" href="<?php echo BASE; ?>admin/cursos/deletar/<?php echo $curso['id']; ?>">
		<i class="fa fa-trash" aria-hidden="true"></i></a> -->
		</td>
    </tr>
	<?php endforeach; ?>
  </tbody>
</table>

</div>