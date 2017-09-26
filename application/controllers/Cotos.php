<?php
 class Cotos extends CI_Controller {
 	public function index(){

 		$data['title'] = 'Coto No';

 		$this->load->view('templates/header');
 		$this->load->view('cotos/index', $data);
 		$this->load->view('templates/footer');

 	}
 }