<?php

class M_usuario extends CI_Model {

    public function registrar($enc_password) {
        
        $es_admin = $this->input->post('es_admin');
        
        
         $es_admin = is_null($es_admin) ? 0 : 1;
        
        $data = array(
            'id_persona_fisica' => $this->input->post('id_persona_fisica'),
            'usuario' => $this->input->post('usuario'),
            'password' => $enc_password,
            'es_admin' => $es_admin
        );
        return $this->db->insert('usuarios', $data);
    }

    public function login($usuario, $password) {
        $this->db->where('usuario', $usuario);
        $this->db->where('password', $password);

        $result = $this->db->get('usuarios');
        if ($result->num_rows() == 1) {
            return $result->row(0)->id_usuario;
        } else {
            return false;
        }
    }

    public function get_usuario($usuario, $password) {
        $this->db->where('usuario', $usuario);
        $this->db->where('password', $password);

        $query = $this->db->get('usuarios');

        return $query->row_array();
    }
    
    public function get_personas_fisicas(){
        $query = $this->db->get('personas_fisicas');
        return $query->result_array();
    }

    public function check_usuario_exists($usuario) {
        $this->db->where('usuario', $usuario);
        
        $result = $this->db->get('usuarios');
        if ($result->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function check_id_persona_fisica_exists($id_persona_fisica) {
        $query = $this->db->get_where('personas_fisicas', array('id_persona_fisica' => $id_persona_fisica));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

}
