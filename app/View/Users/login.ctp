<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
<div class="col-md-6 voffset2">
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Iniciar Sesión</h3>
	</div>
	
	<!-- /.box-header -->
	<!-- form start -->
	<form role="form">
		<div class="box-body">
			
			
			<label>Usuario</label>
			<div class="form-group has-feedback">	
				<?php echo $this->Form->input('username' , array('label' => false, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nombre de usuario' )); ?>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			
        	
			<label>Contraseña</label>
			<div class="form-group has-feedback">
				<?php echo $this->Form->input('password' , array('label' => false,'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Contraseña' )); ?>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
		</div>
		<!-- /.box-body -->

		<div class="box-footer">
			<?php echo $this->Form->end(array('label' => __('Iniciar Sesión'), 'class' => 'btn btn-primary')); ?>
			<br>
			<?php echo $this->Html->link( "Registrarse",   array('action'=>'add') ); ?>
			<div class="pull-right"> <?php echo $this->Html->link( "¿Olvidó su contraseña?",   array('action'=>'forgetpwd') ); ?> </div>			
		</div>
	</form>
</div>
</div>