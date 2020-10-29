<?php
namespace Models;
use \Core\Model;

class Alunos extends Model {

    public function isLogged() {
      if(isset($_SESSION['logaluno']) && !empty($_SESSION['logaluno'])) {
        return true;

      } else {
        return false;
      }
    }

    public function fazerLogin($email, $senha) {

      $sql = "SELECT * FROM alunos WHERE email = '$email' AND senha_md5 = '$senha' AND status = 1";
      $sql = $this->db->query($sql);
  
      if($sql->rowCount() > 0) {
        $row = $sql->fetch();
  
        $_SESSION['logaluno'] = $row['id'];
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['email'] = $row['email'];
  
        return true;
      }
  
      return false;
  
    }

    public function isInscrito($id_curso) {
      $sql = "SELECT * FROM aluno_curso WHERE id_aluno = '".($this->info['id'])."' AND id_curso = '$id_curso'";
      $sql = $this->db->query($sql);
  
      if($sql->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    }
  
    public function setAluno($id) {
  
      $sql = "SELECT * FROM alunos WHERE id = '$id'";
      $sql = $this->db->query($sql);
  
      if($sql->rowCount() > 0) {
        $this->info = $sql->fetch();
      }
  
    }
  
    public function getNome() {
      return $this->info['nome'];
    }
  
    public function getId() {
      return $this->info['id'];
    }
  
    public function getNumAulasAssistidas($id_curso) {
      $sql = "
      SELECT id
      FROM historico
      WHERE
        id_aluno = '".($this->getId())."'
        AND id_aula IN (select aulas.id from aulas where aulas.id_curso = '$id_curso')
      ";
      $sql = $this->db->query($sql);
  
      return $sql->rowCount();
    }
}
?>