<!DOCTYPE html>
<html lang="pt-br">
<!-- Head - BEGIN -->
<head>
   <?php $this->load->view("globais/head") ?>
   <script src= <?= base_url() . "assets/js/students.js"?>></script>
</head>
<!-- Head - End  -->

<!-- Body - Begin  -->
<body>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark row">
      <div class="col-md-10">
         <a class="navbar-brand" href="#">Início</a> 
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button> 
      </div>
      

      <div class="collapse navbar-collapse col-md-2" id="navbarSupportedContent">
         <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Usuário
               </a>
               <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#" onclick="redirectPage('login')">Sair</a>
               </div>
            </li>
         </ul>
      </div>
   </nav>

   <section>
      <div class="container">
         <div class="row">
            <div class="col-md-12 my-4">
               <h1 class="text-center">Processo seletivo Delta</h1>
            </div>

            <div class="col-md-12">
               <div class="card">
                  <div>
                     <?php if(!$status) { ?>
                        <h4 class="lead">Não há alunos cadastrados</h4>
                     <?php } ?>
                  </div>
                  <!-- CARD HEADER -->
                  <div class="card-header">
                     <h4 class="display-4 d-flex justify-content-between">
                        Alunos cadastrados
                        <!-- BOTÃO PARA O MODAL -->
                        <a href="#" class="btn btn-sn btn-primary py-3" onclick="openStudentModal()">Adicionar aluno</a>
                     </h4>
                  </div>
                  
                  <!-- CARD BODY -->
                  <div class="card-body">
                     <!-- Students table  -->
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th class="text-center">Nome</th>
                              <th class="text-center">Foto</th>
                              <th class="text-center">Endereço</th>
                              <th class="text-center">Ações</th>
                           </tr>
                        </thead>

                        <tbody>
                           <?php if(isset($data)){ ?>
                              <?php foreach ($data as $student) { ?>
                                 <tr>
                                    <!-- name  -->
                                    <td class="text-center"> <?=$student['aluno_nome'] ?> </td>
                                    <!-- photo  -->
                                    <td class="text-center"> <img src="<?= $student['aluno_foto'] ?>" width="80"> </td>
                                    <!-- address  -->
                                    <td class="text-center"> <?=$student['aluno_endereco'] ?> </td>
                                    <!-- actions  -->
                                    <td class="text-center" style="width: 8vw;">
                                       <span class="btn btn-sm btn-info" onclick="detailStudent('<?=$student['aluno_nome'] ?>', '<?= $student['aluno_foto'] ?>', '<?=$student['aluno_endereco'] ?>')">Acessar</span>
                                       <span class="btn btn-sm btn-secondary my-2" onclick="editStudent(<?= $student['aluno_id'] ?>)" >Editar</span>
                                       <span class="btn btn-sm btn-danger" onclick="deleteStudent(<?= $student['aluno_id'] ?>, '<?=$student['aluno_nome'] ?>')">Excluir</span>
                                    </td>
                                 </tr>
                              <?php } ?>
                           <?php } ?>
                        </tbody>
                     </table>
                  </div>

               </div>
            </div>
         </div>
      </div>
   </section>

   <!-- insert new student/update student modal -->
   <div class="modal fade" id="insertStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalTitle">Inserir novo aluno</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
               <!-- form  -->
               <form id="insertStudent">
                  <input type="text" id="studentId" hidden value="" name="aluno_id" >
                  <!-- Name  -->
                  <div class="form-group">
                     <label for="name">Nome</label>
                     <input type="text" class="form-control" id="name" name="aluno_nome" placeholder="Insira o nome completo do aluno">
                  </div>
                  <!-- Address  -->
                  <div class="form-group">
                     <label for="address">Endereço</label>
                     <input type="text" class="form-control" id="address" name="aluno_endereco" placeholder="Insira o endereço">
                  </div>
                  <!-- Photo  -->
                  <div class="form_group">
                     <label>Foto</label>
                     <div class="col-lg-12">
                        <img id="aluno_img_path" src="" style="max-height: 200px;"/>
                        <label class="btn btn-block btn-info">
                           <i class="fa fa-upload"></i>&nbsp;&nbsp;Importar foto
                           <input type="file" id="btn_upload_aluno_img"
                           accept="image/*" onClick="imgAluno()" style="display: none;">       
                        </label>
                        <!-- photo directory -->
                        <input id="photo" name="aluno_foto" readonly>
                     </div>
                  </div>

                  <!-- Submit  -->
                  <span id="sendRequest" class="btn btn-primary mt-2" onclick="insertStudent()">Cadastrar aluno</span>
               </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
         </div>
      </div>
   </div>

   <!-- detail student modal -->
   <div class="modal fade" id="detailStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Detalhes do aluno</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <div class="modal-body">
            <div class="row col-md-12">
               <!-- photo card  -->
               <div class="col-md-4 card p-2">
                  <img id="studentPhoto" src="">
               </div>
               <!-- info card  -->
               <div class="col-md-8 card">
                  <p class="lead pt-2">Nome: <span id="studentName"></span> </p>
                  <p class="lead pt-2">Endereço: <span id="studentAddress"></span> </p>
               </div>
            </div>
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
         </div>
      </div>
   </div>
   </div>

   <!-- Load footer  -->
   <?php $this->load->view("globais/footer") ?>
</body>
<!-- Body - End  -->
</html>