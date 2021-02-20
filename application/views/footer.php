
<footer class="row">
			<div class="container">
			<hr>
			<a href="javascript:alert('Contato: atendimento@mjddev.com.br')" class="mjd" >DESENVOLVIDO PELA MJD DESENVOLVIMENTO</a>
			<div class="mjd">MJD © 2019</div>	
			</div>
		</footer>
		
		

		<!-- JQUERY 3.3.1 // POPPER // BOOTSTRAP JS -->
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-3.3.1.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/popper.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

		<!-- AUTO COMPLETE -->
		<script src="<?php echo base_url();?>assets/js/jquery.autocomplete.js"></script>

	<!-- JQUERY MASK PLUGIN -->
		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.mask.js');?>"></script>
	


		<!-- SCRIPT AUTO COMPLETE -->

		<script>
			var url = $('body').attr('data-url');
	
			var states = <?php echo json_encode($instituicoes); ?>

			$(function(){

				var url = $('body').attr('data-url');
				
				$(function(){
				  $("#instituicao").autocomplete({
				    source:[states]
				  }); 
				});
		    });

		   $('#instituicao').change(function(){
		  	
			   		var inst = $('#instituicao').val();

			   		$.ajax({
			   			method:'POST',
			  		 	url:url+'buscaralunos',
			  		 	dataType:'JSON',
			  		 	data: {inst:inst},
			  		 	beforeSend: function(){
							$('#inputNome').val('');
			  		 	},
			  		 	success: function(json){
			  		 	var alunos = json;

			  		 	$('#inputNome').remove();

			  		 	// insere ele depois do label que está antes do nome só isso // ta tranquilo mano, o brother ja entendeu , ficou filé !
			  		 	$('label[for="inputNome"]').after('<input id="inputNome" type="text" onchange="definirDados(this);" class="form-control" name="nome" placeholder="Informe seu nome" required>');
						  $('#inputNome').autocomplete({
						    source:alunos
						 })
			  		 	}
			  	     });

		   	});
		   
			
		</script>



		<!-- SCRIPT DO SISTEMA -->
		<script src="<?php echo base_url();?>assets/js/script.js"></script>

		
		<script>
	
			$(function(){
				if (location.protocol != 'https:')
					{
					 location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
					}
			});
		</script>

	</body>
</html>