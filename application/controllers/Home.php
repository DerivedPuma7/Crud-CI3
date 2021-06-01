<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends CI_Controller{

   /**
    * Construtor: carrega a model
    */
   public function __construct() {
      parent::__construct();
      $this->load->model('M_global');
   }

   /**
    * Busca os alunos no banco e manda os dados pra view
    */
   public function index(){
      
      $students = $this->M_global->get_students('alunos');

      $this->load->view("home", $students);
   }

   /**
    * Insere novos alunos no banco de dados
    */
   public function insert_student(){
      //segurança: evita o acesso por meio de uma requisição GET
      if(empty($this->input->post())){
         exit("<h3>Não é possível acessar essa URL no momento</h3>");
      }

      $data = $this->input->post();

      //checa erros nos campos do form
      $errors = [];
      if($data['aluno_nome'] == '' || $data['aluno_nome'] == null){
         $errors['name'] = 'O nome do aluno deve ser preenchido!';
      }
      if($data['aluno_endereco'] == '' || $data['aluno_endereco'] == null){
         $errors['address'] = 'O endereço do aluno deve ser preenchido!';
      }
      if($data['aluno_foto'] == '' || $data['aluno_foto'] == null){
         $errors['photo'] = 'A foto do aluno é obrigatória!';
      }

      // caso exista campos vazios 
      if(!empty($errors)){
         echo json_encode($errors);
      }

      else{
         //insere um novo aluno
         if(empty($data['aluno_id'])){
            $data['aluno_foto'] = 'http://' . $data['aluno_foto'];
            array_shift($data);
            $response = $this->M_global->insert_student('alunos', $data);
            //se o insert der certo
            if($response){
               echo json_encode([
                  'status'  => true,
                  'message' =>'Aluno inserido com sucesso !'
               ]);
            }
            else{
               echo json_encode([
                  'status'  => false,
                  'message' =>'Falha ao inserir novo aluno. Por favor, tente novamente!'
               ]);
            }
         }
         //Atualizar um aluno ja cadastrado
         else{
            $this->M_global->update_student('alunos', $data);
            echo json_encode([
               'status'  => true,
               'message' =>'Cadastro atualizado com sucesso !'
            ]);
         }
      }
   }

   /**
    * Deleta um aluno específico
    */
   public function delete_student(){
      //segurança: evita o acesso por meio de uma requisição GET
      if(empty($this->input->post())){
         exit("<h3>Não é possível acessar essa URL no momento</h3>");
      }

      $id = $this->input->post('id');
      $this->M_global->delete_students('alunos', $id);

      echo json_encode('Aluno excluído com sucesso!');
   }

   /**
    * Traz os dados de um aluno para fazer atualização
    */
   public function edit_student(){
      $id = $this->input->post('id');

      $data = $this->M_global->get_student_info('alunos', $id);

      echo json_encode($data);
   }

   /**
    * Faz o upload da imagem
    */
   public function ajax_import_image(){

		$config["upload_path"] = "./assets/img/students";
		$config["allowed_types"] = "png|jpg";
		$config["overwrite"] = TRUE;
		$this->load->library("upload", $config);

		$json = [];
		$json["status"] = 1;
		
		if(!$this->upload->do_upload("image_file")){
			$json["status"] = 0;
			$json["error"] = $this->upload->display_errors("","");
		}
		else{
			if($this->upload->data()["file_size"] <= 1024){
				$file_name = $this->upload->data()["file_name"];
				$json["img_path"] = "localhost/crud_delta/assets/img/students/" . $file_name;
			}
			else{
				$json["status"] = 0;
				$json["error"] = "Arquivo não deve ser maior que 1mb";
			}
		}

		echo json_encode($json);
	}
}