<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Redirect 
$route['login'] = 'Login/index'; // sign In page
$route['cadastre-se'] = 'Login/sign_up'; // sign Up page


// Login/Register 
$route['entrar'] = 'Login/login'; //login method 
$route['cadastrar-usuario'] = 'Login/save_user'; //register method

//CRUD Routes
$route['inserir-aluno'] = 'Home/insert_student'; //CREATE
$route['home'] = 'Home'; //READ
$route['editar-aluno'] = 'Home/edit_student'; //UPDATE
$route['deletar-aluno'] = 'Home/delete_student'; //DELETE

$route['home/import-image']    = 'Home/ajax_import_image'; //UPLOAD IMAGE

