<section>
	<div class="container">
		<div class="sistema_titulo text-center">
				<h1 class="">Consulta De Lista Estudantil Camaçari Card</h1>
		</div> <br/>
			<div class="sistema_formulario_busca p-5">
					<h3 class="text-center">Cadastre Seu E-mail Para Ser Notificado</h3><br/>
				<form method="POST">

					<?php if (isset($email['success']) && !empty($email['success'])): ?>
						<div class="alert alert-success"><?php echo $email['success']; ?></div>
					<?php endif ?>


					<?php if (isset($email['error']) && !empty($email['error'])): ?>
						<div class="alert alert-danger"><?php echo $email['error']; ?></div>
					<?php endif ?>

						<div class="form-row">
							<div class="form-group col-md-8">
								<label for="inputEmail4">Instituição de Ensino</label>
								<input type="text" class="form-control" id="instituicao" name="instituicao" placeholder="Informe sua Instituição" required>
								
							</div>

							<div class="form-group col-md-3">
								<label for="inputPassword4">Última Atualização</label>
								<input type="text" id="atualizacao" disabled class="form-control" id="inputPassword4" placeholder="" readonly="true">
							</div>

							<div class="form-group col-md-2">
								<label for="inputAddress">Nome:</label>
								<input type="text" class="form-control" placeholder="Informe seu nome" name="nome" required>
				  			</div>

							<div class="form-group col-md-4">
								<label for="inputAddress">E-mail:</label>
								<input type="email" class="form-control"  placeholder="Informe seu email" name="email" required>
				  			</div>

						</div>

							<div class="form-check">
        						<input class="form-check-input" type="checkbox" id="gridCheck1" required>
        						<label class="form-check-label" for="gridCheck1"><p class="text-primary">
								Desejo Receber Notificações Sobre Listas Atualizadas</p></label>
      						</div><br/>

							<div class="form-row">
				  				<button type="submit" class="form_botao btn btn-outline-warning">Cadastre-se</button>
							</div>
				</form>

			</div>
	</div>

</section>
