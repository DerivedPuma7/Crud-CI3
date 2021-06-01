<?php

class M_user extends CI_Model{
   /**
    * Construtor: carrega as informações do Banco de Dados
    */
   public function __construct() {
      parent::__construct();
      $this->load->database();
   }
   
   /**
    * Insere um novo usuário
    * @param  [string]    $table [Nome da tabela]
    * @param  [array]     $data  [Dados a serem inseridos]
    * @return                    [Status da query]
    */
   public function insert_user($table, $data){
      $this->db->insert($table, $data);

      $id = $this->db->insert_id();

      if($id){
         return [
            'status' => true,
            'id'     => $id
         ];
      }
      return false;
   }

   /**
    * Busca informação de um usuário específico, pelo email
    * @param  [string]    $email [Email do uauário]
    * @param  [string]    $table [Nome da tabela]
    * @return []                 [Dados do usuario]
    */
   public function get_user_by_email($email, $table){
      $this->db->select('usuario_senha');
      $this->db->from($table);
      $this->db->where('usuario_email', $email);

      $password = $this->db->get()->row();

      if(!empty($password)){
         return $password;
      }
      return false;
   }
}