<?php
namespace Models;
use \Core\Model;
use \Models\Aulas;

class Modulos extends Model {

	public function getModulos($id_curso) {
		$array = array();

		$sql = "SELECT * FROM modulos WHERE id_curso = '$id_curso'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {

			$array = $sql->fetchAll();

			$aulas = new Aulas();

			foreach($array as $mChave => $mDados) {
				$array[$mChave]['aulas'] = $aulas->getAulasDoModulo($mDados['id']);
			}

		}

		return $array;
	}

	public function getModulo($id) {
		$array = array();

		$sql = "SELECT * FROM modulos WHERE id = '$id'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function getModuloPorAula($id) {
		$array = array();
		$aluno = $_SESSION['logaluno'];

		$sql = "SELECT * FROM modulos WHERE id = '$id'";

		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();		
		}

		return $array;
	}

	public function getCursosDoAluno($id) {
		$array = array();

		$sql = "
			SELECT 
				aluno_curso.id_curso,
				cursos.nome,
				cursos.imagem,
				cursos.descricao
			FROM 
				aluno_curso
			LEFT JOIN cursos
				ON aluno_curso.id_curso = cursos.id
			WHERE
				aluno_curso.id_aluno = '$id'
		";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;

	}

}