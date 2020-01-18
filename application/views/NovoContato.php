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

    <h2>NOVO CONTATO</h2><hr>
	<form action="<?php echo base_url();?>index.php/Home/CadastarContato" method="post" class="border border-dark alert-primary" enctype="multipart/form-data" >
		
				
                            

							<label>Nome:</label>
							<input type="text"  class="form-control" name="nome" >
							
							<label for="telefone">Telefone:</label>
                            <input type="text" placeholder="(092)99999-9999" class="form-control" id="telefone" name="telefone"  maxlength="14" >
                            
                            <label >Email:</label>
							<input type="text" placeholder="teste@teste.com" class="form-control" name="email" value="">
										
							<label for="cep">Cep:</label>
							<input type="text" class="form-control" name="cep" onblur="pesquisacep(this.value)" >

							<label for="Logradouro">Logradouro:</label>
							<input type="text"  class="form-control" name="Logradouro" id="Logradouro">
					
							<label for="Numero">Numero:</label>
							<input type="text" class="form-control" name="Numero" id="Numero"  >
			
							<label for="Bairro">Bairro:</label>
							<input type="text"  class="form-control" name="Bairro" id="Bairro">
						
							<label for="Cidade">Cidade:</label><br>
							<input type="text" name="Cidade" id="Cidade"  class="form-control" >
			
							<label for="UF">UF:</label><br>
							<input type="text" name="UF" id="UF"  class="form-control" >

                            <label for="imagem">Imagem:</label>
                            <input type="file" name="imagem"/>
			
							<button type="submit" name="Submit" class="btn btn-dark" style=" float:right;margin-top: 20px; background-color:#87CEEB;">Salvar</button>

	</form>		
	

</div>
