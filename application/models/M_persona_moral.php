<?php

class M_persona_moral extends CI_Model {

      public function __construct(){

      	$this->load->database();
      	
      }

       public function get_persona_moral($slug = FALSE) {

      	if($slug === FALSE){
      		$query = $this->db->get('personas_fisicas');
      		return $query->result_array();
      	}

      	$query = $this->db->get_where('personas_fisicas', array('slug' => $slug));
      	return $query->row_array();
      	
      }

}