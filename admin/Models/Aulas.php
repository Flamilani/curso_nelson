<?php
namespace Models;
use \Core\Model;

class Aulas extends Model {

	public function getAulasDoModulo($id) {
		$array = array();

		$sql = "SELECT * FROM aulas WHERE id_modulo = '$id' ORDER BY ordem";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();

			foreach($array as $aulachave => $aula) {
				if($aula['tipo'] == 'video') {
					$sql = "SELECT nome FROM curso_videos WHERE id_aula = '".($aula['id'])."'";
					$sql = $this->db->query($sql)->fetch();
					$array[$aulachave]['nome'] = $sql['nome'];
				}		
				elseif($aula['tipo'] == 'atividade') {
					$sql = "SELECT titulo FROM atividades WHERE id_aula = '".($aula['id'])."'";
					$sql = $this->db->query($sql)->fetch();
					$array[$aulachave]['nome'] = $sql['titulo'];
				}
				elseif($aula['tipo'] == 'arquivo') {
					$sql = "SELECT arquivo FROM arquivos WHERE id_aula = '".($aula['id'])."'";
					$sql = $this->db->query($sql)->fetch();
					$array[$aulachave]['nome'] = $sql['arquivo'];
				}		
				elseif($aula['tipo'] == 'poll') {
					$array[$aulachave]['nome'] = "Questionário";
				}
			} 
		}

