<?php
namespace Controllers;
use \Core\Controller;
use \Models\Usuarios;
use \Models\Alunos;
use \Models\Cursos;
use \Models\Modulos;
use \Models\Aulas;

class CursosController extends Controller {

    public function index() {
        $usuarios = new Usuarios();
        if(!$usuarios->isLogged()) {
           header("Location: " . BASE . "admin/login");
       } 

        $dados = array(
            'cursos' => array()
        );

        $cursos = new Cursos();
		$dados['cursos'] = $cursos->getCursos();
        
        $this->loadTemplate('cursos', $dados);
	}
	

	public function alunos($id) {
		$dados = array();

		if(isset($_POST['id_aluno']) && !empty($_POST['id_aluno'])) {
			$id_aluno = addslashes($_POST['id_aluno']);			
		
			$alunos = new Alunos();
			$alunos->addAlunoCurso($id, $id_aluno);		

			header("Location: " . BASE . 'admin/cursos/alunos/' . $id);

			$_SESSION['alerta_add_aluno_curso'] = 
			'<div class="text-center alert alert-success" role="alert">
			Aluno adicionado no curso com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>';
			exit;

	
		}
		$alunos = new Alunos();
		$dados['aluno'] = $alunos->getAlunos();
		$dados['listaAlunos'] = $alunos->selectAlunosCurso();
		$dados['exibirAlunos'] = $alunos->getAlunosCurso($id);

		$cursos = new Cursos();
		$dados['curso'] = $cursos->getCurso($id);

		$this->loadTemplate("curso_add_aluno", $dados);
	}

	public function deletar_aluno_curso($id) {

		if(!empty($id)) {

			$id = addslashes($id);
			$alunos = new Alunos();

			$id_curso = $alunos->deleteAlunoCurso($id);

			header("Location: " . BASE . "admin/cursos/alunos/". $id_curso);

			$_SESSION['alerta_deletar_aluno_curso'] = 
			'<div class="text-center alert alert-danger" role="alert">
			Aluno removido no curso com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>';
			exit;
		}

		header("Location: " . BASE . 'admin');
	}
    
    public function deletar($id) {

		$sql = "SELECT id FROM aulas WHERE id_curso = '$id'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$aulas = $sql->fetchAll();

			foreach($aulas as $aula) {
				$sqlaula = "DELETE FROM historico WHERE id_aula = '".($aula['id_aula'])."'";
				$this->db->query($sqlaula);

				$sqlaula = "DELETE FROM questionarios WHERE id_aula = '".($aula['id_aula'])."'";
				$this->db->query($sqlaula);

				$sqlaula = "DELETE FROM videos WHERE id_aula = '".($aula['id_aula'])."'";
				$this->db->query($sqlaula);
			}

		}

		$sql = "DELETE FROM aluno_curso WHERE id_curso = '$id'";
		$this->db->query($sql);

		$sql = "DELETE FROM aulas WHERE id_curso = '$id'";
		$this->db->query($sql);

		$sql = "DELETE FROM modulos WHERE id_curso = '$id'";
		$this->db->query($sql);

		$sql = "DELETE FROM cursos WHERE id = '$id'";
		$this->db->query($sql);

