<div class="container mt-3">
<h3>Dashboard</h3> <hr>

  <div class="row">

    <div class="col-sm-4">
    <div class="card mb-3">
  <img class="card-img-top icone" src="<?= BASE; ?>assets/icons/teacher.png" alt="Meus Cursos">
  <div class="card-body">
    <a href="<?= BASE; ?>admin/cursos" class="btn btn-primary btn-block">Cursos <!-- <span class="badge badge-light"><?php echo $curso['qtcursos']; ?></span> --></a>
  </div>
</div>
    </div>

<div class="col-sm-4">    
  <div class="card mb-3">  
  <i class="fa fa-users text-success fa-icon text-center" aria-hidden="true"></i>
      <div class="card-body">
         <a href="<?= BASE; ?>admin/alunos" class="btn btn-success btn-block">Alunos <!-- <span class="badge badge-light">4</span> --></a>
      </div>
  </div>
</div>

<div class="col-sm-4">    
  <div class="card mb-3">  
  <i class="fa fa-calendar-check-o text-danger fa-icon text-center" aria-hidden="true"></i>
      <div class="card-body">
         <a href="<?= BASE; ?>admin/faltas" class="btn btn-danger btn-block">Controle de Frequências</a>
      </div>
  </div>
</div>

    </div>
  </div>
</div>

