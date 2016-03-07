<!-- app/View/Users/edit.ctp -->
<div class="users form">
<?php echo $this->Form->create('User'); ?>

<div class="col-md-6 voffset2">
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Editar Usuario</h3>
	</div>

	<form role="form">
		<div class="box-body">
			<div class="form-group">	
				<?php echo $this->Form->hidden('id' , array('label' => 'Usuario', 'class' => 'form-control', 'value' => $this->data['User']['id'])); ?>
			</div>
			<div class="form-group">	
				<?php echo $this->Form->hidden('username' , array('label' => 'Los nombres de usuario no pueden cambiarse', 'class' => 'form-control', 'readonly' => 'readonly')); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('email' , array('label' => 'Correo Electrónico','type' => 'text', 'class' => 'form-control', 'placeholder' => 'Correo electrónico' )); ?>
			</div>
        	<div class="form-group">
				<?php echo $this->Form->input('password_update' , array('label' => 'Contraseña Nueva (déjela en blanco si desea conservarla)','maxLength' => 255, 'type'=>'password', 'required' => 0, 'class' => 'form-control', 'placeholder' => 'Digite contraseña' )); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('password_confirm_update' , array('label' => 'Confirmar Contraseña*', 'maxLength' => 255,'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Volver a escribir la contraseña' , 'required' => 0)); ?>
			</div>
			<div class="form-group">
				<?php 
				if( AuthComponent::user('role') === 'admin' ){
					echo $this->Form->input('role', array('label' => 'Rol','class' => 'form-control', 'options' => array('invitado' => 'Invitado', 'visitante' => 'Visitante', 'admin' => 'Admin')));
				}
				?>
			</div>
		</div>

		<div class="box-footer">
			<?php 
				echo $this->Form->end(array('label' => __('Listo'), 'class' => 'btn btn-primary'));
			?>
			<br>
			<?php 
				if( AuthComponent::user('role') === 'admin' ){
					echo $this->Html->link( "Regresar",   array('action'=>'index') );
				}
				else if( AuthComponent::user('role') === 'visitante' || AuthComponent::user('role') === 'invitado' ){
					echo $this->Html->link( "Regresar",   array('action'=>'resumen', AuthComponent::user('id')) );
				}
			?>
		</div>
	</form>
<?php echo $this->Form->end(); ?>
</div>

