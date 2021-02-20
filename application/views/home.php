<section id="sistema">
	<div class="container ">
		<div class="sistema_titulo text-center">
			<h1 class="">Consulta De Lista Estudantil Camaçari Card</h1>
		</div><br/>

		<div class="sistema_formulario_busca p-5">
			<form method="POST">
				<h3 class="text-center">Consulta Por Instituição</h3><br/>

				<?php if (isset($erro) && !empty($erro)): ?>
					<div class="alert alert-danger"><?php echo $erro; ?></div>
				<?php endif; ?>


				<!--
			
				<?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])): ?>
					<div class="alert alert-success"><?php echo$_SESSION['success']; ?></div>
					<?php unset($_SESSION['success']); ?>
				<?php endif; ?> -->



			  <div class="form-row">
				    <div class="form-group col-md-8">
				      	<label for="instituicao">Instituição de Ensino</label>
				      	<input type="text" class="form-control" id="instituicao" name="instituicao" placeholder="Informe sua Instituição" required>
		
				    </div>

				    <div class="form-group col-md-3">
				      	<label for="inputPassword4">Última Atualização</label>
				      	<input type="text" class="form-control"  disabled id="atualizacao" placeholder="">
						</div>
					<div class="form-group col-md-8">
					    <label for="inputNome">Nome</label>
						<input id="inputNome" type="text"  class="form-control" name="nome" placeholder="Informe seu nome" required>
				  	</div>
				  <div class="nome_naoconsta align-self-center mt-lg-3 mt-md-3 ml-2 mb-2">
				 	 <!--<a class="text-warning" href="<?php echo base_url('notificacao');?>"> Seu nome não consta? Clique aqui.</a> -->
				  </div>
			  
			  </div>

  			<div class="form-row">
			    <div class="form-group col-md-4">
			      <label for="inputCity">Selecione</label>
			      <select id="selectDocumentos" name="documento" class="form-control" required>
			        <option value="">Escolha uma Opção:</option>
				  </select>
			    </div>
			    <div class="form-group col-md-4">
			      <label for="inputAddress">Informação Pessoal </label>
				  <input type="text" class="form-control" id="documento" name="info" placeholder="Informe seus dados.." required>
				</div>

				 <div class="form-group col-md-3">
			      <label for="inputCity">Tipo de Atendimento</label>
			      <select id="inputEstado" name="atendimento" class="form-control" required>
			        <option value="">Escolha uma Opção: </option>
					<option value="cadastro">CADASTRO</option>
					<option value="recadastramento">RECADASTRAMENTO</option>
				  </select>
			    </div>
	
			</div><br/>
			<div class="form-row">
				  <button type="submit" class="form_botao btn btn-outline-warning">Buscar</button>
			</div><br/>
			
		</form>

		<h3 class="text-center ">Consulta Específica</h3><br/>

		<div class="form-row">
			


		<form method="POST" class="form-row col-md-5">
			  
			    	<div class="mr-3">
			    	 	<label for="inputAddress">CPF</label>
			      	 	<input type="text" class="form-control" name="especifica_cpf" id="consulta_cpf" placeholder="Informe seu CPF" required>
			    	</div>

			    	<div class="mt-2">
			    		<label for="inputAddress"></label><br/>
			      		<button type="submit" class="form_botao btn btn-outline-warning mr-5">Buscar</button>
			    	</div>	
			</form>



		
					
		<form method="POST" class="form-row col-md-5">

			    	<div class="mr-3">
			    		<label for="inputAddress">Matricula</label>
			      		<input type="text" class="form-control" name="especifica_matricula"  placeholder="Informe sua Matricula" required>
			    	</div>

			    	<div class="mt-2 ">
			    	  	<label for="inputAddress"></label><br/>
			      		<button type="submit" class="form_botao btn btn-outline-warning">Buscar</button>
			    	</div>


		</form>

		</div>	


		
	
</section>



