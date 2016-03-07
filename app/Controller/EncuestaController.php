<?php
class EncuestaController extends AppController {
    
	public $components = array('Flash');
	
	public function index() {

	}
	
	public function datos() {

	}
	
	public function editar_datos() {
		$this->Flash->set('Recuerde que debe iniciar sesión en Google para editar datos.', array('element' => 'info'));
	}
	
	public function editar_encuesta() {

	}
}