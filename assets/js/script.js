
$(function(){

	$('#consulta_cpf').mask('000.000.000-00');
});


/*

	 FUNÇÃO PRA PEGAR A ÚLTIMA ATUALZAÇÃO NO BANCO DE DADOS
*/

var url = $('body').attr('data-url');

$('#instituicao').bind('change',function(){
	
		var instituicao = $('#instituicao').val();

	$.ajax({
		url:url+'home/buscarAtualizacao',
		method:'POST',
		data: {instituicao:instituicao},

		success: function(html){
			$('#atualizacao').val(html);
		}
	});
});




/* FUNÇÃO PRA PEGAR OS DADOS DO ALUNO  */

function definirDados(obj){
	

	var aluno= $(obj).val();
	var instituicao = $('#instituicao').val();

		$.ajax({
			method: 'POST',
			dataType:"JSON",
			url: url+'carregardados',
			data:{aluno:aluno,inst:instituicao},
			success: function(json){

				var html = '';
					html += '<option value="">Escolha uma Opção:</option>';
				
				if (json.cpf === true) {
					html += '<option  value="1">CPF</option>';
				}
				if (json.rg === true) {
					html += '<option value="2">RG</option>';
				}
				if (json.dn === true) {
					html += '<option value="3">DATA DE NASCIMENTO</option>';
				}
				


				$('#selectDocumentos').html(html);

			}
		});
}

$('#selectDocumentos').on('change',function(){
	var obj = $(this);
	definirDocumento(obj);
});


function definirDocumento(obj){
	$("#documento").val('');

	if ($(obj).val() == '1') {
		$('#documento').mask('000.000.000-00');
		
	}
	if ($(obj).val() == '2') {
		$('#documento').unmask();
	}

	else if ($(obj).val() == '3') {
		$('#documento').mask('00/00/0000');
	} 

};


function relatorioSucesso() {
	alert("Relatório Gerado com Sucesso!");
}









