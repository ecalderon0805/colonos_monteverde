<?php

class Usuarios extends CI_Controller {

    public function index() {

        $data['title'] = 'Registro de usuarios';

        $this->load->view('templates/header');
        $this->load->view('usuarios/registro', $data);
        $this->load->view('templates/footer');
    }

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

                $user_data['data'] = $this->m_usuario->get_usuario($usuario, $password);

                $id = $user_data['data']['id_usuario'];
                $es_admin = $user_data['data']['es_admin'];

                $userdata = $arrayName = array(
                    'id_usuario' => $id,
                    'usuario' => $usuario,
                    'es_admin' => $es_admin,
                    'logged_in' => true
                );

                $this->session->set_userdata($userdata);
                $this->session->set_flashdata('user_loggedin', 'Ingreso al sistema');
                redirect('usuarios/login');
            } else {
                $this->session->set_flashdata('login_failed', 'Usuario o contraseña incorrectos');
                redirect('usuarios/login');
            }
        }
    }

    public function logout() {
        //unset user data
        $this->session->unset_userdata('id_usuario');
        $this->session->unset_userdata('usuario');
        $this->session->unset_userdata('logged_in');

        //Set message
        $this->session->set_flashdata('user_loggedout', 'Se encunetra fuera del sistema');

        redirect('usuarios/login');
    }

    public function registro() {
        
        if(!$this->session->userdata('logged_in') ){
             redirect('usuarios/login');
        }
        
        if($this->session->userdata('es_admin')!= 1){
            logout();
        }

        $data['title'] = 'Registro de usuarios';
        

        $data['personas_fisicas'] = $this->m_usuario->get_personas_fisicas();

        //$this->form_validation->set_rules('id_persona_fisica', 'id_persona_fisica', 'required|callback_check_id_persona_fisica_exists');
        //$this->form_validation->set_rules('user_exists', 'Usuario', 'callback_check_usuario_exists');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'Confirmar password', 'matches[password]');
        

        $usuario = $this->input->post('usuario');

        if ($this->form_validation->run() === FALSE) {
            $this->form_validation->set_error_delimiters('<p class="alert alert-danger text-center">', '</p>');
            $this->load->view('templates/header');
            $this->load->view('usuarios/registro', $data);
            $this->load->view('templates/footer');

        } else {
            
            if ($this->m_usuario->check_usuario_exists($usuario) == 1) {

                $this->session->set_flashdata('user_exists', 'Ese usuario ya existe, ingrese otro');
                $this->load->view('templates/header');
                $this->load->view('usuarios/registro', $data);
                $this->load->view('templates/footer');

            } else {
                $enc_password = md5($this->input->post('password'));
                $this->m_usuario->registrar($enc_password);
                //Darle un valor al combo
                $this->session->set_flashdata('user_registered', 'Registro exitoso');
                $this->load->view('templates/header');
                $this->load->view('usuarios/registro', $data);
                $this->load->view('templates/footer');
            }
        }
    }

    /*  public function check_usuario_exists($usuario) {
        if ($this->m_usuario->check_usuario_exists($usuario)) {
            return true;
        } else {
            return false;
        }
    }*/

    public function check_id_persona_fisica_exists($id_usuario) {
        $this->form_validation->set_message('check_id_persona_fisica_exists', 'Esa persona ya cuenta con usuario');
        if ($this->m_usuario->check_id_persona_fisica_exists($id_usuario)) {
            return true;
        } else {
            return false;
        }
    }

}
