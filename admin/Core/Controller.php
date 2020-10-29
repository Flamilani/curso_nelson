<?php
namespace Core;

class Controller {

	protected $db;

	public function __construct() {
		global $db;
		$this->db = $db;
	}

	public function loadView($viewName, $viewData = array()) {
		extract($viewData);
		require 'Views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array()) {
		require 'Views/template.php';
	}

	public function loadViewInTemplate($viewName, $viewData = array()) {
		extract($viewData);
		require 'Views/'.$viewName.'.php';
	}

	public function zeroPad($string) {
		$str = str_pad($string, 4, '0', STR_PAD_LEFT);
		return $str;
	}

	public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
	}
	
	function limitarTexto($texto, $limite){
		$contador = strlen($texto);
		if ( $contador >= $limite ) {      
			$texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
			return $texto;
		}
		else{
		  return $texto;
		}
	  } 

	function parse($string) {
		$result = strip_tags($string, "<strong>");

		return $result;
	}



	  function aulaButton($tipo) {
		switch ($tipo) {
			case "atividade":			 
			  echo '<i class="fa fa-file-text-o" aria-hidden="true"></i>';
			  break;
			case "arquivo":
			  echo '<i class="fa fa-file-pdf-o" aria-hidden="true"></i>';
			  break;
			case "imagem":
				echo '<i class="fa fa-picture-o" aria-hidden="true"></i>';
				break;
			case "video":
				echo '<i class="fa fa-video-camera" aria-hidden="true"></i>';
				break;
			default:
				echo '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>';
		  }
	  } 

	  function aulaColor($tipo) {
		switch ($tipo) {
			case "atividade":
			  echo 'primary';
			  break;
			case "arquivo":
			  echo 'danger';
			  break;
			case "imagem":
				echo 'light';
				break;
			case "video":
				echo 'info';
				break;
			default:
			  echo 'secondary';
		  }
	  } 

	  function aulaTooltip($tipo) {
		switch ($tipo) {
			case "atividade":
			  echo 'Atividade';
			  break;
			case "arquivo":
			  echo 'PDF';
			  break;
			case "imagem":
				echo 'Imagem';
				break;
			case "Vídeo":
				echo 'video';
				break;
			default:
			  echo 'Parte';
		  }
	  } 


}