<?php $this->load->view("header.php"); ?>
<?php if(isset($msgAlert)): echo  $msgAlert; endif?>


<div class="container" style="position:relative; top:60px;"> 
      <a class="btn btn-primary" href="<?php echo base_url();?>Home/NovoContato" role="button">Novo Contato</a>
      <a class="btn btn-primary" href="index.php/Home/PDF" role="button">Gerar PDF</a>
      
      <h2>Agenda:</h2>
      <div class="table-responsive">
        <table class="table table-striped table-secondary table-sm">
          <thead>
            <tr>
              <th>Nome</th>
              <th>telefone</th>
              <th>email</th>
              <th>Cep</th>
              <th>Logradouro</th>
              <th>Numero</th>
              <th>Bairro</th>
              <th>Cidade</th>
              <th>UF</th>
              
             
            </tr>
          </thead>
          <tbody>
           
            <?php foreach($contato as $count) { ?>
              <tr>
                <td> <?= $count->nome; ?> </td>
                <td> <?= $count->telefone; ?> </td>
                <td> <?= $count->email; ?> </td>
                <td> <?= $count->cep; ?> </td>
                <td> <?= $count->logradouro; ?> </td>
                <td> <?= $count->numero; ?> </td>
                <td> <?= $count->bairro; ?> </td>
                <td> <?= $count->cidade; ?> </td>
                <td> <?= $count->uf; ?> </td>
                
                <td> <a class="btn btn-primary" id="atualizar" href="<?php echo base_url("Home/AtualizarContato/".$count->id_contato); ?>" role="button">Atualizar</a>
                     <a class="btn btn-danger"  role="button" id="ExcluirContato"  href="<?php echo base_url("Home/ExcluirContato/".$count->id_contato); ?>" >Excluir</a> </td>
              </tr>
            <?php } ?>
           

          </tbody>
        </table>
      </div>
    
</div>

