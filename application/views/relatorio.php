<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>::CLESCC::</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />


		<!-- BOOTSTRAP 4 -->
		<link rel="stylesheet" type="text/css" href="https://clescc.com.br/assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://clescc.com.br/assets/css/style.css">

		<link rel="icon" href="assets/images/miniatura.png" type="image/x-icon"/>
		<link rel="shortcut icon" href="https://clescc.com.br/assets/images/miniatura.png" type="image/x-icon" />

	</head>
	<body>

		<section class="section_relatorio" >
				<img src="https://clescc.com.br/assets/images/timbrado1.jpg" class="img_header">
						<!-- HTML QUE FICA COM AS INFORMAÇÕES DOS ALUNOS -->
					<div class="titulo_relatorio">
					<h4>RELATÓRIO CLESCC</h4>
					</div><br/><br/>

					<div class="row">
						<div class="text_relatorio ">
							<h6 ><strong>Instituição:</strong> <?php echo $instituicao; ?></h6> 
						</div>
					</div><br/>
					<div class="row">
						<div class="text_relatorio ">
							<h6 ><strong>Nome: </strong> <?php echo $nome; ?> </h6> 
						</div>

					</div><br/>
					<div class="row">
						<div class="text_relatorio ">
							<h6 ><strong>Matricula:</strong> <?php echo $matricula ?></h6> 
						</div>

					</div><br/>
					<div class="row">
						<div class="text_relatorio ">
							<h6 ><strong>Curso/Série:</strong> <?php echo $curso; ?></h6> 
						</div>

					</div><br/>

					<?php if (!isset($especifica) && empty($especifica)):?>


						<div class="row">
						<div class="text_relatorio ">
							<h6 ><strong>Tipo de atendimento:</strong> <?php echo strtoupper($atendimento);?></h6> 
						</div>

					</div><br/><br/>

						
					<?php endif; ?>
					
					<!-- LOGO DA MJD E CODIGO DE AUTENTICIDADE -->
					<div class="logo_mjd">
						<img src="https://clescc.com.br/assets/images/logo-2.png" class="">
					</div><br/>
					<div class="autenticidade_relatorio">
						<h5>CODIGO DE AUTENTICIDADE</h5>
						<div class="codigo_autenticador">
							<?php echo $autenticidade; ?>
						</div>
					</div>

					<div class="linha_autenticidade">
						<hr>
					</div>
					<div class="row ">
						<div class="titulo_cadastro">
							<h5>O QUE FAZER AGORA ?</h5>
						</div>
						<div class="emoticon_cadastro">
							<img src="https://clescc.com.br/assets/images/emoticon.png" class="">
						</div>
					</div><br/><br>
					
					<div class="img_fazer">
						<img src="https://clescc.com.br/assets/images/recad.png" >
					</div>

					<div class="observacao_relatorio">
						<strong>*EM CASO DE CADASTRO TODOS OS DOCUMENTOS SUPRACITADOS DEVEM SER ORIGINAIS E XEROX, NO CASO DE RECADASTRAMENTO DEVE SER SOMENTE DOCUMENTOS ORIGINAIS.</strong>
					</div>
					<img src="https://clescc.com.br/assets/images/timbrado2.jpg" class="img_footer">
		</section>
</body>
</html>
<script>

	$(function(){
		 location.reload();
	});
</script>


