<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
<div class="col-md-6 voffset2">
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Recuperar contraseña</h3>
	</div>
	
	<!-- /.box-header -->
	<!-- form start -->
	<form role="form">
		<div class="box-body">
        	
			<label>Correo electrónico</label>
			<div class="form-group has-feedback">
				<?php echo $this->Form->input('email' , array('label' => false,'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Correo electrónico' )); ?>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<p class="help-block">Indique su dirección de correo electrónico para restablecer la contraseña.</p>
			
		</div>
		<!-- /.box-body -->

		<div class="box-footer">
			<?php echo $this->Form->end(array('label' => __('Enviar'), 'class' => 'btn btn-primary')); ?>
			<br>
			<?php echo $this->Html->link( "Regresar",   array('action'=>'login') ); ?>			
		</div>
	</form>
</div>
</div>