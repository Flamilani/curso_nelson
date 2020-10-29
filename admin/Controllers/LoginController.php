<?php
namespace Controllers;
use \Core\Controller;
use \Models\Usuarios;

class LoginController extends Controller {

	public function index() {
		$array = array();

		if(isset($_POST['email']) && !empty($_POST['email'])) {

			$email = addslashes($_POST['email']);
			$senha = md5($_POST['senha']);

			$usuarios = new Usuarios();

			if($usuarios->fazerLogin($email, $senha)) {
				header("Location: " . BASE . "admin/home");
			} else {
				$_SESSION['nao_logado'] = 
				'<div class="text-center alert alert-danger" role="alert">
				Usuário e/ou senha incorretos! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span></button></div>';
			}

		}

		$this->loadView("login", $array);
	}

	public function logout() {
		unset($_SESSION['logadmin']);
		header("Location: " . BASE . "admin/login");
	}

}