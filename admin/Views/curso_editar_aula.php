<div class="container mt-3">
<h3><a class="btn btn-success" href="<?= BASE; ?>admin/cursos/aulas/<?php echo $aula['id_curso']; ?>" role="button">
<i class="fa fa-arrow-left" aria-hidden="true"></i>
</a>
Editar: <?php echo $this->parse($aula['nome']); ?> </h3> <hr>

<?php if (isset($_SESSION['alerta_editar_aula']) && !empty($_SESSION['alerta_editar_aula'])) {
  echo $_SESSION['alerta_editar_aula'];
 unset($_SESSION['alerta_editar_aula']);
 } ?>

<form method="POST" enctype="multipart/form-data" autocomplete="off">

  <div class="form-group">
    <label for="aula">Tema de Parte</label>
    <textarea class="form-control" name="nome" id="nome" rows="3"><?php echo $aula['nome']; ?></textarea> 
  </div>
  <div class="form-row">
      <div class="form-group col-md-4">
<label for="tipo">Tipo de Mídia</label>
	<select class="form-control" name="midia" id="midia">
    <option value="">Sem Mídia</option>
        <option <?php echo $aula['midia'] == 'video' ? 'selected' : ''; ?> value="video" name="video">Vídeo</option>
			<option <?php echo $aula['midia'] == 'arquivo' ? 'selected' : ''; ?> value="arquivo" name="arquivo">PDF</option>
			<option <?php echo $aula['midia'] == 'imagem' ? 'selected' : ''; ?> value="imagem" name="imagem">Imagem</option>	
	</select>
</div> 
<div class="form-group col-md-4">
<label for="tipo">Atividade</label>
	<select class="form-control" name="atividade" id="atividade">
        <option <?php echo $aula['atividade'] == '0' ? 'selected' : ''; ?> value="0" name="atividade">Não</option>
			<option <?php echo $aula['atividade'] == '1' ? 'selected' : ''; ?> value="1" name="atividade">Sim</option>
		</select>
</div> 
</div>
  <div class="form-group video opcao">
<label for="video">URL do Vídeo (YouTube)</label>
 <input type="text" class="form-control" name="url_video" placeholder="https://youtu.be/codigo" value="<?php echo $aula['url_video']; ?>" />
<?php if(!empty($aula['url_video'])): ?> 
    <iframe class="embed-responsive-item mt-3" src="<?php echo $aula['url_video']; ?>" frameborder="0" allowfullscreen></iframe>
    <?php endif; ?> 
    </div>
    <div class="form-group arquivo opcao">
<label for="arquivo">Inserir Arquivo (PDF)</label>
 <input type="file" class="form-control" name="pdf" />
 <?php if(!empty($aula['arquivo'])): ?> 
    <iframe src="<?php echo BASE .'assets/uploads/'. $aula['arquivo']; ?>" style="width:100%; height:700px;" class="mt-3" frameborder="0"></iframe>
    <?php endif; ?>
    </div>
    <div class="form-group imagem opcao">
<label for="imagem">Inserir Imagem</label>
 <input type="file" class="form-control" name="imagem" />
 <?php if(!empty($aula['imagem'])): ?> 
    <img class="col-md-4 img-thumbnail mt-3" src="<?php echo BASE .'assets/uploads/'. $aula['imagem']; ?>" />
    <?php endif; ?> 
    </div>
  <input type="submit" class="btn btn-success" id="btn-modulo" value="Atualizar Parte" />
</form>  
 </div>

 <script>
     $(document).ready(function () {

        CKEDITOR.replace('nome');

        $("#midia").change(function () {
             
             $(this).find("option:selected").each(function () {
                
                 if ($(this).attr("value") === "video") {   
                     $(".arquivo").hide(); 
                     $(".imagem").hide();         
                     $(".opcao").not(".video").hide();
                     $(".video").show();
                 }
                 else if ($(this).attr("value") === "arquivo") { 
                     $(".video").hide(); 
                     $(".imagem").hide(); 
                     $(".opcao").not(".arquivo").hide();
                     $(".arquivo").show();                
                 }
                 else if ($(this).attr("value") === "imagem") { 
                      $(".arquivo").hide(); 
                      $(".video").hide();  
                      $(".opcao").not(".imagem").hide();
                     $(".imagem").show();                
                 }
                 else {
                    $(".arquivo").hide(); 
                      $(".video").hide();  
                     $(".imagem").hide();   
                 }
             });
         }).change();
    });
 </script>