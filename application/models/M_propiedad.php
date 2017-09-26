<?php

class M_propiedad extends CI_Model {

      public function __construct(){

      	$this->load->database();
      	
      }

       public function get_propiedad($slug = FALSE) {

      	if($slug === FALSE){
      		$query = $this->db->get('propiedades');
      		return $query->result_array();
      	}

      	$query = $this->db->get_where('propiedades', array('slug' => $slug));
      	return $query->row_array();
      	
      }

}