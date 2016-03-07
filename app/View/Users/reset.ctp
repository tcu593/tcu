<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
<div class="col-md-6 voffset2">
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Restablecer contraseña</h3>
	</div>
	
	<!-- /.box-header -->
	<!-- form start -->
	<form role="form">
		<div class="box-body">
        	
			<label>Nueva contraseña</label>
			<div class="form-group has-feedback">
				<?php echo $this->Form->input('password' , array('label' => false,'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Contraseña' )); ?>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			
			<label>Confirmar contraseña</label>
			<div class="form-group has-feedback">
				<?php echo $this->Form->input('password_confirm' , array('label' => false,'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Contraseña' )); ?>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
		</div>
		<!-- /.box-body -->

		<div class="box-footer">
			<?php echo $this->Form->end(array('label' => __('Guardar'), 'class' => 'btn btn-primary')); ?>
			<br>
			<?php echo $this->Html->link( "Regresar",   array('action'=>'login') ); ?>			
		</div>
	</form>
</div>
</div>