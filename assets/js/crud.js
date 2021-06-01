const BASE_URL = "http://localhost/crud_delta/";

/**
 * Realiza o cadastro de um novo usuário
 */
function cadastrarUsuario(){
   let name = $.trim($('#name').val());
   let email = $.trim($('#email').val());
   let password1 = $.trim($('#password-1').val());
   let password2 = $.trim($('#password-2').val());
   
   //Manda os dados para verificação
   let isValid = verifyFields(name, email, password1, password2);

   //Caso a verificação falhe
   if(typeof isValid == 'string'){
      alert('error', 'Por favor, verifique o campo "' + isValid + '"');
   }
   else{
      $.ajax({
         type: "POST",
         url: "cadastrar-usuario",
         data: {
            name,
            email,
            password1,
            password2
         },
         dataType: "json",
         success: function (response) {
            //Ternario que decide o resultado de acordo com a resposta da requisição
            response.status ? success('success', 'Seu trabalho foi salvo com sucesso :)', ) : alert('warning', 'Algo deu errado, tente novamente. Se o erro persistir, aguarde alguns instantes.');
         }
      });
   }
}

/**
 * Verifica a integridade das informações do formulário
 * @param {string} name nome do usuário
 * @param {string} email email do usuário
 * @param {string} password1 senha do usuário
 * @param {string} password2 senha do usuário
 * @returns boolean / string
 */
function verifyFields(name, email, password1, password2){
   if(name == '' || name == undefined || name == null){
      return 'Nome';
   }
   if(email == '' || email == undefined || email == null){
      return 'Email';
   }
   if(password1.length < 8){ //Senha deve conter ao menos 8 caracteres
      return 'Senha';
   }
   if(password2 != password1){ //Senhas devem coincidir
      return 'Senha';
   }
   return true;
}

/**
 * Função genérica de alertas
 * @param {string} icon ícone a ser usado
 * @param {string} title título a ser usado
 */
function alert(icon, title){
   Swal.fire({
      position: 'top-end',
      icon,
      title,
      showConfirmButton: false,
      timer: 3500
   })
}

/**
 * Função específica de alerta e redirecionamento
 * @param {string} icon ícone a ser usado
 * @param {string} title título a ser usado
 */
function success(icon, title) {
   Swal.fire({
      position: 'top-end',
      icon,
      title,
      showConfirmButton: false,
      timer: 3500
   })
   redirectPage('login')
}

/**
 * redireciona usuário para uma página específica
 * @param {string} page pagina a ser redirecionada
 */
function redirectPage(page) {
   window.location.replace(BASE_URL + page);
}

/**
 * Realiza o login do usuário e direciona para página Home
 */
function login(){
   let email = $.trim($('#email').val());
   let senha = $.trim($('#password').val());

   $.ajax({
      type: "POST",
      url: "entrar",
      data: {
         email,
         senha
      },
      dataType: "json",
      success: function (response) {
         response.status ? redirectPage('home') : alert('warning', response.message);
         
      }
   });
}