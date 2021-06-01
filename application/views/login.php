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
         <div class="text-center"><h3 class="display-4">Fazer Login</h3></div>
         <!-- Login avatar -->
         <div class="text-center py-2">
            <img src=<?= base_url() . "assets/img/login/doble.svg"?> width="100">
         </div>
         <!-- Form  -->
         <div class="mt-2">
            <form id="form-signIn" class="form-group" autocomplete="off">
               <!-- Email  -->
               <div class="form-group text-center mt-2">
                  <label for="email">Enderço de email</label>
                  <input id="email" type="email" class="form-control text-center" placeholder="Insira seu email">
               </div>
               <!-- Password  -->
               <div class="form-group text-center mt-2">
                  <label for="password">Senha</label>
                  <input id="password" type="password" class="form-control text-center" placeholder="Insira sua senha">
               </div>
            </form>
            <!-- Submit -->
            <div class="form-group text-center">
               <button class="btn btn-lg btn-primary" onclick="login()">Entrar</button>
            </div>
            <!-- Sign Up -->
            <div>
               <p>Ainda não é cadastrado ? <span><a href="<?= base_url()?>cadastre-se">Cadastre-se já!</a></span></p>
            </div>
            
         </div>
      </div>
   </header>
   <?php $this->load->view("globais/footer") ?>
</body>
<!-- Body - End  -->
</html>