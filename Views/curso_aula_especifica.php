<div class="container mt-3">
<?php require 'inc/aside.php'; ?>  
  <div class="col-sm-8">
  <h3><?php echo $aula_info['titulo']; ?></h3>
	<?php echo $aula_info['pagina']; ?><br />
  <style type="text/css">
    	<?php echo $aula_info['estilo']; ?>
  </style>
	<?php if($aula_info['assistido'] == '1'): ?>
		Esta aula já foi assistida!
	<?php else: ?>
		<button class="btn btn-outline-success mt-3 text-center" onclick="marcarAssistido(this)" data-id="<?php echo $aula_info['id_aula']; ?>">Marcar como assistido</button>
	<?php endif; ?>
  </div>
</div>

</div>
