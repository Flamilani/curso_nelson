<?php
namespace Controllers;
use \Core\Controller;
use \Models\Alunos;
use \Models\Aulas;

class AjaxController extends Controller {

	public function index() {
		$alunos = new Alunos();

		if(!$alunos->isLogged()) {
			header("Location: ". BASE . "login");
		}
	}

	public function marcar_assistido($id) {
		$aulas = new Aulas();
		$aulas->marcarAssistido($id);
	}

}