<?php

	class agendaModels extends CI_Model{
    function __construct(){
		  parent::__construct();
    }
	
	
	
	function cadastro_contato($nome,$telefone,$email,$cep,$numero,$logradouro,$bairro,$cidade,$uf,$novo_nomeCod){
        return $this->db->query("INSERT INTO contato(nome,
													telefone,
													email,
													cep,
													logradouro,
													numero,
													bairro,
													cidade,
													uf,
													foto,
													data_cadastro) 
								VALUES(	'$nome',
										'$telefone',
										'$email',
										'$cep',
										'$numero',
										'$logradouro',
										'$bairro',
										'$cidade',
										'$uf',
										'$novo_nomeCod',
										NOW())
								");
    }
	
	

	function update($nome,$telefone,$email,$cep,$numero,$logradouro,$bairro,$cidade,$uf,$novo_nomeCod,$id_contato){
			
			return $this->db->query("UPDATE `contato` 
									SET `nome`='$nome',
									`telefone`='$telefone',
									`email`='$email',
									`cep`='$cep',
									`logradouro`='$logradouro',
									`numero`= '$numero',
									`bairro`= '$bairro',
									`cidade`= '$cidade',
									`uf`= '$uf',
									foto = '$novo_nomeCod',
									`data_atualizacao` = NOW()
									WHERE id_contato = '$id_contato'");
	}

	
 }






?>