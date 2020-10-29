<nav class="navbar navbar-expand-lg bg-green">
<div class="container-fluid">
  <a class="navbar-brand text-white" href="<?= BASE; ?>home">Painel do Aluno</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <h3 class="collapse navbar-collapse d-flex justify-content-center" id="navbarText">
   Curso - Nelson Pimenta   
  </h3>
  <span class="navbar-text">  
        <div class="dropdown text-light">
  <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <?php echo $_SESSION['email']; ?> 
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="btn btn-danger btn-block" href="<?php echo BASE; ?>login/logout">Sair</a>
  </div>
</div>
    </span>
  </div>
</nav>