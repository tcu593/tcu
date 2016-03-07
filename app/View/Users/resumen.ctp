<div class="col-md-6 voffset2">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <h3 class="profile-username text-center">
			<img class="img-responsive" src="/app/webroot/img/user.png" alt="User profile picture">
			<?php echo $user['User']['username']; ?></h3>
            <p class="text-muted text-center"><?php echo $user['User']['role']; ?></p>
            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">                    <b>Nombre de usuario:    </b><?php echo $user['User']['username']; ?>                </li>
                <li class="list-group-item">                    <b>Correo electrónico:    </b><?php echo $user['User']['email']; ?>                </li>
                <li class="list-group-item">                    <b>Rol de usuario:    </b><?php echo $user['User']['role']; ?>                </li>
                <li class="list-group-item">                    <b>Fecha de creación:    </b> <?php echo $user['User']['created']; ?>                </li>
                <li class="list-group-item">                    <b>Estado:    </b> <?php if ($user['User']['status'] == 1){echo 'Activo';}else{echo 'Desactivdo';} ?></h2>                </li>
            </ul>
            <div class="box-footer">				<?php echo $this->Html->link( "Regresar", array('action'=>'index'), array( 'class' => 'btn btn-primary') ); ?>				<?php echo $this->Html->link( "Editar",   array('action'=>'edit', $user['User']['id']), array( 'class' => 'btn btn-primary') ); ?>            </div>
        </div>
    </div>
</div>