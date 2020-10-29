<?php
namespace Controllers;
use \Core\Controller;
use \Models\Usuarios;
use \Models\Cursos;

class HomeController extends Controller {

    public function index() {
        $usuarios = new Usuarios();
        if(!$usuarios->isLogged()) {
           header("Location: " . BASE . "admin/login");
       } 

       $dados = array(
        'curso' => array()
        );
        $cursos = new Cursos();
      //  $dados['curso'] = $cursos->countCursos();

        $this->loadTemplate('home', $dados);
    }  

    public function perfil() {       
        $dados = array();
        $this->loadTemplate('perfil', $dados);
    }  

}
