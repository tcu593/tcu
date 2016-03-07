<?php if(AuthComponent::user() && AuthComponent::user('role') === 'admin'){ ?>
<div class="users form">
<h1>Usuarios</h1>
<div class="table-responsive">
<table id="example">
    <thead>
        <tr>
            <th><?php echo $this->Form->checkbox('all', array('name' => 'CheckAll',  'id' => 'CheckAll')); ?></th>
            <th><?php echo $this->Paginator->sort('username', 'Nombre Usuario');?>  </th>
            <th><?php echo $this->Paginator->sort('email', 'E-Mail');?></th>
            <th><?php echo $this->Paginator->sort('created', 'Fecha Creación');?></th>
            <th><?php echo $this->Paginator->sort('modified','Última Actualización');?></th>
            <th><?php echo $this->Paginator->sort('role','Rol');?></th>
            <th><?php echo $this->Paginator->sort('status','Estado');?></th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>                       
        <?php $count=0; ?>
        <?php foreach($users as $user): ?>                
        <?php $count ++;?>
        <?php if($count % 2): echo '<tr>'; else: echo '<tr class="zebra">' ?>
        <?php endif; ?>
            <td><?php echo $this->Form->checkbox('User.id.'.$user['User']['id']); ?></td>
            <td><?php echo $this->Html->link( $user['User']['username']  ,   array('action'=>'resumen', $user['User']['id']),array('escape' => false) );?></td>
            <td style="text-align: center;"><?php echo $user['User']['email']; ?></td>
            <td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['created']); ?></td>
            <td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['modified']); ?></td>
            <td style="text-align: center;"><?php echo $user['User']['role']; ?></td>
            
			<td style="text-align: center;">
			<?php 
				if ( $user['User']['status'] == 1 ){
					echo 'Activo';
				}
				else if ( $user['User']['status'] == 0 ){
					echo 'Desactivado';
				}
			?>
			</td>
            
			<td >
            <?php echo $this->Html->link(    "Editar",   array('action'=>'edit', $user['User']['id']) ); ?> | 
            <?php
                if( $user['User']['status'] != 0){ 
                    echo $this->Html->link(    "Borrar", array('action'=>'delete', $user['User']['id']));}else{
                    echo $this->Html->link(    "Reactivar", array('action'=>'activate', $user['User']['id']));
                    }
            ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php unset($user); ?>
    </tbody>
</table>
</div>
</div>
<?php 	}else{
			echo 'ACCESO DENEGADO';
		}
?>
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/dt/pdfmake-0.1.18,dt-1.10.11,b-1.1.2,b-flash-1.1.2,b-html5-1.1.2,b-print-1.1.2,cr-1.3.1,r-2.0.2,rr-1.1.1,sc-1.4.1,se-1.1.2/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/t/dt/pdfmake-0.1.18,dt-1.10.11,b-1.1.2,b-flash-1.1.2,b-html5-1.1.2,b-print-1.1.2,cr-1.3.1,r-2.0.2,rr-1.1.1,sc-1.4.1,se-1.1.2/datatables.min.js"></script>


<script type="text/javascript">
	$(document).ready(function() {
		$('#example').dataTable( {
		"aLengthMenu": [[10, 50, 75, -1], [10, 50, 75, "All"]],
		"pageLength": 10
		});
	} );
</script>