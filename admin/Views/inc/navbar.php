<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?php echo BASE; ?>admin">Painel Administrativo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
      
      </li>     
    </ul>
    <span class="navbar-text">
        <?php echo $_SESSION['email']; ?>  
        <a class="btn btn-danger ml-3" href="<?php echo BASE; ?>admin/login/logout">Sair</a>
    </span>
  </div>
</nav>