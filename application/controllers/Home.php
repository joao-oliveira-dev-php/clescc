<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->library('email');
		$this->load->library('pdf');
	}




	 public function index() {
        $data = array();

    	$instituicoes = $this->Alunos->getInstituicoes();

	    foreach ($instituicoes as $instituicao) {
	    	$data['instituicoes'][] = $instituicao['nome'];
	    }

	    
	    	if (!empty($_POST['instituicao'])) {
	    	

		  		$dados = array(
		  			'instituicao' => (!empty($_POST['instituicao'])
								?addslashes($_POST['instituicao']):NULL),
		  			'nome' => (!empty($_POST['nome'])?addslashes($_POST['nome']):NULL),
		  			'documento' => (!empty($_POST['info'])?addslashes($_POST['info']):NULL),
		  			'atendimento' => (!empty($_POST['atendimento'])?addslashes($_POST['atendimento']):NULL),
		  			'autenticidade' => md5(time().rand(0,999))
		  		);

		  		$auth = $this->Alunos->autenticar($dados);

		  			if($auth !== false) {
		  				$dados['matricula'] = $auth['matricula'];
		  				$dados['curso'] = $auth['curso'];

			  			$_SESSION['data'] = $dados;
			  			$_SESSION['success'] = "Re3atório gerado com sucesso!
			  			";
			  			

			  			redirect('home/gerarRelatorio');
			  			

		  			} else {
		  				$data['erro'] = "Documento Inválido!";
		  			}

	 	 	}

	 	 	if ((isset($_POST['especifica_cpf']) && !empty($_POST['especifica_cpf'])) || (isset($_POST['especifica_matricula']) && !empty($_POST['especifica_matricula']))) {

	 	 		$data = array();

	 	 		$cpf = null;
	 	 		$matricula = null;

	 	 		if (isset($_POST['especifica_cpf']) && !empty($_POST['especifica_cpf'])) {
	 	 			$cpf = addslashes($_POST['especifica_cpf']);
	 	 		} else {
	 	 			$matricula = addslashes($_POST['especifica_matricula']);
	 	 		}
	 	 		

	 			$retorno = $this->Alunos->consultaEspecifica($cpf,$matricula);
	 			

	 			if (is_array($retorno)) {

	 				$retorno['autenticidade'] = md5(time().rand(0,999));
	 				$retorno['especifica'] = true;

	 				$_SESSION['data'] = $retorno;

			  		redirect(base_url('gerarrelatorio'));

	 			} elseif ($retorno == 'duplicado') {
	 				$data['erro'] = "Matricula duplicada, favor entrar em contato no e-mail: escolas2@camacaricard.com";
	 				unset($_SESSION['success']);
	 			}
	 			 elseif($retorno == false) {
	 			 	$data['erro'] = "CPF invalido ou Matricula inexistente!";
	 			 	unset($_SESSION['success']);
	 			}

	 	 		
	 	 		
	 	 	}

	        
	        $this->load->view('header', $data);
	        $this->load->view('home', $data);
	        $this->load->view('footer', $data);

	  }

	  public function gerarRelatorio() {


	  	if(isset($_SESSION['data']) &&!empty($_SESSION['data'])) {

	  		$data = $_SESSION['data'];


			$this->dompdf->output(['isRemoteEnabled' => true]);

	  		$this->load->view('relatorio',$data);


			// Get output html
			$html = $this->output->get_output();
		
			// Load HTML content
			$this->dompdf->loadHtml($html);
		
			// (Optional) Setup the paper size and orientation
			$this->dompdf->setPaper('A4', 'portrait');
		
			// Render the HTML as PDF
			$this->dompdf->render();
		
			// Output the generated PDF (1 = download and 0 = preview)
			$this->dompdf->stream(md5(time().rand(0,9999)).".pdf");

	  	}
	  	


	  }


	  /* FUNÇÃO DE NOTIFICÃO VIA EMAIL */

	  public function notificacao(){

	    $data = array();

    	$instituicoes = $this->Alunos->getInstituicoes();

	    foreach ($instituicoes as $instituicao) {
	    	$data['instituicoes'][] = $instituicao['nome'];
	    }

	        if(isset($_POST['email']) && !empty($_POST['email'])) {

	        	$email  = addslashes($_POST['email']);
	        	$nome = addslashes($_POST['nome']);
	        	$instituicao = addslashes($_POST['instituicao']);



	        	if (!$this->Alunos->verificarEmail($email,$instituicao)) {
	        		/*
	        		
	        	$this->email->from('email@email.com', 'Name');
	        	$this->email->to('someone@example.com');  
	        	
	        	$this->email->subject('subject');
	        	$this->email->message('message');
	        	
	        	$this->email->send();
	        	*/

	        	$this->Alunos->cadastrarEmail($nome,$email,$instituicao);
	        	
	        	$data['email']['success'] = "Email cadastrado com sucesso! Você será notificado.";
	        	} else {

	        		//$this->Alunos->atualizarEmail($nome,$email,$instituicao);
	        		$data['email']['error'] = "Email já cadastrado!";
	        	}

	        }

	        

	        $this->load->view('header', $data);
	        $this->load->view('notificacao', $data);
	        $this->load->view('footer', $data);

	    }


		// FUNÇÃO PRA BUSCAR ATUALIZAÇÃO DA INSTITUICAO

		public function buscarAtualizacao(){
			if (isset($_POST['instituicao']) && !empty($_POST['instituicao'])) {
				$instituicao = addslashes($_POST['instituicao']);
				$data = $this->Alunos->buscarAtualizacao($instituicao);

				if ($data) {
					echo date("d/m/Y H:i:s", strtotime($data));	
				}
			}
		}

		// FUNÇÃO QUE BUSCA OS ALUNOS  PELA INSTITUIÇÃO
		public function buscarAlunos(){
			
			if (isset($_POST['inst']) && !empty($_POST['inst'])) {

				$instituicao = addslashes($_POST['inst']);
				$data = $this->Alunos->buscarAlunos($instituicao);


				if ($data) {
					foreach ($data as $a) {
						$alunos[] = array($a['nome']);
					}

					echo json_encode($alunos);
				}


			}

		}
		// FUNÇÃO PRA PEGAR OS DADOS PESSOAIS DISPONÍVEIS  PRA CARREGÁ-LOS NOS CAMPOS

		public function carregarDados(){

			if(isset($_POST['aluno']) && !empty($_POST['aluno']) && isset($_POST['inst']) && !empty($_POST['inst'])) {

				$aluno = addslashes($_POST['aluno']);
				$inst = addslashes($_POST['inst']);

				$dados = $this->Alunos->carregarDados($aluno,$inst);

				$dados = array(
				'cpf' => (isset($dados['cpf']) && !empty($dados['cpf']))?true:false,
				'rg' => (isset($dados['rg']) && !empty($dados['rg']))?true:false,
				'dn' => (isset($dados['data_nascimento']) && !empty($dados['data_nascimento']))?true:false
				);

				echo json_encode($dados);

				
				$dados = array('cpf' => (isset($dados['cpf']) && !empty($dados['cpf'])));


			}
		}

		

		  

}
