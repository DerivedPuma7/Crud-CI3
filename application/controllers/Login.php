<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller{
   /**
    * Construtor: carrega a model
    */
   public function __construct() {
      parent::__construct();
      $this->load->model('M_user');
   }

   /**
    * Chama a view de login
    */
   public function index(){
      $this->load->view("login");
   }

   /**
    * Chama a view de cadastro
    */
   public function sign_up(){
      $this->load->view("sign_up");
   }

   /**
    * Salva um novo usuário no banco de dados
    */
   public function save_user(){
      $data = $this->input->post();
      //$isValid recebe um booleano de acordo com a verificação dos campos enviados do form
      $isValid = $this->verify_fields($data);

      //Caso exista algum erro
      if($isValid === 'Nome' || $isValid === 'Email' || $isValid === 'Senha'){
         echo json_encode('Ocorreu um erro durante o cadastro. Por favor, verifique os valores dos campos e tente novamente');
      }
      else{
         $data_to_save = [
            'usuario_nome'  => $data['name'],
            'usuario_email' => $data['email'],
            'usuario_senha' => $data['password1']
         ];
         
         $response = $this->M_user->insert_user('Usuarios', $data_to_save);

         //Caso o insert ocorra de maneira correta
         if ($response['status']){
            echo json_encode($response);
         } 
         else{
            echo json_encode('Erro durante o cadastro. Tente novamente!');
         }
      }
   }

   /**
    * Realiza o login de um usuário
    */
   public function login(){
      $data = $this->input->post();

      //Busca na model a senha do usuario de acordo com o email
      $response = $this->M_user->get_user_by_email($data['email'], 'Usuarios');

      //Senha não encontrada
      if(!$response){
         echo json_encode([
            'status'  => false,
            'message' => 'Email ou senha incorretos!'
         ]);
      }
      else{
         //Compara senha do banco com a senha enviada pelo form
         if($response->usuario_senha === $data['senha']){
            echo json_encode([
               'status'  => true,
               'message' => 'Senha correta'
            ]);
         }
         else{
            echo json_encode([
               'status'  => false,
               'message' => 'Email ou senha incorretos!'
            ]);
         }
      }
   }

   /**
    * Função de verificar campos do POST
    */
   public function verify_fields($data){
      if($data['name'] == '' || $data['name'] == null){
         return 'Nome';
      }
      if($data['email'] == '' || $data['email'] == null){
         return 'Email';
      }
      if(count(str_split($data['password1'])) < 8){
         $n = count(str_split($data['password1']));
         return 'Senha';
      }
      if($data['password2'] != $data['password1']){
         return 'Senha';
      }
      return true;
   }
}