		return $array;
	}

	public function deleteAula($id) {
		$sql = "SELECT id_curso FROM aulas WHERE id = '$id'";
		$sql = $this->db->query($sql);
		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			$this->db->query("DELETE FROM aulas WHERE id = '$id'");
			$this->db->query("DELETE FROM atividades WHERE id_aula = '$id'");
			$this->db->query("DELETE FROM curso_videos WHERE id_aula = '$id'");
			$this->db->query("DELETE FROM historico WHERE id_aula = '$id'");

			return $sql['id_curso'];
		}
	}

	public function addAula($id_curso, $id_modulo, $nome) {
		$sql = "SELECT ordem FROM aulas WHERE id_modulo = '$id_modulo' ORDER BY ordem DESC LIMIT 1";
		$sql = $this->db->query($sql);
		$ordem = 1;
		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			$ordem = intval($sql['ordem']);
			$ordem++;
		}

		$sql = "INSERT INTO aulas SET nome = '$nome', id_modulo = '$id_modulo', id_curso = '$id_curso', ordem = '$ordem'";
		$this->db->query($sql);
		$id_aula = $this->db->lastInsertId();

 		if($tipo == 'video') {	
			$sql = "INSERT INTO curso_videos SET id_aula = '$id_aula', nome = '$nome'";
			$this->db->query($sql);

		} elseif($tipo == 'poll') {
			$this->db->query("INSERT INTO questionarios SET questao = '$nome', id_aula = '$id_aula'");
			
		} elseif($tipo == 'atividade') {
			$this->db->query("INSERT INTO atividades SET titulo = '$nome', id_aula = '$id_aula'");

		} else {
			$this->db->query("INSERT INTO arquivos SET arquivo = '$nome', id_aula = '$id_aula'");
		} 
		
	}

	public function getAulaCurso($id_aula) {
		$array = array();

		$sql = "SELECT * FROM aulas WHERE id = '$id_aula'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function getAula($id_aula) {
		$array = array();

		$sql = "
		SELECT 
			tipo
		FROM 
			aulas 
		WHERE 
			id = '$id_aula'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();

			if($row['tipo'] == 'video') {

				$sql = "SELECT * FROM curso_videos WHERE id_aula = '$id_aula'";
				$sql = $this->db->query($sql);
				$array = $sql->fetch();
				$array['tipo'] = 'video';

			}
			elseif($row['tipo'] == 'poll') {

				$sql = "SELECT * FROM questionarios WHERE id_aula = '$id_aula'";
				$sql = $this->db->query($sql);
				$array = $sql->fetch();
				$array['tipo'] = 'poll';

			}
			elseif($row['tipo'] == 'atividade') {

				$sql = "SELECT * FROM atividades WHERE id_aula = '$id_aula'";
				$sql = $this->db->query($sql);
				$array = $sql->fetch();
				$array['tipo'] = 'atividade';

			}
			elseif($row['tipo'] == 'arquivo') {

				$sql = "SELECT * FROM arquivos WHERE id_aula = '$id_aula'";
				$sql = $this->db->query($sql);
				$array = $sql->fetch();
				$array['tipo'] = 'arquivo';

			}
		}

		return $array;
	}

	public function updateVideoAula($id, $nome, $descricao, $url, $duracao, $tipo) {
		$this->db->query("UPDATE curso_videos SET nome = '$nome', descricao = '$descricao', url = '$url', duracao = '$duracao' WHERE id_aula = '$id'");
		$this->db->query("UPDATE aulas SET tipo = '$tipo' WHERE id = '$id'");
		
		return $this->getCursoDeAula($id);
	}

	public function updateAtividade($id, $titulo, $descricao, $url, $tipo) {
		$this->db->query("UPDATE atividades SET titulo = '$titulo', descricao = '$descricao', url = '$url' WHERE id_aula = '$id'");
		$this->db->query("UPDATE aulas SET tipo = '$tipo' WHERE id = '$id'");

		return $this->getCursoDeAula($id);
	}

	public function updateArquivo($id, $arquivo, $descricao, $tipo) {
		$this->db->query("UPDATE arquivos SET arquivo = '$arquivo', descricao = '$descricao' WHERE id_aula = '$id'");
		$this->db->query("UPDATE aulas SET tipo = '$tipo' WHERE id = '$id'");

		return $this->getCursoDeAula($id);
	}

	public function updateArquivoPDF($id, $pdf) {
		$this->db->query("UPDATE arquivos SET pdf = '$pdf' WHERE id_aula = '$id'");

		return $this->getCursoDeAula($id);
	}

	public function updateQuestionarioAula($id, $pergunta, $opcao1, $opcao2, $opcao3, $opcao4, $resposta) {
		$this->db->query("UPDATE questionarios SET pergunta = '$pergunta', opcao1 = '$opcao1', opcao2 = '$opcao2', opcao3 = '$opcao3', opcao4 = '$opcao4', resposta = '$resposta' WHERE id_aula = '$id'");

		return $this->getCursoDeAula($id);
	}

	public function getCursoDeAula($id_aula) {

		$sql = "SELECT id_curso FROM aulas WHERE id = '$id_aula'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();
			return $row['id_curso'];
		} else {
			return 0;
		}

	}

	public function getModuloDeAula($id_aula) {

		$sql = "SELECT id_modulo FROM aulas WHERE id = '$id_aula'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();
			return $row['id_modulo'];
		} else {
			return 0;
		}

	}

	public function getSomaHoras($id_aula) {

		$sql = "SELECT SUM() FROM aulas WHERE id = '$id_aula'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();
			return $row['id_curso'];
		} else {
			return 0;
		}

	}

	public function updateAulaPorOrdem($id, $id_modulo, $ordem) {
		$this->db->query("UPDATE aulas SET ordem = '$ordem' WHERE id_modulo = '$id_modulo' AND id_aula = '$id'");
		return $this->getCursoDeAula($id);
	}

	public function updateAula($id, $nome, $midia, $atividade) {
		$sql = "SELECT id FROM aulas WHERE id = '$id'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			$this->db->query("UPDATE aulas SET nome = '$nome', midia = '$midia', atividade = '$atividade' WHERE id = '$id'");

			return $sql['id'];
		}
	}

	public function updateImagemAula($id, $imagem) {
		$this->db->query("UPDATE aulas SET imagem = '$imagem' WHERE id = '$id'");

		return $this->getAulaCurso($id);
	}

	public function updateArquivoAula($id, $arquivo) {
		$this->db->query("UPDATE aulas SET arquivo = '$arquivo' WHERE id = '$id'");

		return $this->getAulaCurso($id);
	}

	public function updateVideoDeAula($id, $url_video) {
		$this->db->query("UPDATE aulas SET url_video = '$url_video' WHERE id = '$id'");

		return $this->getAulaCurso($id);
	}

}