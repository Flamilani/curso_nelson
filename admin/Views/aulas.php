<div class="container mt-3">
<h3><a class="btn btn-success" href="<?= BASE; ?>admin/cursos" role="button">
<i class="fa fa-arrow-left" aria-hidden="true"></i>
</a>
 Aulas do Curso: <?php echo $curso['nome']; ?> </h3> <hr>

 <?php if (isset($_SESSION['alerta_add_aula']) && !empty($_SESSION['alerta_add_aula'])) {
  echo $_SESSION['alerta_add_aula'];
 unset($_SESSION['alerta_add_aula']);
 } ?>

<?php if (isset($_SESSION['alerta_add_parte']) && !empty($_SESSION['alerta_add_parte'])) {
  echo $_SESSION['alerta_add_parte'];
 unset($_SESSION['alerta_add_parte']);
 } ?>

 <?php if (isset($_SESSION['alerta_deletar_modulo']) && !empty($_SESSION['alerta_deletar_modulo'])) {
  echo $_SESSION['alerta_deletar_modulo'];
 unset($_SESSION['alerta_deletar_modulo']);
 } ?>

 <?php if (isset($_SESSION['alerta_deletar_aula']) && !empty($_SESSION['alerta_deletar_aula'])) {
  echo $_SESSION['alerta_deletar_aula'];
 unset($_SESSION['alerta_deletar_aula']);
 } ?>
 <h4>Adicionar Nova Aula</h4> 
	<form method="POST" class="form-row" autocomplete="off">
  <div class="form-group col-md-6 mr-3 mb-2">
    <label for="modulo" class="sr-only">Aula</label>
    <input type="text" class="form-control" name="modulo" id="modulo" placeholder="Título de Aula" required>
  </div>
  <input type="submit" class="btn btn-success mb-2" id="btn-modulo" value="Adicionar Aula" />
</form>  
<br />
<?php if(!empty($modulos)): ?>  
 <h4>Adicionar Novo Tema</h4>

<form method="POST" autocomplete="off">
<div class="form-row">
    <div class="form-group col-md-6">
    <label for="aula">Tema</label>
    <textarea class="form-control" name="aula" id="aula" rows="2"></textarea> 
    </div>
    <div class="form-group col-md-2">
    <label for="modulo">Aula</label>
	<select class="form-control" name="moduloaula" id="moduloaula">
			<?php foreach($modulos as $modulo): ?>
			<option value="<?php echo $modulo['id']; ?>"><?php echo $modulo['nome']; ?></option>
			<?php endforeach; ?>
		</select>
    </div>
<!--     <div class="form-group col-md-2">
    <label for="tipo">Tipo de Aula</label>
	<select class="form-control" name="tipo" id="tipo">
			<option value="video">Vídeo</option>
			<option value="arquivo">PDF</option>
			<option value="atividade">Atividade</option>
			<option value="poll">Questionário</option> 
		</select>
    </div> -->
  </div>
  <div class="form-group">
        <input type="submit" class="btn btn-success" id="btn-aula" value="Adicionar Tema" />
    </div>
  </form>  
  <?php endif; ?>
<br />
<?php if (isset($_SESSION['alerta_ordem_aula']) && !empty($_SESSION['alerta_ordem_aula'])) {
  echo $_SESSION['alerta_ordem_aula'];
 unset($_SESSION['alerta_ordem_aula']);
 } ?>
  <div id="loading" class="alert alert-info text-center" role="alert">
<i class="fa fa-refresh fa-spin fa-2x fa-fw"></i> 
<span>Carregando...</span>
</div>
<?php foreach($modulos as $modulo): ?>
	<ul class="list-group mb-3 aula_sortable">
  <li class="list-group-item active list-group-green">
  <?php echo $modulo['nome']; ?>
  <a data-toggle="tooltip" title="Deletar" onclick="return confirmDelete()" class="btn btn-outline-danger pull-right" 
  href="<?php echo BASE; ?>admin/cursos/deletar_modulo/<?php echo $modulo['id']; ?>">
  <i class="fa fa-trash" aria-hidden="true"></i></a>
  <a data-toggle="tooltip" title="Editar" class="btn btn-secondary pull-right mr-3" href="<?php echo BASE; ?>admin/cursos/editar_modulo/<?php echo $modulo['id']; ?>">
  <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
  </li>
  <?php foreach($modulo['aulas'] as $aula): ?>
  <li data-id="<?php echo $aula['id']; ?>"
  class="list-group-item list-group-item-success"><!--   all-scroll -->
  <input class="id_aula" type="hidden" value="<?php echo $aula['id']; ?>" />
  <?php echo $aula['atividade'] == '1' ? '<b class="text-primary">Atividade</b>' : ''; ?>
  <?php echo $aula['midia'] == 'arquivo' ? '<b class="text-danger">PDF</b>' : ''; ?>
  <?php echo $this->limitarTexto($this->parse($aula['nome']), 150); ?> 
	<a data-toggle="tooltip" title="Deletar" onclick="return confirmDelete()" class="btn btn-outline-danger pull-right" href="<?php echo BASE; ?>admin/cursos/deletar_aula/<?php echo $aula['id']; ?>">
	<i class="fa fa-trash" aria-hidden="true"></i></a>
	<a data-toggle="tooltip" title="Editar <?php echo $aula['atividade'] == '1' ? 'Atividade' :  $this->aulaTooltip($aula['midia']); ?>" 
  class="pull-right mr-3 btn btn-<?php echo $aula['atividade'] == '1' ? 'primary' : $this->aulaColor($aula['midia']); ?>" 
  href="<?php echo BASE; ?>admin/cursos/editar_curso_aula/<?php echo $aula['id']; ?>">
  <?php echo $this->aulaButton($aula['midia']); ?>
  </a>

	</li>	
	<?php endforeach; ?>
	</ul>
<?php endforeach; ?>

</div>

<script>
$(document).ready(function() {

  CKEDITOR.replace('aula');

    $('#modulo').on('input', function() {
        $('textarea[name="aula"]').prop('disabled', $(this).val().length > 0);
        $('#moduloaula').prop('disabled', $(this).val().length > 0);
        $('#tipo').prop('disabled', $(this).val().length > 0);
        $('#btn-aula').prop('disabled', $(this).val().length > 0);
    });

    $('#aula').on('input', function() {
        $('#modulo').prop('disabled', $(this).val().length > 0);
        $('#btn-modulo').prop('disabled', $(this).val().length > 0);
    });

    $(function () {
      $(".aula_sortabl").sortable({
          items : ':not(.active)'
        });
      $(".aula_sortabl").sortable({
        update: function (event, ui) {
          var id_aula = $("input.id_aula").val();
          var ordem = new Array();
          $('.aula_sortabl li.all-scroll').each(function() {
            ordem.push($(this).attr("data-id"));
            $("#loading").show();
          });
        $.ajax({
          url: "<?php echo BASE; ?>admin/cursos/update_ordem_aula",
          method: "POST",
          data: {
            ordem: ordem,
            id_aula: id_aula
          },
          success: function(data) {
            console.log("Ordem gravada com sucesso!");
            $("#loading").hide();
          }   
        })
      }
    });
  });
});
</script>