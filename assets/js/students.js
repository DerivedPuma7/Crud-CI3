const BASEURL = "http://localhost/crud_delta/";

/**
 * Abre modal de inserir/atualizar aluno
 */
function openStudentModal() {
   $('#studentId').val('') //limpa o value do input onde está o id do aluno
   $('#insertStudentModal').modal('show');
}

/**
 * Abre o modal de visualizar dados do aluno
 * @param {string} name nome do aluno
 * @param {string} photo diretorio da foto
 * @param {address} address endereço do aluno
 */
function detailStudent(name, photo, address){
   $('#detailStudentModal').modal('show');
   $('#studentName').html(name);
   $('#studentAddress').html(address);
   $("#studentPhoto").attr('src', photo);
}

/**
 * Insere/Atualiza alunos
 */
function insertStudent() {
   let name = $('#name').val();
   let address = $('#address').val();
   let photo =  $('#photo').val();
   let id = $('#studentId').val();
   
   $.ajax({
      type: "POST",
      url: "inserir-aluno",
      data: {
         'aluno_id': id,
         'aluno_nome': name,
         'aluno_endereco': address,
         'aluno_foto': photo
      },
      dataType: "json",
      success: function (response) {
         if(response.status){
            info('success', response.message); //chama função generica de alertas
            setTimeout(() => {
               redirectPage('home');//redireciona para home
            }, 2000);
         }
         else{
            info('error', response.message); //chama função generica de alertas
         }
      }
   });
}

/**
 * Deleta um aluno específico
 * @param {string} id id do aluno que será excluído
 * @param {string} name nome do aluno que será excluído
 */
function deleteStudent(id, name) {
   Swal.fire({  
      title: 'Deseja excluir o aluno "' + name + '" ?',
      icon: 'error',
      showDenyButton: true,
      confirmButtonText: `Sim`,
      denyButtonText: `Não`,
   })
   .then((result) => {
      if (result.isConfirmed) { //se o usuário deseja realmente excluir
         $.ajax({
            type: "post",
            url: "deletar-aluno",
            data: {
               id
            },
            dataType: "json",
            success: function (response) {
               info('success', response);
               setTimeout(() => {
                  redirectPage('home');
               }, 2000);
            }
         });
      }
   })
}

/**
 * Traz os dados do banco para serem editados
 * @param {string} id id do aluno que será editado
 */
function editStudent(id){
   $.ajax({
      type: "post",
      url: "editar-aluno",
      data: {
         id
      },
      dataType: "json",
      success: function (response) {
         $('#modalTitle').html('Atualizar cadastro');
         $('#name').val(response.aluno_nome);
         $('#address').val(response.aluno_endereco);
         $('#aluno_img_path').attr("src", response.aluno_foto);
         $('#sendRequest').html('Atualizar');
         $('#photo').val(response.aluno_foto);
         openStudentModal();
         $('#studentId').val(response.aluno_id)
      }
   });
}

/**
 * Função genérica que exibe alertas
 * @param {string} icon icone que será utilizados
 * @param {string} title mensagem a ser exibida
 */
function info(icon, title){
   Swal.fire({
      position: 'top-end',
      icon,
      title,
      showConfirmButton: false,
      timer: 3500
   })
}

/**
 * Redireciona o usuário para uma página
 * @param {string} page pagina a ser redirecionado
 */
function redirectPage(page) {
   window.location.replace(BASEURL + page);
}

/**
 * Captura cada foto e chama a função de fazer upload
 */
function imgAluno() 
{
   $("#btn_upload_aluno_img").change(function(){
      uploadImg($(this), $("#aluno_img_path"), $("#photo"));
   })
}


function uploadImg(input_file, img, input_path) {
	src_before = img.attr("src");
	img_file = input_file[0].files[0];
	form_data = new FormData();

	form_data.append("image_file", img_file);

	$.ajax({
		url: "home/import-image",
		dataType: "json",
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,
		type: "POST",
		success: function(response) {
			if (response["status"]) {
				img.attr("src", "http://" + response["img_path"]);
				input_path.val(response["img_path"]);
			} else {
				img.attr("src", src_before);
				input_path.siblings(".help-block").html(response["error"]);
			}
		},
		error: function() {
			img.attr("src", src_before);
		}
	})
}

