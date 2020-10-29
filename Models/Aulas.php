<?php
namespace Models;
use \Core\Model;

class Aulas extends Model {

	public function marcarAssistido($id) {
		$aluno = $_SESSION['logaluno'];
		$sql = "INSERT INTO historico SET data_viewed = NOW(), id_aluno = '$aluno', id_aula = '$id'";
		$this->db->query($sql);
	}

	public function getAulasDoModulo($id) {
		$array = array();
		$aluno = $_SESSION['logaluno'];

		$sql = "SELECT * FROM aulas WHERE id_modulo = '$id' ORDER BY ordem";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();

			foreach($array as $aulachave => $aula) {
				$array[$aulachave]['assistido'] = $this->isAssistido($aula['id'], $aluno);
				
				$array[$aulachave]['avaliado'] = $this->isAvaliado($aula['id'], $aluno);

		/* 		if($aula['tipo'] == 'video') {
					$sql = "SELECT nome FROM curso_videos WHERE id_aula = '".($aula['id'])."'";
					$sql = $this->db->query($sql)->fetch();
					$array[$aulachave]['nome'] = $sql['nome'];
				}
				elseif($aula['tipo'] == 'poll') {
					$array[$aulachave]['nome'] = "Questionário";
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
				} */
			}
		}

		return $array;
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

	public function getCursoDeModulo($id_modulo) {

		$sql = "SELECT id_curso FROM aulas WHERE id_modulo = '$id_modulo'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();
			return $row['id_curso'];
		} else {
			return 0;
		}

	}

	public function getListaAula($id) {
		$array = array();

		$sql = "SELECT * FROM aulas WHERE id = '$id'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function getAula($id_aula) {
		$array = array();

		$id_aluno = $_SESSION['logaluno'];

		$sql = "
		SELECT 
			*,
			(select count(*) from historico where historico.id_aula = aulas.id and historico.id_aluno = '$id_aluno') as assistido
		FROM 
			aulas 
		WHERE 
			id = '$id_aula'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();

/* 			if($row['tipo'] == 'video') {

				$sql = "SELECT * FROM curso_videos WHERE id_aula = '$id_aula'";
				$sql = $this->db->query($sql);
				$array = $sql->fetch();
				$array['tipo'] = 'video';

			} elseif($row['tipo'] == 'poll') {

				$sql = "SELECT * FROM questionarios WHERE id_aula = '$id_aula'";
				$sql = $this->db->query($sql);
				$array = $sql->fetch();
				$array['tipo'] = 'poll';

			} elseif($row['tipo'] == 'atividade') {

				$sql = "SELECT * FROM atividades WHERE id_aula = '$id_aula'";
				$sql = $this->db->query($sql);
				$array = $sql->fetch();
				$array['tipo'] = 'atividade';

			} elseif($row['tipo'] == 'arquivo') {

				$sql = "SELECT * FROM arquivos WHERE id_aula = '$id_aula'";
				$sql = $this->db->query($sql);
				$array = $sql->fetch();
				$array['tipo'] = 'arquivo';

			} */

			$array['assistido'] = $row['assistido'];

		}

		return $array;
	}

	public function getAtividadeAluno($id_aula) {
		$array = array();

		$id_aluno = $_SESSION['logaluno'];

		$sql = "SELECT * from atividade_aluno where id_aula = '$id_aula' and id_aluno = '$id_aluno'";
		$sql = $this->db->query($sql);
		
		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}


	public function setDuvida($duvida, $aluno) {

		$sql = "INSERT INTO duvidas SET data_duvida = NOW(), duvida = '$duvida', id_aluno = '$aluno'";
		$this->db->query($sql);

	}

	public function setAtividade($id_aluno, $id_aula, $url_video_aluno) {

		$sql = "INSERT INTO atividade_aluno SET id_aluno = '$id_aluno', id_aula = '$id_aula', url_video_aluno = '$url_video_aluno'";
		$this->db->query($sql);

	}

 	private function isAssistido($id_aula, $id_aluno) {

		$sql = "SELECT id FROM historico WHERE id_aluno = '$id_aluno' AND id_aula = '$id_aula'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}

	} 

	private function isAvaliado($id_aula, $id_aluno) {

		$sql = "SELECT id FROM atividade_aluno WHERE id_aluno = '$id_aluno' AND id_aula = '$id_aula'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}

	} 

}