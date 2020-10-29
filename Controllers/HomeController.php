<?php
namespace Controllers;
use \Core\Controller;
use \Models\Alunos;

class HomeController extends Controller {
    
    public function index() {

        $alunos = new Alunos();
        if(!$alunos->isLogged()) {
            header("Location: " . BASE . "login");
        }
        
       $dados = array();
        $this->loadTemplate('home', $dados);
    }  

}
