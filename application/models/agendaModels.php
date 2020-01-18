<?php

	class agendaModels extends CI_Model{
    function __construct(){
		  parent::__construct();
    }
    
	
	

	function update($nome,$telefone,$email,$cep,$numero,$logradouro,$bairro,$cidade,$uf,$id_contato){
			
			return $this->db->query("UPDATE `contato` 
									SET `nome`='$nome',
									`telefone`='$telefone',
									`email`='$email',
									`cep`='$cep',
									`logradouro`='$logradouro',
									`numero`= '$numero',
									`bairro`= '$bairro',
									`cidade`= '$cidade',
									`uf`= '$uf' 
									WHERE id_contato = '$id_contato'");
	}

	
 }






?>