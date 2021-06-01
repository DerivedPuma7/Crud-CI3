<?php

class M_global extends CI_Model{
   /**
    * Construtor: carrega as informações do Banco de Dados
    */
   public function __construct() {
      parent::__construct();
      $this->load->database();
   }
   
   /**
    * Consulta todos os alunos cadastrados
    * @param  [string]    $table [Nome da tabela]
    * @return [array]            [Status da consulta]
    */
   public function get_students($table){
      $this->db->select('*');
      $this->db->from($table);
      $query = $this->db->get()->result_array();

      if(empty($query)){
         return [
            'status' => false,
            'message'=> 'Nenhum aluno cadastrado',
            'data'   => []
         ];
      }
      return [
         'status' => true,
         'data'   => $query
      ];
   }

   /**
    * Insere novos alunos no banco
    * @param  [string]    $table [Nome da tabela]
    * @param  [array]     $data [Dados que serão inseridos]
    * @return                    [Status da query]
    */
   public function insert_student($table, $data){
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
    * Deleta registros de alunos cadastrados
    * @param  [string]    $table [Nome da tabela]
    * @param  [string]    $$id   [Id da exclusão]
    */
   public function delete_students($table, $id){
      $this->db->where('aluno_id', $id);
      $this->db->delete($table);
   }

   /**
    * Busca informação de um aluno específico
    * @param  [string]    $table [Nome da tabela]
    * @param  [string]    $id    [Id do aluno]
    * @return [std]              [Dados do aluno]
    */
   public function get_student_info($table, $id){
      $this->db->select();
      $this->db->from($table);
      $this->db->where('aluno_id', $id);

      $student = $this->db->get()->row();
      return $student;
   }

   /**
    * Atualiza informação de um aluno específico
    * @param  [string]    $table [Nome da tabela]
    * @param  [array]     $data  [Dados a serem atualizados]
    */
   public function update_student($table, $data){
      $this->db->set('aluno_nome', $data['aluno_nome']);
      $this->db->set('aluno_endereco', $data['aluno_endereco']);
      $this->db->set('aluno_foto', $data['aluno_foto']);
      $this->db->where('aluno_id', $data['aluno_id']);
      $this->db->update($table);
   }
}