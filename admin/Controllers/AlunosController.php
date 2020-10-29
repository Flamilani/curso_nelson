<?php
namespace Controllers;
use \Core\Controller;
use \Models\Usuarios;
use \Models\Alunos;

class AlunosController extends Controller {

    public function index() {
        $usuarios = new Usuarios();
        if(!$usuarios->isLogged()) {
           header("Location: " . BASE . "admin/login");
       } 

        $dados = array(
            'alunos' => array()
        );     
        
        if(isset($_POST['nome']) && !empty($_POST['nome'])) {

			$nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = $this->generateRandomString();
            $status = '1';

            $alunos = new Alunos();
            $alunos->addAluno($nome, $email, $senha, $status);			

            $_SESSION['alerta_add_aluno'] = 
            '<div class="text-center alert alert-success" role="alert">
            Aluno cadastrado com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>';          
		}
     
        $alunos = new Alunos();
        $dados['alunos'] = $alunos->getAlunos();

        $this->loadTemplate('alunos', $dados);
    }

    public function editar($id) {
		$dados = array(
            'aluno' => array()
        );        

		if(isset($_POST['nome']) && !empty($_POST['nome'])) {
			$nome = addslashes($_POST['nome']);
			$email = addslashes($_POST['email']);

			$alunos = new Alunos();
			$alunos->updateAluno($id, $nome, $email);

			header("Location: " . BASE . "admin/alunos");

			$_SESSION['alerta_editar_aluno'] = 
			'<div class="text-center alert alert-primary" role="alert">
			Aluno ' . $nome . ' atualizado com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>';
            exit;          
		}

		$alunos = new Alunos();
		$dados['aluno'] = $alunos->getAluno($id);

		$this->loadTemplate('aluno_editar', $dados);
	}
   
    public function deletar($id) {

		$alunos = new Alunos();
        $alunos->deleteAluno($id);          
        
			$_SESSION['alerta_deletar_aluno'] = 
			'<div class="text-center alert alert-danger" role="alert">
			Aluno deletado com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>';

        header("Location: " . BASE . "admin/alunos");
    }
        
    public function enviar($id) {
		$array = array();

		$alunos = new Alunos();

		if(isset($_POST['email']) && !empty($_POST['email'])) {
			$nome = addslashes($_POST['nome']);
			$email = addslashes($_POST['email']);
			$id_curso = $modulos->enviarAluno($id, $nome, $email);

			$_SESSION['alerta_editar_aula'] = 
			'<div class="text-center alert alert-primary" role="alert">
			Aluno atualizado com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>';
            exit;
            
			header("Location: ".BASE."admin/alunos");

		}
		
		$array['modulo'] = $modulos->getModulo($id);

		$this->loadTemplate('aluno_editar', $array);
	}

}