<?php
namespace Controllers;
use \Core\Controller;
use \Models\Alunos;
use \Models\Cursos;
use \Models\Modulos;
use \Models\Aulas;

class CursosController extends Controller {
	
	public function index() {
        $alunos = new Alunos();
        if(!$alunos->isLogged()) {
            header("Location: " . BASE . "login");
        }

		$dados = array(
			'info' => array(),
			'cursos' => array()
		);

		$alunos->setAluno($_SESSION['logaluno']);
		$dados['info'] = $alunos;

		$cursos = new Cursos();
		$dados['cursos'] = $cursos->getCursosDoAluno($alunos->getId());

		$this->loadTemplate('cursos', $dados);
	}

	public function entrar($id) {
		$dados = array(
			'info' => array(),
			'curso' => array(),
			'modulos' => array()
		);
		$alunos = new Alunos();
		$alunos->setAluno($_SESSION['logaluno']);
		$dados['info'] = $alunos;

		if($alunos->isInscrito($id)) {
			$curso = new Cursos();
			$curso->setCurso($id);
			$dados['curso'] = $curso;

			$modulos = new Modulos();
			$dados['modulos'] = $modulos->getModulos($id);

			$dados['aulas_assistidas'] = $alunos->getNumAulasAssistidas($id);
			$dados['total_aulas'] = $curso->getTotalAulas();

			$this->loadTemplate('curso_entrar', $dados);
		} else {
			header("Location: " . BASE);
		}
	}

	public function modulo($id_modulo) {
		$dados = array(
			'curso' => array(),
			'modulos' => array(),
			'modulo' => array()
		);
		$alunos = new Alunos();
		$alunos->setAluno($_SESSION['logaluno']);

		$aula = new Aulas();
		$id = $aula->getCursoDeModulo($id_modulo);

		if($alunos->isInscrito($id)) {
			$curso = new Cursos();
			$curso->setCurso($id);
			$dados['curso'] = $curso;

			$modulos = new Modulos();
			$dados['modulos'] = $modulos->getModulos($id);
			$dados['parte_modulo'] = $modulos->getModulo($id_modulo);
			
			$dados['aulas_assistidas'] = $alunos->getNumAulasAssistidas($id);

			$dados['total_aulas'] = $curso->getTotalAulas();

			$this->loadTemplate('curso_modulo', $dados);
		} else {
			header("Location: " . BASE);
		}

	}

	public function ver_aula($id_aula) {
		$dados = array(
			'curso' => array(),
			'modulos' => array(),
			'modulo' => array()
		);
		$alunos = new Alunos();
		$alunos->setAluno($_SESSION['logaluno']);

		$aulas = new Aulas();
		$id = $aulas->getCursoDeAula($id_aula);

		if($alunos->isInscrito($id)) {
			$curso = new Cursos();
			$curso->setCurso($id);
			$dados['curso'] = $curso;

			$modulos = new Modulos();
			$aulas = new Aulas();
			$dados['modulos'] = $modulos->getModulos($id);
			$dados['parte_aula'] = $aulas->getListaAula($id_aula);
			$dados['aulas_assistidas'] = $alunos->getNumAulasAssistidas($id);

			$dados['total_aulas'] = $curso->getTotalAulas();

			$this->loadTemplate('curso_aula', $dados);
		} else {
			header("Location: " . BASE);
		}

	}

	public function aula($id_aula) {
		$dados = array(
			'info' => array(),
			'curso' => array(),
			'modulos' => array(),
			'aula_info' => array(),
			'atividade' => array()
		);
		$alunos = new Alunos();
		$alunos->setAluno($_SESSION['logaluno']);
		$dados['info'] = $alunos;

		$aula = new Aulas();
		$id = $aula->getCursoDeAula($id_aula);

		if($alunos->isInscrito($id)) {
			$curso = new Cursos();
			$curso->setCurso($id);
			$dados['curso'] = $curso;

			$modulos = new Modulos();
			$dados['modulos'] = $modulos->getModulos($id);

			$dados['aulas_assistidas'] = $alunos->getNumAulasAssistidas($id);

			$dados['total_aulas'] = $curso->getTotalAulas();

			$dados['aula_info'] = $aula->getAula($id_aula);

			$dados['atividade'] = $aula->getAtividadeAluno($id_aula);

			if($dados['aula_info']['tipo'] == 'video') {
				$view = 'curso_aula_video';
			} elseif($dados['aula_info']['tipo'] == 'poll') {
				$view = 'curso_aula_poll';
				if(!isset($_SESSION['poll'.$id_aula])) {
					$_SESSION['poll'.$id_aula] = 1;
				}
			} elseif($dados['aula_info']['tipo'] == 'atividade') {
				$view = 'curso_atividade';		
			} elseif($dados['aula_info']['tipo'] == 'arquivo') {
				$view = 'curso_aula_arquivo';	
			}

			if(isset($_POST['duvida']) && !empty($_POST['duvida'])) {
				$duvida = addslashes($_POST['duvida']);
				$aula->setDuvida($duvida, $alunos->getId());
			}

			if(isset($_POST['url_video_aluno']) && !empty($_POST['url_video_aluno'])) {
				$url_video_aluno = addslashes($_POST['url_video_aluno']);
				$urlCurta = "https://youtu.be/";
				$parte = substr($url_video_aluno, 0, 17);		
	
				$novaUrl = str_replace($urlCurta, 'https://www.youtube.com/embed/', $url_video_aluno);		
				$aula->setAtividade($alunos->getId(), $id_aula, $novaUrl);

				$_SESSION['alerta_atividade_salva'] = 
				'<div class="text-center alert alert-primary" role="alert">
				Atividade salva com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span></button></div>';
				exit;
			}

			if(isset($_POST['opcao']) && !empty($_POST['opcao'])) {
				$opcao = addslashes($_POST['opcao']);
				if($opcao == $dados['aula_info']['resposta']) {
					$dados['resposta'] = true;
					$aula->marcarAssistido($id_aula);
				} else {
					$dados['resposta'] = false;
				}

				$_SESSION['poll'.$id_aula]++;
			}

			$this->loadTemplate($view, $dados);
		} else {
			header("Location: " . BASE);
		}

	}

}
