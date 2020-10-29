<div class="container-fluid mt-3">
<?php require 'inc/aside.php'; ?>  
  <div class="col-sm-8">
  <h3><?php echo $parte_modulo['nome']; ?></h3>
  <?php if(!empty($parte_modulo['url_video'] && $parte_modulo['midia'] == 'video')): ?> 
  <div class="embed-responsive embed-responsive-16by9">
   <iframe class="embed-responsive-item" src="<?php echo $parte_modulo['url_video']; ?>" frameborder="0" allowfullscreen></iframe>
   </div>
   <?php endif; ?>
    <?php if(!empty($parte_modulo['arquivo'] && $parte_modulo['midia'] == 'arquivo')): ?> 
    <iframe src="<?php echo BASE .'assets/uploads/'. $parte_modulo['arquivo']; ?>" style="width:100%; height:700px;" class="mt-3" frameborder="0"></iframe>
    <?php endif; ?>
    <?php if(!empty($parte_modulo['imagem'] && $parte_modulo['midia'] == 'imagem')): ?> 
    <img class="img-fluid mt-3" src="<?php echo BASE .'assets/uploads/'. $parte_modulo['imagem']; ?>" />
    <?php endif; ?>
  </div>
</div>
</div>
