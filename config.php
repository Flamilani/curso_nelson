<?php 
require 'environment.php';

global $config;
$config = array();

if(ENVIRONMENT == 'development') {
	define("BASE", "http://localhost/curso_nelson/");
	$config['host'] = 'localhost';
	$config['dbname'] = 'curso_nelson';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '123123';
} else {
	define("BASE", "http://curso.nelsonpimenta.com.br/");
	$config['host'] = 'mysql.hostinger.com.br';
	$config['dbname'] = 'u769555168_curso';
	$config['dbuser'] = 'u769555168_acesso';
	$config['dbpass'] = 'cursoNelson@6';
}

global $db;
try {
	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass'], 
	array(PDO::ATTR_TIMEOUT => 5));
	
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}

 ?>