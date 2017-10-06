<?php

class M_usuario extends CI_Model {

    public function registro($enc_password) {

        $data = array(
            'usuario' => $this->input->post('usuario'),
            'password' => $enc_password,
            'id_persona_fisica' => $this->input->post('id_persona_fisica')
        );
        return $this->db->insert('usuarios', $data);
    }

    public function login($usuario, $password) {
        $this->db->where('usuario', $usuario);
        $this->db->where('password', $password);

        $result = $this->db->get('usuarios');
        if ($result->num_rows() == 1) {
            return $result->row(0)->id;
        } else {
            return false;
        }
    }

    public function check_usuario_exists($usuario) {
        $query = $this->db->get_where('usuarios', array('usuario' => $usuario));
        if (empty($query->row_array())) {
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
