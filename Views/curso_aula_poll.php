<div class="container mt-3">
<?php require 'inc/aside.php'; ?>  
  <div class="col-sm-8">
  <h3>Questionário</h3>

  <div class="card">
  <h5 class="card-header"><?php echo $aula_info['pergunta']; ?></h5>
  <div class="card-body"> 
	<form method="POST">
	<div class="form-check mb-3">
		<input style="cursor:pointer" class="form-check-input" type="radio" name="opcao" value="1" id="opcao1" />
		<label style="cursor:pointer" for="opcao1"><?php echo $aula_info['opcao1']; ?></label>
	</div>
	<div class="form-check mb-3" style="cursor:pointer">
		<input style="cursor:pointer" class="form-check-input" type="radio" name="opcao" value="2" id="opcao2" />
		<label style="cursor:pointer" for="opcao2"><?php echo $aula_info['opcao2']; ?></label>
    </div>
	<div class="form-check mb-3">
		<input style="cursor:pointer" class="form-check-input" type="radio" name="opcao" value="3" id="opcao3" />
		<label style="cursor:pointer" for="opcao3"><?php echo $aula_info['opcao3']; ?></label>
		</div>
	<div class="form-check mb-3">
		<input style="cursor:pointer" class="form-check-input" type="radio" name="opcao" value="4" id="opcao4" />
		<label style="cursor:pointer" for="opcao4"><?php echo $aula_info['opcao4']; ?></label>
    </div>
		<?php if($aula_info['assistido'] == '1'): ?>
			Este questionário já foi respondido!
		<?php else: ?>
			<input class="btn btn-primary" type="submit" value="Enviar Resposta" />
		<?php endif; ?>
	</form>
	<?php
	if(isset($resposta)) {
		if($resposta === true) {
			echo "RESPOSTA CORRETA!";
		} else {
			echo "RESPOSTA INCORRETA!";
		}
	}
	?>
  </div>
</div>

  </div>
</div>
</div>
