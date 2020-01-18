<?php $this->load->view("header.php"); ?>


<script>
  
  function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('Logradouro').value=("");
            document.getElementById('Bairro').value=("");
            document.getElementById('Cidade').value=("");
            document.getElementById('UF').value=("");
          
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
			
            //Atualiza os campos com os valores.
            document.getElementById('Logradouro').value=(conteudo.logradouro);
            document.getElementById('Bairro').value=(conteudo.bairro);
            document.getElementById('Cidade').value=(conteudo.cidade);
            document.getElementById('UF').value=(conteudo.uf);
            
        } //end if.
        else {
            //CEP não Encontrado.
            // limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace("-","");
		
        //Verifica se campo cep possui valor informado.
        if (cep != "") {
		
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('Logradouro').value=("...");
                document.getElementById('Bairro').value=("...");
				document.getElementById('Cidade').value=("...");
                document.getElementById('UF').value=("...");
                // document.getElementById('ibge').value=("...");

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                urlStr = 'https://viacep.com.br/ws/'+ cep + '/json/';

                $.ajax({
					url: urlStr,
					type: "get",
					dataType: "json",
					success: function(data){
						console.log(data);

						document.getElementById('Logradouro').value=(data.logradouro);
						document.getElementById('Bairro').value=(data.bairro);
						document.getElementById('Cidade').value=(data.localidade);
						document.getElementById('UF').value=(data.uf);
						
          			
					},
					error: function(error){
						console.log(error);
					}
				})
				
				
				//Insere script no documento e carrega o conteúdo.
				//  document.body.appendChild(data);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };
    
    
    </script>

<div class="container" style="background-color:#F0FFF0; padding:40px;">
    <a class="btn btn-primary" href="<?php echo base_url();?>Home" role="button">Voltar</a>

    
    <?php if(isset($msgAlert)): echo  $msgAlert; endif?>

    <h2>ATUALIZAR CONTATO</h2><hr>
	<form action="<?php echo base_url();?>/Home/UpdateContato" method="post" class="border border-dark alert-primary" enctype="multipart/form-data" >
		
				
                            <input type="hidden" name="id_contato" id="id_contato" value="<?= $contato[0]->id_contato?>" >
							<label for="Nome">Nome:</label>
							<input type="text"  class="form-control" name="Nome" id="Nome"  value="<?= $contato[0]->nome?>"  >
							
							<label for="telefone">Telefone:</label>
                            <input type="text" placeholder="(092)99999-9999" class="form-control" id="telefone" name="telefone"  value="<?= $contato[0]->telefone?>"  maxlength="14">
                            
                            <label for="email">Email:</label>
							<input type="text" placeholder="teste@teste.com" class="form-control" id="email" name="email" value="<?= $contato[0]->email?>">
										
							<label for="cep">Cep:</label>
							<input type="text" class="form-control" name="cep" id="cep" onblur="pesquisacep(this.value)" value="<?= $contato[0]->cep?>" >

							<label for="Logradouro">Logradouro:</label>
							<input type="text"  class="form-control" name="Logradouro" id="Logradouro" value="<?= $contato[0]->logradouro?>">
					
							<label for="Numero">Numero:</label>
							<input type="text" class="form-control" name="Numero" id="Numero" value="<?= $contato[0]->numero?>" >
			
							<label for="Bairro">Bairro:</label>
							<input type="text"  class="form-control" name="Bairro" id="Bairro" value="<?= $contato[0]->bairro?>">
						
							<label for="Cidade">Cidade:</label><br>
							<input type="text" name="Cidade" id="Cidade"  class="form-control" value="<?= $contato[0]->cidade?>">
			
							<label for="UF">UF:</label><br>
							<input type="text" name="UF" id="UF"  class="form-control" value="<?= $contato[0]->uf?>">

                            <label for="imagem">Imagem:</label>
                            <input type="file" name="imagem"/>
			
							<button type="submit" name="Submit" class="btn btn-dark" style=" float:right;margin-top: 20px; background-color:#87CEEB;">Atualizar</button>

	</form>		
	

</div>

<?php $this->load->view("footer.php"); ?>