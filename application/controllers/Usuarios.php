<?php

class Usuarios extends CI_Controller {

	public function login() {

		$data['title'] = 'Iniciar sesión';

		$this->form_validation->set_rules('usuario', 'Usuario', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() === FALSE) {

			$this->load->view('templates/header');
			$this->load->view('usuarios/login', $data);
			$this->load->view('templates/footer');

		} else {

			$usuario = $this->input->post('usurio');
			$password = md5($this->input->post('password'));



		}

		$this->load->view('templates/header');
		$this->load->view('usuarios/login', $data);
		$this->load->view('templates/footer');


	}

	public function registro() {

		$data['title'] = 'Iniciar sesión';

		$this->form_validation->set_rules('id_persona_fisica', 'id', 'required|callback_check_id_exist');
		$this->form_validation->set_rules('usuario', 'Usuario', 'required|callback_check_username_exist');
		$this->form_validation->set_rules('password', 'Password', required);
		$this->form_validation->set_rules('password2', 'ConfirmPassword', 'matches[password]');

		if($this->form_validation->run() === FALSE) {

			$this->load->view('templates/header');
			$this->load->view('usuarios/registro', $data);
			$this->load->view('templates/footer');

		} else {

			$enc_password = md5($this->input->post('password'));

			$this->m_usuario->registrar($enc_password);

			$this->session-set_flashdata('usuario_registrado', 'Ya te encuentras registrado');

			redirec('cotos');

		}

	}

} 