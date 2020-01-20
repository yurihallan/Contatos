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
        
    function pesquisacep() {
        var valor = document.getElementById("cep").value;

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
            /*<div style='top:10px; width:100%' class='container alert alert-danger' role='alert'>
				Erro na validação!  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
			  </button></div> */
            limpa_formulário_cep();
        }
    };


</script>

<div class="container" style="background-color:#F0FFF0; padding:40px;">
    <a class="btn btn-primary" href="<?php echo base_url();?>Home" role="button">Voltar</a>
    <?php if(isset($msgAlert)): echo  $msgAlert;  elseif(isset($mensagens)): echo "<div style='top:10px; width:100%' class='container alert alert-danger' role='alert'>
                                                                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                                                        <span aria-hidden='true'>&times;</span>
                                                                                        </button>
                                                                                        $mensagens  
                                                                                    </div> ";
    endif
    ?>

    <h2>NOVO CONTATO</h2><hr>
	<form action="<?php echo base_url();?>index.php/Home/CadastarContato" method="post" class="border border-dark alert-primary" enctype="multipart/form-data" >
		
				
                            

							<label>Nome:
							    <input type="text"  class="form-control" name="nome" >
                            </label>
							
							<label for="telefone">Telefone: 
                                <input type="text" placeholder="(92)99999-9999" class="form-control" id="telefone" name="telefone"  maxlength="14" " >
                            </label>
                            
                            <label >Email: 
							    <input type="text" placeholder="teste@teste.com" class="form-control" name="email" >
                            </label>
										
							<label for="cep">Cep:
							    <input type="text" class="form-control" name="cep" id="cep" maxlength="9"  />
                            </label>
                            <input type="button" class="btn btn-dark" value="Pesquisar Cep" onclick="pesquisacep()">

							<label for="Logradouro">Logradouro: 
							    <input type="text"  class="form-control" name="Logradouro" id="Logradouro">
                            </label>
					
							<label for="Numero">Numero: 
						    	<input type="text" class="form-control" name="Numero" id="Numero"   >
                            </label>
			
							<label for="Bairro">Bairro: 
		    					<input type="text"  class="form-control" name="Bairro" id="Bairro">
                            </label>
						
							<label for="Cidade">Cidade:
							    <input type="text" name="Cidade" id="Cidade"  class="form-control" >
                            </label>
			
							<label for="UF">UF:
							    <input type="text" name="UF" id="UF"  class="form-control" >
                            </label>

                            <label for="imagem">Imagem:
                                <input type="file" name="imagem" id="imagem"/>
                            </label>
			
							<button type="submit" name="Submit" class="btn btn-dark" style=" float:right;margin-top: 20px; margin-right: 70px; background-color:#00FA9A;">Salvar</button>

	</form>		
	

</div>
