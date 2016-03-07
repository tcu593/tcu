<?php
App::uses('AuthComponent', 'Controller/Component');
 
class User extends AppModel {
     
    public $avatarUploadDir = 'img/avatars';
     
    public $validate = array(
        'username' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Nombre de usuario requerido.',
                'allowEmpty' => false
            ),
            'between' => array( 
                'rule' => array('between', 5, 15), 
                'required' => true, 
                'message' => 'El nombre de usuario debe contener entre 5 y 15 caractéres.'
            ),
             'unique' => array(
                /*'rule'    => array('isUniqueUsername'),*/				'rule' => 'isUnique',
                'message' => 'El nombre de usuario ya se encuentra en uso.'
            ),
            'alphaNumericDashUnderscore' => array(
                'rule'    => array('alphaNumericDashUnderscore'),
                'message' => 'El nombre de usuario sólo puede contener letras, números y guión bajo (_).'
            ),
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Se requiere una contraseña.'
            ),
            'min_length' => array(
                'rule' => array('minLength', '6'),  
                'message' => 'La contraseña debe tener al menos 6 caractéres.'
            )
        ),
         
        'password_confirm' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Por favor confirme la contraseña.'
            ),
             'equaltofield' => array(
                'rule' => array('equaltofield','password'),
                'message' => 'Las contraseñas no coinciden.'
            )
        ),
         
        'email' => array(
            'required' => array(
                'rule' => array('email', true),    
                'message' => 'Por favor introduzca un correo válido.'   
            ),
             'unique' => array(
                /*'rule'    => array('isUniqueEmail'),*/				'rule' => 'isUnique',
                'message' => 'Este correo ya se encuentra en uso.',
            ),
            'between' => array( 
                'rule' => array('between', 6, 60), 
                'message' => 'El usuario del correo de tener entre 6 y 60 caractéres.'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'visitante', 'invitado')),
                'message' => 'Por favor indique un rol válido.',
                'allowEmpty' => false
            )
        ),
         
         
        'password_update' => array(
            'min_length' => array(
                'rule' => array('minLength', '6'),   
                'message' => 'La contraseña debe tener al menos 6 caractéres.',
                'allowEmpty' => true,
                'required' => false
            )
        ),
        'password_confirm_update' => array(
             'equaltofield' => array(
                'rule' => array('equaltofield','password_update'),
                'message' => 'Las contraseñas no coinciden.',
                'required' => false,
            )
        )
 
         
    );
     
        /**
     * Before isUniqueUsername
     * @param array $options
     * @return boolean
     */
    function isUniqueUsername($check) {
 
        $username = $this->find(
            'first',
            array(
                'fields' => array(
                    'User.id',
                    'User.username'
                ),
                'conditions' => array(
                    'User.username' => $check['username']
                )
            )
        );
 
        if(!empty($username)){						echo "data alias: \n";			echo $this->data[$this->alias]['username'];			
            if( /*$this->data[$this->alias]['id'] == null &&*/ $this->data[$this->alias]['username'] == $username['User']['username'] ){				return false;			}						/*else if($this->data[$this->alias]['id'] == $username['User']['id']){
                return true; 
            }*/			else{
                return true;//false; 
            }
        }else{
            return true; 
        }
    }
 
    /**
     * Before isUniqueEmail
     * @param array $options
     * @return boolean
     */
    function isUniqueEmail($check) {
 
        $email = $this->find(
            'first',
            array(
                'fields' => array(
                    'User.id'
                ),
                'conditions' => array(
                    'User.email' => $check['email']
                )
            )
        );
 
        if(!empty($email)){
            if($this->data[$this->alias]['id'] == $email['User']['id']){
                return true; 
            }else{
                return false; 
            }
        }else{
            return true; 
        }
    }
     
    public function alphaNumericDashUnderscore($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];
 
        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }
     
    public function equaltofield($check,$otherfield) 
    { 
        //get name of field 
        $fname = ''; 
        foreach ($check as $key => $value){ 
            $fname = $key; 
            break; 
        } 
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname]; 
    } 
 
    /**
     * Before Save
     * @param array $options
     * @return boolean
     */
     public function beforeSave($options = array()) {
        // hash our password
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
         
        // if we get a new password, hash it
        if (isset($this->data[$this->alias]['password_update']) && !empty($this->data[$this->alias]['password_update'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password_update']);
        }
     
        // fallback to our parent
        return parent::beforeSave($options);
    }
 
}