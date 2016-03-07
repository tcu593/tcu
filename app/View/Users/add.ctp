<!-- app/View/Users/add.ctp -->
<?php echo $this->Form->create('User');?>
<div class="col-md-6 voffset2">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Crear cuenta de usuario</h3>
		</div>
	
	<form role="form">
		<div class="box-body">
			
			<label>Usuario</label>
			<div class="form-group has-feedback">	
				<?php echo $this->Form->input('username' , array('label' => false, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nombre de usuario' )); ?>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			
			<label>Correo electrónico</label>
			<div class="form-group has-feedback">
				<?php echo $this->Form->input('email' , array('label' => false,'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Correo electrónico' )); ?>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			
			<label>Contraseña</label>
			<div class="form-group has-feedback">
				<?php echo $this->Form->input('password' , array('label' => false,'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Contraseña' )); ?>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			
			<label>Confirmar Contraseña*</label>
			<div class="form-group has-feedback">
				<?php echo $this->Form->input('password_confirm' , array('label' => false, 'maxLength' => 255,'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Volver a escribir la contraseña' )); ?>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			
			
			<div class="form-group has-feedback">
			<?php 
				if(AuthComponent::user() && AuthComponent::user('role') === 'admin'){
					echo $this->Form->input('role', array('label' => 'Rol',
					'class' => 'form-control', 'options' => array('invitado' => 'Invitado', 'visitante' => 'Visitante', 'admin' => 'Admin')));
				}
				else{
					echo $this->Form->input('role', array('type' => 'hidden', 'value' => 'invitado'));
				}
			?>	
			</div>
			
		</div>

		<div class="box-footer">
			<?php echo $this->Form->submit('Crear', array('class' => 'btn btn-primary',  'title' => 'Haga click para crear el usuario') ); ?>
			<?php echo $this->Form->end(); ?>
		</div>
	</form>
</div>
</div>