<!DOCTYPE html>
<html lang="pt-br">
<!-- Head - BEGIN -->
<head>
   <?php $this->load->view("globais/head") ?>
</head>
<!-- Head - End  -->

<!-- Body - Begin  -->
<body>
   <header id="login" class="d-flex justify-content-center row col-md-12 mb-5">
      <div class="d-flex flex-column justify-content-center row col-md-6 mt-5">
         <!-- Title -->
         <div class="text-center"><h3 class="display-4">Fazer Cadastro</h3></div>
         
         <!-- Form  -->
         <div class="mt-2">
            <form id="form-signUp" class="form-group" autocomplete="off">
               <!-- Name  -->
               <div class="form-group text-center mt-2">
                  <label for="name">Nome completo</label>
                  <input id="name" type="text" class="form-control text-center" placeholder="Insira seu nome completo">
               </div>
               <!-- Email  -->
               <div class="form-group text-center mt-2">
                  <label for="email">Enderço de email</label>
                  <input id="email" type="email" class="form-control text-center" placeholder="Insira seu email">
               </div>
               <!-- Password  -->
               <div class="form-group text-center mt-2">
                  <label for="password-1">Senha</label>
                  <input id="password-1" type="password" class="form-control text-center" placeholder="Insira sua senha">
                  <small class="form-text text-muted">Sua senha deve conter, no mínimo, 8 caracteres.</small>
               </div>
               <!-- Password confirm -->
               <div class="form-group text-center mt-2">
                  <label for="password-2">Repita a Senha</label>
                  <input id="password-2" type="password" class="form-control text-center" placeholder="Insira sua senha">
                  <small class="form-text text-muted">As senhas devem coincidir!</small>
               </div>
            </form>
            <!-- Submit  -->
            <div class="form-group text-center">
               <button class="btn btn-lg btn-info rounded" onclick="cadastrarUsuario()">Cadastrar</button>
            </div>
            <!-- Login  -->
            <div>
               <p>Já é cadastrado ? <span><a href= <?= base_url() . "login"?>>Faça login</a></span></p>
            </div>
         </div>
      </div>
   </header>
   <!-- Load footer  -->
   <?php $this->load->view("globais/footer") ?>
</body>
<!-- Body - End  -->
</html>