<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('agendaModels');
		$this->load->database();
		$this->load->helper('url','form', 'file','form_validation');
		
		
	}

	
	public function index()
	{
		 
		$this->db->select('*');
		$data['contato'] = $this->db->get('contato')->result();
		
		$this->load->view('Agenda',$data);
		//$this->load->view('Agenda');
		
	}


	
	
	
	
	public function ExcluirContato($id=null){
		$this->db->where('id_contato',$id);
		$res = $this->db->delete('contato');
		if($res){
			$dados['msgAlert'] = "<div style='top:10px; width:100%' class='container alert alert-success' role='alert'>
								  Registro excluido com sucesso!  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								  <span aria-hidden='true'>&times;</span>
								  </button></div>";
			
			 
			$this->db->select('*');
			$dados['contato'] = $this->db->get('contato')->result();
		
			$this->load->view('Agenda',$dados);
         
		}else{
			$dados['msgAlert'] = "
						<div style='top:10px; width:100%' class='container alert alert-danger' role='alert'>
							Falha ao excluir registro!  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						 <span aria-hidden='true'>&times;</span>
					   </button></div>";
			
			 
			$this->db->select('*');
			$dados['contato'] = $this->db->get('contato')->result();
		
			$this->load->view('Agenda',$dados);
		}
	}

	


	public function NovoContato(){
		$this->load->view('NovoContato');
	}

	public function CadastarContato()
	{
		
		$dados['msgAlert'] = "";		
		
		
		
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nome','Nome', 'required');
			$this->form_validation->set_rules('telefone','Telefone', 'required|numeric');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('cep', 'cep', 'required');
			$this->form_validation->set_rules('Logradouro', 'Logradouro', 'required');
			$this->form_validation->set_rules('Numero', 'Numero', 'required');
			$this->form_validation->set_rules('Bairro', 'Bairro', 'required');
			$this->form_validation->set_rules('Cidade', 'Cidade', 'required');
			$this->form_validation->set_rules('UF', 'UF','required');	
	
			 if($this->form_validation->run() == TRUE){
				
				$data['nome'] = $this->input->post('nome');
				$data['telefone'] = $this->input->post('telefone');
				$data['email'] = $this->input->post('email');
				$data['cep'] = $this->input->post('cep');
				$data['numero'] = $this->input->post('Numero');
				$data['logradouro'] =	$this->input->post('Logradouro');
				$data['bairro'] = $this->input->post('Bairro');
				$data['cidade'] = $this->input->post('Cidade');
				$data['uf'] = $this->input->post('UF');
				//$data['foto'] = $this->input->post('imagem');
				$imagem = $_FILES['imagem'];
				$data['foto'] = $imagem['name'];
				$pasta = 'img';
		
				$res = $this->db->insert('contato',$data);
				
				if($res){
					$dados['msgAlert'] = "<div style='top:10px; width:100%' class='container alert alert-success' role='alert'>
						 Dados cadastrado com sucesso!  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						 <span aria-hidden='true'>&times;</span>
					   </button></div>";
				}else{
					$dados['msgAlert'] = "<div style='top:10px; width:100%' class='container alert alert-danger' role='alert'>
					Erro no cadastro de dados!  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
				  	</button></div>";
				}
				
				
			}else{
				$dados['msgAlert'] = "<div style='top:10px; width:100%' class='container alert alert-danger' role='alert'>
				Erro na validação!  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
			  </button></div>";
			}
			$this->load->view('NovoContato',$dados);
		
		
	}

	public function UpdateContato(){

				$dados['msgAlert'] = "";

				$id_contato = $this->input->post('id_contato');
				$nome = $this->input->post('Nome');
				$telefone = $this->input->post('telefone');
				$email = $this->input->post('email');
				$cep = $this->input->post('cep');
				$numero = $this->input->post('Numero');
				$logradouro =	$this->input->post('Logradouro');
				$bairro = $this->input->post('Bairro');
				$cidade = $this->input->post('Cidade');
				$uf = $this->input->post('UF');

				
				$res = $this->agendaModels->update($nome,$telefone,$email,$cep,$numero,$logradouro,$bairro,$cidade,$uf,$id_contato);
				
	
				if($res){
					$dados['msgAlert'] = "<div style='top:10px; width:100%' class='container alert alert-success' role='alert'>
						 Dados atualizado com sucesso!  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						 <span aria-hidden='true'>&times;</span>
					   </button></div>";
				}else{
					$dados['msgAlert'] = "<div style='top:10px; width:100%' class='container alert alert-danger' role='alert'>
					Erro na atualização de dados!  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
				  	</button></div>";
				}

				$this->db->where('id_contato',$id_contato);
				$dados['contato'] = $this->db->get('contato')->result();

				$this->load->view('AtualizarContato',$dados);

	}


	

	public function AtualizarContato($id=null){

		$this->db->where('id_contato',$id);
		$dados['contato'] = $this->db->get('contato')->result();

		$this->load->view('AtualizarContato',$dados);


	}



	


}