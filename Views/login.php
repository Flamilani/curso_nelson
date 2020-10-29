<?php require 'inc/header.php'; ?>
<h3 class="text-center mt-5 mb-3">Curso - Nelson Pimenta</h3>
    <main class="container d-flex justify-content-center mt-3">
            <div class="row">          
                    <div class="card mb-3">                  
                            <div class="card-header text-white bg-secondary">
                             <div class="h4 font-weight-normal text-center">Login</div> 
                            </div>
                            <div class="card-body">
                                    <form class="form-signin" method="POST">                                  
                                            <div class="form-label-group">
                                              <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required autofocus>
                                              <label style="cursor:text" for="email">E-mail</label>
                                            </div>
                                      
                                            <div class="form-label-group">
                                              <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required>
                                              <label style="cursor:text" for="senha">Senha</label>
                                            </div>
                                
                                            <input class="btn btn-success btn-block" type="submit" value="Acessar" />                      
                                     </form>  
                                     <?php if (isset($_SESSION['nao_logado']) && !empty($_SESSION['nao_logado'])) {
                                                echo $_SESSION['nao_logado'];
                                                unset($_SESSION['nao_logado']);
                                          } ?>                                                                  
                            </div>
                          </div>   
                       
                  </div>       
    </main>
<?php require 'inc/footer.php'; ?> 