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
							<label for="Nome">Nome:
							    <input type="text"  class="form-control" name="Nome" id="Nome"  value="<?= $contato[0]->nome?>"  >
                            </label>
							
							<label for="telefone">Telefone: 
                                <input type="text" placeholder="(092)99999-9999" class="form-control" id="telefone" name="telefone"  value="<?= $contato[0]->telefone?>"  maxlength="14">
                            </label>
                            
                            <label for="email">Email: 
							    <input type="text" placeholder="teste@teste.com" class="form-control" id="email" name="email" value="<?= $contato[0]->email?>">
                            </label>
										
							<label for="cep">Cep:
							    <input type="text" class="form-control" name="cep" id="cep" maxlength="9" value="<?= $contato[0]->cep?>" />
                            </label>
                            <input type="button" class="btn btn-dark" value="Pesquisar Cep" onclick="pesquisacep()">

							<label for="Logradouro">Logradouro: 
							    <input type="text"  class="form-control" name="Logradouro" id="Logradouro" value="<?= $contato[0]->logradouro?>">
                            </label>
					
							<label for="Numero">Numero:
							    <input type="text" class="form-control" name="Numero" id="Numero" value="<?= $contato[0]->numero?>" >
                            </label>
			
							<label for="Bairro">Bairro:
							    <input type="text"  class="form-control" name="Bairro" id="Bairro" value="<?= $contato[0]->bairro?>">
                            </label>
						
							<label for="Cidade">Cidade:
							    <input type="text" name="Cidade" id="Cidade"  class="form-control" value="<?= $contato[0]->cidade?>">
                            </label>
			
							<label for="UF">UF:
							    <input type="text" name="UF" id="UF"  class="form-control" value="<?= $contato[0]->uf?>">
                            </label>

                            <label for="imagem">Imagem:
                                <input type="file" name="imagem" /> 
                            </label>
                            <img src="<?php echo 'assets/img/'.$contato[0]->foto ?>" />
			
							<button type="submit" name="Submit" class="btn btn-dark" style="float:right;margin-top: 20px; margin-right: 70px; background-color:#00FA9A;">Atualizar</button>

	</form>		
	

</div>