		header("Location: ". BASE . "admin/cursos");

	}

	public function adicionar() {
		$dados = array();

		if(isset($_POST['nome']) && !empty($_POST['nome'])) {

			$nome = addslashes($_POST['nome']);
			$descricao = addslashes($_POST['descricao']);
			$imagem = $_FILES['imagem'];

			if(!empty($imagem['tmp_name'])) {

				$md5name = md5(time().rand(0,9999)).'.jpg';
				$types = array('image/jpeg', 'image/jpg', 'image/png');

				if(in_array($imagem['type'], $types)) {
					move_uploaded_file($imagem['tmp_name'], "../assets/images/cursos/".$md5name);
					
					$this->db->query("INSERT INTO cursos SET nome = '$nome', descricao = '$descricao', imagem = '$md5name'");

					header("Location: " . BASE . 'admin');
				}

			}

		}

		$this->loadTemplate("curso_add", $dados);
	}

	public function editar($id) {
		$dados = array(
			'curso' => array()
		);

		$cursos = new Cursos();

		if(isset($_POST['nome']) && !empty($_POST['nome'])) {
			$nome = addslashes($_POST['nome']);
			$descricao = addslashes($_POST['descricao']);
			$url = addslashes($_POST['url']);
		//	$imagem = $_FILES['imagem'];

			$urlCurta = "https://youtu.be/";

			$parte = substr($url, 0, 17);		

			$novaUrl = str_replace($urlCurta, 'https://www.youtube.com/embed/', $url);		

			$cursos->updateCurso($id, $nome, $descricao,$novaUrl);

			$_SESSION['alerta_editar_curso'] = 
			'<div class="text-center alert alert-primary" role="alert">
			Curso atualizado com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>';
			exit;

/* 			if(!empty($imagem['tmp_name'])) {

				$md5name = md5(time().rand(0,9999)).'.jpg';
				$types = array('image/jpeg', 'image/jpg', 'image/png');

				if(in_array($imagem['type'], $types)) {
					move_uploaded_file($imagem['tmp_name'], "../assets/images/cursos/".$md5name);
					
					$this->db->query("UPDATE cursos SET imagem = '$md5name' WHERE id = '$id'");
				}
			} */
		}

		$dados['curso'] = $cursos->getCurso($id);

		$this->loadTemplate('curso_editar', $dados);
	}

	public function aulas($id) {
		$dados = array(
			'curso' => array(),
			'modulos' => array()
		);

        $modulos = new Modulos();

		// Usuário adicionou um novo módulo
		if(isset($_POST['modulo']) && !empty($_POST['modulo'])) {
			$modulo = addslashes($_POST['modulo']);
			$modulos->addModulo($modulo, $id);

			$_SESSION['alerta_add_aula'] = 
			'<div class="text-center alert alert-success" role="alert">
			Aula adicionada com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>';
		}

		// Usuário adicionou uma aula nova
		if(isset($_POST['aula']) && !empty($_POST['aula'])) {
			$aula = addslashes($_POST['aula']);
			$moduloaula = addslashes($_POST['moduloaula']);
		//	$tipo = addslashes($_POST['tipo']);

			$aulas = new Aulas();
			$aulas->addAula($id, $moduloaula, $aula);
			
			$_SESSION['alerta_add_parte'] = 
			'<div class="text-center alert alert-success" role="alert">
			Tema adicionado com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>';
		}

	   // Usuário ordena aula
		if(isset($_POST['array_ordem']) && !empty($_POST['array_ordem'])) {
			$array_ordem = addslashes($_POST['array_ordem']);
		//	$id_modulo = addslashes($_POST['id_modulo']);

			$cont_ordem = 1;
			foreach($array_ordem as $id_aula) {
			$aulas = new Aulas();			
			$aulas->updateAulaPorOrdem($id_aula, $id_modulo, $cont_ordem);
			$cont_ordem++;
			}
			
			$_SESSION['alerta_add_parte'] = 
			'<div class="text-center alert alert-success" role="alert">
			Tema adicionado com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>';
		}

		$cursos = new Cursos();
		$dados['curso'] = $cursos->getCurso($id);
		$dados['modulos'] = $modulos->getModulos($id);

		$this->loadTemplate('aulas', $dados);
	}

	
	public function editar_curso_aula($id) {
		$dados = array();		

		if(isset($_POST['nome']) && !empty($_POST['nome'])) {
			$nome = addslashes($_POST['nome']);
			$midia = addslashes($_POST['midia']);
			$atividade = addslashes($_POST['atividade']);
			$imagem = $_FILES['imagem'];
			$pdf = $_FILES['pdf'];
			$video = addslashes($_POST['url_video']);

			$aulas = new Aulas();
			$aulas->updateAula($id, $nome, $midia, $atividade);
			
				if(!empty($imagem['tmp_name']) && $midia == 'imagem') {

				$md5name = md5(time().rand(0,9999)).'.jpg';
				$types = array('image/jpeg', 'image/jpg', 'image/png');
		
				if(in_array($imagem['type'], $types)) {
					move_uploaded_file($imagem['tmp_name'], "../assets/uploads/".$md5name);

					$aulas = new Aulas();
					$aulas->updateImagemAula($id, $md5name);

					}
			}
			

			if(!empty($_POST['url_video']) && $midia == 'video') {
			
			$urlCurta = "https://youtu.be/";
			$parte = substr($video, 0, 17);		
				$novaUrl = str_replace($urlCurta, 'https://www.youtube.com/embed/', $video);

				$aulas = new Aulas();
				$aulas->updateVideoDeAula($id, $novaUrl);
			}	
			
			if(!empty($pdf['tmp_name']) && $midia == 'arquivo') {

				$md5name = md5(time().rand(0,9999)).'.pdf';
				$types = array('application/pdf');
/* 
				if(!empty($id)) {
					$arquivo = $modulos->deleteArquivoModulo($id);
					unlink ("../assets/uploads/" . $arquivo);
				} */

				if(in_array($pdf['type'], $types)) {
					move_uploaded_file($pdf['tmp_name'], "../assets/uploads/" . $md5name);

					$aulas = new Aulas();
					$aulas->updateArquivoAula($id, $md5name);					
				}
			}
		

			$_SESSION['alerta_editar_aula'] = 
			'<div class="text-center alert alert-primary" role="alert">
			Aula atualizada com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>';

			header("Location: ".BASE."admin/cursos/editar_curso_aula/".$id);
			exit;
		}
		$aulas = new Aulas();
		$dados['aula'] = $aulas->getAulaCurso($id);
		$dados['curso'] = $aulas->getCursoDeAula($id);

		$this->loadTemplate('curso_editar_aula', $dados);
	}

	public function update_ordem_aula() {

		// Usuário ordena curso
		$dados = array(
			'curso' => array(),
			'aula' => array()
		);	

		if(isset($_POST['ordem']) && !empty($_POST['ordem'])) {				
			$array_ordem = $_POST['ordem'];
			$id_aula = $_POST['id_aula'];
			var_dump("gravando..");
			var_dump("array_ordem" . $array_ordem);
			var_dump("id_aula " . $id_aula);
			$aulas = new Aulas();		
			$id_modulo = $aulas->getModuloDeAula($id_aula);
			var_dump("id_modulo: " . $id_modulo);
			$cont_ordem = 1;
			foreach($array_ordem as $id_aula) {
				$aulas = new Aulas();			
				$aulas->updateAulaPorOrdem($id_aula, $id_modulo, $cont_ordem);	
				$cont_ordem++;
				var_dump("gravou ordem!");
			}
			$aulas = new Aulas();	
			$id_curso = $aulas->getCursoDeAula($id_aula);
			header("Location: ". BASE . "admin/cursos/aulas/" . $id_curso);
		}
		$aulas = new Aulas();		
		$dados['aula'] = $aulas->getAula($id_aula);

		$cursos = new Cursos();
		$dados['curso'] = $cursos->getCurso($id_aula);
        
        $this->loadTemplate('aulas', $dados);
	}

	public function deletar_modulo($id) {

		if(!empty($id)) {

			$id = addslashes($id);
			$modulos = new Modulos();

			$id_curso = $modulos->deleteModulo($id);

			header("Location: " . BASE . "admin/cursos/aulas/".$id_curso);

			$_SESSION['alerta_deletar_modulo'] = 
			'<div class="text-center alert alert-danger" role="alert">
			Aula deletada com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>';
			exit;
		}

		header("Location: " . BASE . 'admin');
	}

	public function editar_modulo($id) {
		$array = array();
		

		if(isset($_POST['modulo']) && !empty($_POST['modulo'])) {
			$nome = addslashes($_POST['modulo']);
			$midia = addslashes($_POST['midia']);
			$imagem = $_FILES['imagem'];
			$pdf = $_FILES['pdf'];
			$video = addslashes($_POST['url_video']);

			$modulos = new Modulos();			
			$modulos->updateModulo($id, $nome, $midia);

				if(!empty($imagem['tmp_name']) && $midia == 'imagem') {

				$md5name = md5(time().rand(0,9999)).'.jpg';
				$types = array('image/jpeg', 'image/jpg', 'image/png');
					
				if(!empty($id)) {
					$magem = $modulos->deleteImagemModulo($id);
					unlink ("../assets/uploads/" . $magem);
				}

				if(in_array($imagem['type'], $types)) {
					move_uploaded_file($imagem['tmp_name'], "../assets/uploads/".$md5name);

					$modulos = new Modulos();
					$modulos->updateImagemModulo($id, $md5name);

					}
			}
			

			if(!empty($_POST['url_video']) && $midia == 'video') {
			
			$urlCurta = "https://youtu.be/";
			$parte = substr($video, 0, 17);		
				$novaUrl = str_replace($urlCurta, 'https://www.youtube.com/embed/', $video);

				$modulos = new Modulos();
				$modulos->updateVideoModulo($id, $novaUrl);
			}	
			
			if(!empty($pdf['tmp_name']) && $midia == 'arquivo') {

				$md5name = md5(time().rand(0,9999)).'.pdf';
				$types = array('application/pdf');

				if(!empty($id)) {
					$arquivo = $modulos->deleteArquivoModulo($id);
					unlink ("../assets/uploads/" . $arquivo);
				}

				if(in_array($pdf['type'], $types)) {
					move_uploaded_file($pdf['tmp_name'], "../assets/uploads/" . $md5name);

					$modulos = new Modulos();
					$modulos->updateArquivoModulo($id, $md5name);					
				}
			}
		

			$_SESSION['alerta_editar_aula'] = 
			'<div class="text-center alert alert-primary" role="alert">
			Aula atualizada com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>';

			header("Location: ".BASE."admin/cursos/editar_modulo/".$id);
			exit;
		}
		$modulos = new Modulos();
		$array['modulo'] = $modulos->getModulo($id);

		$this->loadTemplate('curso_editar_modulo', $array);
	}

	public function deletar_aula($id) {

		if(!empty($id)) {

			$id = addslashes($id);
			$aulas = new Aulas();

			$id_curso = $aulas->deleteAula($id);

			header("Location: " . BASE . "admin/cursos/aulas/".$id_curso);
			
			$_SESSION['alerta_deletar_aula'] = 
				'<div class="text-center alert alert-danger" role="alert">
				Tema deletado com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span></button></div>';
			exit;
		}

		header("Location: " . BASE . "admin");
	}

	public function editar_aula($id) {
		$dados = array();
		$view = 'curso_editar_aula_video';

		$aulas = new Aulas();

		if(isset($_POST['nome']) && !empty($_POST['nome'])) {
			$nome = addslashes($_POST['nome']);
			$descricao = addslashes($_POST['descricao']);
			$url = addslashes($_POST['url']);
			$duracao = addslashes($_POST['duracao']);
			$tipo = addslashes($_POST['tipo']);

			$urlCurta = "https://youtu.be/";

			$parte = substr($url, 0, 17);	
	
				$novaUrl = str_replace($urlCurta, 'https://www.youtube.com/embed/', $url);
	
				$id_curso = $aulas->updateVideoAula($id, $nome, $descricao, $novaUrl, $duracao, $tipo);
							
				header("Location: " . BASE . "admin/cursos/editar_aula/".$id);

				$_SESSION['alerta_editar_aula_video'] = 
				'<div class="text-center alert alert-primary" role="alert">
				Aula atualizada com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span></button></div>';
				exit;
		}

		if(isset($_POST['titulo']) && !empty($_POST['titulo'])) {
			$titulo = addslashes($_POST['titulo']);
			$descricao = addslashes($_POST['descricao']);
			$url = addslashes($_POST['url']);
			$tipo = addslashes($_POST['tipo']);

			$urlCurta = "https://youtu.be/";

			$parte = substr($url, 0, 17);	
	
				$novaUrl = str_replace($urlCurta, 'https://www.youtube.com/embed/', $url);
	
				$id_curso = $aulas->updateAtividade($id, $titulo, $descricao, $novaUrl, $tipo);

				header("Location: " . BASE . "admin/cursos/editar_aula/".$id);

				$_SESSION['alerta_editar_atividade'] = 
				'<div class="text-center alert alert-primary" role="alert">
				Atividade atualizada com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span></button></div>';
				exit;
		
		}

		if(isset($_POST['arquivo']) && !empty($_POST['arquivo'])) {
			$arquivo = addslashes($_POST['arquivo']);
			$descricao = addslashes($_POST['descricao']);
			$pdf = $_FILES['pdf'];
			$tipo = addslashes($_POST['tipo']);

			$id_curso = $aulas->updateArquivo($id, $arquivo, $descricao, $tipo);		
	
			if(!empty($pdf['tmp_name'])) {

				$md5name = md5(time().rand(0,9999)).'.pdf';
				$types = array('application/pdf');

				if(in_array($pdf['type'], $types)) {
					move_uploaded_file($pdf['tmp_name'], "../assets/uploads/" . $md5name);

					$aulas->updateArquivoPDF($id, $md5name);					
				}
			}

			header("Location: " . BASE . "admin/cursos/editar_aula/".$id);

				$_SESSION['alerta_editar_arquivo_pdf'] = 
				'<div class="text-center alert alert-primary" role="alert">
				Arquivo atualizado com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span></button></div>';
				exit;
		}

		if(isset($_POST['pergunta']) && !empty($_POST['pergunta'])) {
			$pergunta = addslashes($_POST['pergunta']);
			$opcao1 = addslashes($_POST['opcao1']);
			$opcao2 = addslashes($_POST['opcao2']);
			$opcao3 = addslashes($_POST['opcao3']);
			$opcao4 = addslashes($_POST['opcao4']);
			$resposta = addslashes($_POST['resposta']);

			$id_curso = $aulas->updateQuestionarioAula($id, $pergunta, $opcao1, $opcao2, $opcao3, $opcao4, $resposta);

			header("Location: " . BASE . "admin/cursos/editar_aula/".$id);
		}

		
		$dados['aula'] = $aulas->getAula($id);

		$dados['curso'] = $aulas->getCursoDeAula($id);

		if($dados['aula']['tipo'] == 'video') {
			$view = 'curso_editar_aula_video';
		} elseif($dados['aula']['tipo'] == 'atividade') {
			$view = 'curso_editar_aula_atividade';
		} else {
			$view = 'curso_editar_aula_arquivo';
		}

		$this->loadTemplate($view, $dados);

	}

}
