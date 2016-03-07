<?php
App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');
App::uses('String', 'Utility');

class UsersController extends AppController {
	
	//public $components = array('Flash');
	
	var $components = array("Flash","Email","Session");
	var $helpers = array("Html","Form","Session");
 
    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('User.username' => 'asc' ) 
    );
     
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','add','forgetpwd','reset'); 
    }
 
 
    public function login() {
         
        //if already logged-in, redirect
        if($this->Session->check('Auth.User')){
            $this->redirect(array('controller' => 'tcu', 'action' => 'index'));      
        }
         
        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
				
				// Si es usuario está desactivado
				if(AuthComponent::user('status') == 0){
					$this->Flash->set('Su cuenta está desactivada.', array('element' => 'warning'));
					$this->redirect($this->Auth->logout());
				}
				else{
					$this->redirect($this->Auth->redirectUrl());					
				}
            } 
			else {
				$this->Flash->set('Usuario o contraseña inválida, por favor intente nuevamente.', array('element' => 'warning'));
            }
        } 
    }
 
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
 
    public function index() {
        
		if(AuthComponent::user() && AuthComponent::user('role') === 'admin'){
			$this->paginate = array(
				'limit' => 6,
				'order' => array('User.username' => 'asc' )
			);
			$users = $this->paginate('User');
			$this->set(compact('users'));
		}
		else{
			$this->redirect(array('controller' => 'tcu', 'action' => 'index'));
		}
    }
	
	public function resumen($id = null){
		
		if(AuthComponent::user() && (AuthComponent::user('role') === 'admin' || AuthComponent::user('id') === $id)){
		
			$this->User->id = $id;
			
			if (!$this->User->exists()) {
				$this->Flash->set('El usuario no existe.', array('element' => 'error'));
				$this->redirect(array('action'=>'index'));
			}
			
			$this->set('user', $this->User->read(null, $id));
		}
		else{
			$this->redirect(array('controller' => 'tcu', 'action' => 'index'));
		}
	}
 
 
    public function add() {
        if ($this->request->is('post')) {
                 
            $this->User->create();
			
			/*if($this->request->data['User']['role'] == NULL){
				$this->request->data['User']['role'] = 'invitado';
			}*/
			
            if ($this->User->save($this->request->data)) {
                $this->Flash->set('El usuario ha sido creado.', array('element' => 'success'));
                
				$params = array(
					'id' => $this->User->id,
					'usuario' => $this->request->data['User']['username'],
					'correo' => $this->request->data['User']['email'],
					'rol' => $this->request->data['User']['role'],
					'fecha' => $this->User->findById($this->User->id)['User']['created']
				);
				
				$this->enviarCorreo( $params );
				$this->redirect(array('action' => 'index'));
            } 
			else {
                $this->Flash->set('El usuario no pudo ser creado.', array('element' => 'error'));
            }   
        }
    }
	
	private function enviarCorreo( $params = null ){
		$mensaje = "Se ha creado una nueva cuenta de ".$params['rol']." para usted:<br><hr>Usuario: ".$params['usuario']."<br>Correo: ".$params['correo']."<br>Fecha de creación: ".$params['fecha']."<br><hr>";
		$email = new CakeEmail('default');
		$Email	->from(array('ucrtcu593@gmail.com' => 'TCU 593'))
				->to($params['correo'])
				->subject('Nueva cuenta de usuario')
				->send($mensaje);
	}
	
	private function enviarCorreo2( $params = null ){
		
		//$mensaje = "Se ha creado un nuevo usuario:<br><hr>Usuario: ".$params['usuario']."<br>Correo: ".$params['correo']."<br>Rol: ".$params['rol']."<br>Fecha creación: ".$params['fecha']."<br><hr>";
		$mensaje = "Se ha creado una nueva cuenta de ".$params['rol']." para usted:<br><hr>Usuario: ".$params['usuario']."<br>Correo: ".$params['correo']."<br>Fecha de creación: ".$params['fecha']."<br><hr>";
		$plantilla = file_get_contents(Router::url('/', true).'app/webroot/template/correo.html');
		$plantilla = str_replace('{{mensaje}}', $mensaje, $plantilla);
		$plantilla = str_replace('{{boton}}', 'Ver', $plantilla);
		$plantilla = str_replace('{{href}}', Router::url('/', true).'users/resumen/'.$params['id'], $plantilla);		
		$mensaje = $plantilla;
		
		$subject = "TCU 593: Nueva cuenta de usuario";
		$message = $mensaje;
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: TCU 593 <ucrtcu593@gmail.com>' . "\r\n";
		
		// Busca los correos de los administradores
		//$users = $this->User->find('all', array('fields' => array('email'), 'conditions'=>array('User.role'=>'admin')));
		
		// Envía un correo al nuevo usuario
		$to = $params['correo'];
		
		if( mail($to,$subject,$message,$headers) ){
			//echo 'Correo enviado.';
		}
		else{	
			//echo 'Error enviando correo.';
		}
		
		// Envía un correo a cada administrador
		/*foreach ($users as $user) {
			
			$to = $user['User']['email'];
			
			if( mail($to,$subject,$message,$headers) ){
				//echo 'Correo enviado.';
			}
			else{	
				//echo 'Error enviando correo.';
			}
		}*/
	}
 
    public function edit($id = null) {
			
			if(AuthComponent::user() && (AuthComponent::user('role') === 'admin' || AuthComponent::user('id') === $id)){
			
				if (!$id) {
					$this->Flash->set('Usuario inválido.', array('element' => 'error'));
					$this->redirect(array('action'=>'index'));
				}
	 
				$user = $this->User->findById($id);
				
				if (!$user) {
					$this->Flash->set('Usuario inválido.', array('element' => 'error'));
					$this->redirect(array('action'=>'index'));
				}
	 
				if ($this->request->is('post') || $this->request->is('put')) {
					$this->User->id = $id;
					if ($this->User->save($this->request->data)) {
						$this->Flash->set('El usuario ha sido modificado.', array('element' => 'success'));
						if( AuthComponent::user('role') === 'admin' ){
							$this->redirect(array('action' => 'index'));
						}
						else if( AuthComponent::user('role') === 'invitado' || AuthComponent::user('role') === 'visitante' ){
							$this->redirect(array('action'=>'resumen', AuthComponent::user('id')));
						}
					}
					else{
						$this->Flash->set('El usuario no pudo ser modificado.', array('element' => 'error'));
					}
				}
	 
				if (!$this->request->data) {
					$this->request->data = $user;
				}
			}
			else{
				$this->redirect(array('controller' => 'tcu', 'action' => 'index'));
			}
    }
 
    public function delete($id = null) {
         
        if(AuthComponent::user() && AuthComponent::user('role') === 'admin' ){
			
			if (!$id) {
				$this->Flash->set('Usuario inválido.', array('element' => 'error'));
				$this->redirect(array('action'=>'index'));
			}
			 
			$this->User->id = $id;
			
			if (!$this->User->exists()) {
				$this->Flash->set('Usuario inválido.', array('element' => 'error'));
				$this->redirect(array('action'=>'index'));
			}
			if ($this->User->saveField('status', 0)) {
				$this->Flash->set('El usuario ha sido eliminado.', array('element' => 'success'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('User was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
		else{
			$this->redirect(array('controller' => 'tcu', 'action' => 'index'));
		}
    }
     
    public function activate($id = null) {
        
		if(AuthComponent::user() && AuthComponent::user('role') === 'admin' ){
		
			if (!$id) {
				$this->Flash->set('Usuario inválido.', array('element' => 'error'));
				$this->redirect(array('action'=>'index'));
			}
			 
			$this->User->id = $id;
			if (!$this->User->exists()) {
				$this->Flash->set('Usuario inválido.', array('element' => 'error'));
				$this->redirect(array('action'=>'index'));
			}
			if ($this->User->saveField('status', 1)) {
				$this->Flash->set('El usuario ha sido re-activado.', array('element' => 'success'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('User was not re-activated'));
			$this->redirect(array('action' => 'index'));
		}
		else{
			$this->redirect(array('controller' => 'tcu', 'action' => 'index'));
		}
    }
	
	
	
	function forgetpwd(){
		
		if( !AuthComponent::user() ){
		
			if(!empty($this->data)){
				if(empty($this->data['User']['email'])){
					$this->Flash->set('Por favor indique su dirección de correo electrónico.', array('element' => 'warning'));
				}
				else{
					$email = $this->data['User']['email'];
					$user = $this->User->find('first',array('conditions'=>array('User.email' => $email)));
					if($user){

						$key = Security::hash(String::uuid(),'sha512',true);
						$hash = sha1($user['User']['username'].rand(0,100));
						$url = Router::url( array('controller'=>'users','action'=>'reset'), true ).'/'.$key;//.'#'.$hash;
						$ms = $url;
						$ms = wordwrap($ms,1000);
						//debug($url);
						$user['User']['tokenhash'] = $key;
						$this->User->id = $user['User']['id'];
						
						if($this->User->saveField('tokenhash',$user['User']['tokenhash'])){
							
							$mensaje = "<hr><br><p>Ingrese al siguiente enlace para restablecer su contraseña: </p><br><a href=".$ms.">Restablecer contraseña</a><br><br><hr>";
							$plantilla = file_get_contents(Router::url('/', true).'app/webroot/template/resetpwd.html');
							$plantilla = str_replace('{{mensaje}}', $mensaje, $plantilla);
							$mensaje = $plantilla;
							
							$subject = "TCU 593: Restablecer contraseña";
							$subject = '=?UTF-8?B?'.base64_encode($subject).'?=';
							$message = $mensaje;
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
							$headers .= 'From: TCU 593 <ucrtcu593@gmail.com>' . "\r\n";
							$to = $user['User']['email'];
							
							if( mail($to,$subject,$message,$headers) ){
								$this->Flash->set('Revise su correo para restablecer la contraseña.', array('element' => 'info'));
							}
							else{
								$this->Flash->set('Error enviando correo.', array('element' => 'error'));
							}
						}
						else{
							$this->Flash->set('Error, por favor intente nuevamente.', array('element' => 'error'));
						}
					}
					else{
						$this->Flash->set('Correo electrónico inválido.', array('element' => 'warning'));
					}
				}
			}
		}
		else{
			$this->redirect(array('controller' => 'tcu', 'action' => 'index'));
		}
	}
	
	
	function reset($token=null){
		
		if( !AuthComponent::user() ){
		
			if( $token != null ){
				
				$user = $this->User->find('first',array('conditions'=>array('User.tokenhash' => $token)));
				
				if( $user ){
					
					$this->User->id = $user['User']['id'];
					
					if( !empty($this->request->data) ){
						
						$this->User->data = $user;
						$new_hash = sha1($user['User']['username'].rand(0,100));//create new token
						$this->User->data['User']['tokenhash'] = $new_hash;
						$this->User->data['User']['password'] = $this->request->data['User']['password'];
						$this->User->data['User']['password_confirm'] = $this->request->data['User']['password_confirm'];
						
						if($this->User->save($this->User->data)){
							$this->Flash->set('La contraseña ha sido actualizada correctamente.', array('element' => 'success'));
							$this->redirect(array('action'=>'login'));
						}
						else{
							$this->Flash->set('Error actualizando contraseña.', array('element' => 'error'));
						}
					}
				}
				else{
					$this->Flash->set('El enlace para restablecer contraseña solo funciona una vez, por favor intente nuevamente.', array('element' => 'error'));
					$this->redirect(array('action' => 'login'));
				}
			}
			else{
				$this->redirect(array('action' => 'login'));
			}
		}
		else{
			$this->redirect(array('controller' => 'tcu', 'action' => 'index'));
		}
	}
 
}