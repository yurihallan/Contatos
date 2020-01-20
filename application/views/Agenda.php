<?php $this->load->view("header.php"); ?>
<?php if(isset($msgAlert)): echo  $msgAlert; endif?>


<div class="container" style="position:relative; top:60px;"> 
      <a class="btn btn-primary" href="<?php echo base_url();?>Home/NovoContato" role="button">Novo Contato</a>
      <a class="btn btn-primary" href="<?php echo base_url();?>Home/PdfGeral" role="button">Gerar PDF</a>
      
      <h2>Agenda:</h2>
      <div class="table-responsive">
        <table class="table table-striped table-secondary table-sm">
          <thead>
            <tr>
              <th>Foto</th>
              <th>Nome2</th>
              <th>telefone</th>
              <th>email</th>
              <th>Cep</th>
              <th>Logradouro</th>
              <th>Numero</th>
              <th>Bairro</th>
              <th>Cidade</th>
              <th>UF</th>
              <th>Data Cadastro</th>
              <th>Data Atualização</th>
              
             
            </tr>
          </thead>
          <tbody>
           
            <?php foreach($contato as $count) { ?>
              <tr>
                <td> <img src=" <?php echo 'assets/img/'.$count->foto; ?>" alt="imagem não encontrada" style="width:70px;"> </td>
                <td> <?= $count->nome; ?> </td>
                <td> <?= $count->telefone; ?> </td>
                <td> <?= $count->email; ?> </td>
                <td> <?= $count->cep; ?> </td>
                <td> <?= $count->logradouro; ?> </td>
                <td> <?= $count->numero; ?> </td>
                <td> <?= $count->bairro; ?> </td>
                <td> <?= $count->cidade; ?> </td>
                <td> <?= $count->uf; ?> </td>
                <td> <?= $count->data_cadastro; ?> </td>
                <td> <?= $count->data_atualizacao; ?> </td>
                
                <td> <a class="btn btn-primary" id="atualizar" href="<?php echo base_url("Home/AtualizarContato/".$count->id_contato); ?>" role="button">Atualizar</a>
                     <a class="btn btn-danger"  role="button" id="ExcluirContato"  href="<?php echo base_url("Home/ExcluirContato/".$count->id_contato); ?>" style="width:80px;">Excluir</a> </td>
              </tr>
            <?php } ?>
           

          </tbody>
        </table>
      </div>
    
</div>
