<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Alunos extends CI_Model {

	// FUNÇÃO CADASTRO DE EMAIL PARA NOTIFICAÇÕES

	public function cadastrarEmail($nome,$email,$instituicao){
		$id = $this->buscarId($instituicao);
		$sql = "INSERT INTO email SET nome = '$nome', email = '$email', id_instituicao = '$id'";
		$this->db->query($sql);
	}

	/*public function atualizarEmail($nome,$email,$instituicao){
		$id = $this->buscarId($instituicao);
		$sql = "UPDATE email SET nome = '$nome', email = '$email', id_instituicao = '$id' WHERE email = '$email'";
		$this->db->query($sql);
	}
	*/

	/* FIM DOS EMAILS */ 


	public function verificarEmail($email,$instituicao) {
		$id = $this->buscarId($instituicao);
		$sql = "SELECT * from email WHERE email = '$email' AND id_instituicao = '$id'";
		$sql = $this->db->query($sql);
			if($sql->num_rows() > 0) {
				return $sql->result_array();
			} else {
				return false;
			}
	} 

	public function getInstituicoes() {
		$array = array();
		$sql = "SELECT * FROM instituicao";

		$sql = $this->db->query($sql);
		  if($sql->num_rows() > 0) {
		  	$array = $sql->result_array();
		  }
		  return $array;
	}

	public function buscarAtualizacao($instituicao){
		$sql = "SELECT uptime FROM instituicao WHERE nome = '$instituicao'";
		$sql = $this->db->query($sql);
		$sql = $sql->row_array();
		return $sql['uptime'];
		
	}

	public function buscarAlunos($instituicao){
		
		$sql = "SELECT id FROM instituicao WHERE nome = '$instituicao' ";
		$sql = $this->db->query($sql);
		if ($sql->num_rows()>0) {
			$sql = $sql->row_array();
			$id = $sql['id'];

			$sql = "SELECT * FROM lista WHERE id_instituicao = '$id' AND status = '1'";
			$sql = $this->db->query($sql);
			return $sql->result_array();
		}	 
		
	}

	// BUSCAR O ID DA INSTITUICAO PELO NOME

	public function buscarId($inst){
		$sql = "SELECT id FROM instituicao WHERE nome = '$inst'";
		$sql = $this->db->query($sql);
		$sql = $sql->row_array();
		return  $sql['id'];
		$id_inst = $this->buscarId($inst);
	}

	public function carregarDados($alunos,$inst){
		$id_inst = $this->buscarId($inst);

		$sql = "SELECT cpf,rg,data_nascimento FROM lista WHERE nome = '$alunos' AND id_instituicao = '$id_inst'";
		$sql = $this->db->query($sql);
		if ($sql->num_rows()>0) {
			return $sql->row_array();

	
		}	 
	}

	// CONSULTA ESPECÍFICA 


	public function consultaEspecifica($cpf,$matricula){
	
		$sql = "SELECT *,(select instituicao.nome from instituicao where lista.id_instituicao = instituicao.id) as instituicao FROM lista  ";

		if ($cpf !== NULL) {
			$sql.= " WHERE cpf = '$cpf' ";
		} else {
			$sql.= " WHERE matricula = '$matricula' ";
		}

		$sql.= " AND status = '1' ";

		$sql = $this->db->query($sql);
		if ($sql->num_rows() == 1) {
			return $sql->row_array();
		} elseif($sql->num_rows() > 1){
			return 'duplicado';
		} elseif($sql->num_rows() == 0){
			return false;
		}

		
	}


	/* ================================================ AUTENTICANDO O ALUNO ==========================================================*/

	public function autenticar($dados) {

		if(strpos($dados['documento'],'/') !=0){
					$data = implode("-",array_reverse(explode("/",$dados['documento'])));
		}

		$sql = "SELECT curso, matricula FROM lista WHERE (nome = '".$dados["nome"]."') AND (cpf = '".$dados['documento']."'  OR rg = '".$dados['documento']."' 
		";
		if (isset($data) && !empty($data)) {
		$sql.= " OR data_nascimento = '".$data."'";

		}

		$sql.= ")";

		$sql = $this->db->query($sql);
		if ($sql->num_rows() > 0) {
			return $sql->row_array();
		} 
		return false;
	}
	

}


/* End of file Alunos.php */
/* Location: ./application/models/Alunos.php */