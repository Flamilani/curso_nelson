<h3><a data-toggle="tooltip" title="Voltar para Cursos" href="<?= BASE; ?>cursos" class="btn btn-success">
  <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> Curso <?php echo $curso->getNome(); ?></h3> 
<p class="lead m-3"><?php echo $curso->getDescricao(); ?></p>
<!--     <div class="progress mb-3">
  <div class="progress-bar" role="progressbar" style="width: <?php echo (($aulas_assistidas/$total_aulas)*100); ?>%;" aria-valuenow="<?php echo (($aulas_assistidas/$total_aulas)*100); ?>" aria-valuemin="0" aria-valuemax="100">
  <?php echo $aulas_assistidas.' / '.$total_aulas.' ('. (($aulas_assistidas/$total_aulas)*100) .'%)'; ?>
  </div>
</div> -->

 <div class="row">
  <div class="col-sm-4">  

  <?php foreach($modulos as $modulo): ?>
    <div class="list-group mb-3">
    <a href="<?php echo BASE; ?>cursos/modulo/<?php echo $modulo['id']; ?>" class="list-group-item list-group-item-action active bg-green">
  <?php echo $modulo['nome']; ?>
  </a>
  <?php foreach($modulo['aulas'] as $aula): ?>
    <?php $active = (isset($_SERVER["REQUEST_URI"]) && $aula['id'] == $_SERVER["REQUEST_URI"]) ? 'active' : ''; ?>
  <a href="<?php echo BASE; ?>cursos/ver_aula/<?php echo $aula['id']; ?>" 
  class="list-group-item list-group-item-action <?= $active; ?>">
  <?php echo $aula['atividade'] == '1' ? '<b class="text-primary">Atividade</b>' : ''; ?> <?php echo $this->parse($aula['nome']); ?><?php (isset($aula['avaliado']) && !empty($aula['avaliado']) ? $aula['avaliado'] : ''); ?>
<!-- 				<?php if($aula['assistido'] === true): ?>
                    <i class="fa fa-check-circle-o fa-2x pull-right text-success" aria-hidden="true"></i>
                <?php else: ?>
                    <i class="fa fa-check-circle-o fa-2x pull-right text-gray" aria-hidden="true"></i>
		<?php endif; ?> -->
  </a>
  <?php endforeach; ?>
</div>
	<?php endforeach; ?>
  </div>