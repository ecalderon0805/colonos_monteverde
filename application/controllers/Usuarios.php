<?php

class Usuarios extends CI_Controller {

    public function login() {

        $data['title'] = 'Iniciar sesión';

        $this->form_validation->set_rules('usuario', 'Usuario', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {

            $this->load->view('templates/header');
            $this->load->view('usuarios/login', $data);
            $this->load->view('templates/footer');
            
        } else {
     
            $usuario = $this->input->post('usuario');
            $password = md5($this->input->post('password'));

            $id_usuario = $this->m_usuario->login($usuario, $password);

            if ($id_usuario) {
                $user_data = $arrayName = array(
                    'id_usuario' => $id_usuario,
                    'usuario' => $usuario,
                    'logged_in' => true
                );
                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('user_loggedin', 'Ingreso al sistema');
                redirect('cotos');
            } else {
                $this->session->set_flashdata('login_failed', 'Usuario o contraseña incorrectos');
                redirect('usuarios/login');
            }
        }
    }

    public function registro() {

        $data['title'] = 'Registro de usuarios';

        $this->form_validation->set_rules('id_persona_fisica', 'id_persona_fisica', 'required|callback_check_id_persona_fisica_exists');
        $this->form_validation->set_rules('usuario', 'Usuario', 'required|callback_check_usuario_exists');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'ConfirmPassword', 'matches[password]');

        if ($this->form_validation->run() === FALSE) {

            $this->load->view('templates/header');
            $this->load->view('usuarios/registro', $data);
            $this->load->view('templates/footer');
            
        } else {

            $enc_password = md5($this->input->post('password'));
            $this->m_usuario->registrar($enc_password);
            $this->session->set_flashdata('registro_registrado', 'Registro exitoso');
            
            redirec('usuarios/registro');
        }
    }

    public function logout() {
        //unset user data
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('id_usuario');
        $this->session->unset_userdata('usuario');

        //Set message
        $this->session->set_flashdata('user_loggedout', 'Ya se encunetra fuera del sistema');

        redirect('users/login');
    }

    public function check_usuario_exists($username) {
        $this->form_validation->set_message('check_usuario_exists', 'Este usuario ya existe, seleccione otro');
        if ($this->m_usuario->check_usuario_exists($username)) {
            return true;
        } else {
            return false;
        }
    }

    public function check_id_persona_fisica_exists($id_usuario) {
        $this->form_validation->set_message('check_id_persona_fisica_exists', 'Esa persona ya cuenta con usuario');
        if ($this->m_usuario->check_id_persona_fisica_exists($id_usuario)) {
            return true;
        } else {
            return false;
        }
    }

}
