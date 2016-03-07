
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="info" style="position: initial; text-align: center;">
                <p style="margin: 0px;">Hola <?php echo AuthComponent::user('username');/*$nombreApellidoDelUsuario;*/?></p>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li>
                    <a href="<?php echo $this->webroot;?>">
                        <i class="fa fa-home"></i> <span>Inicio</span>
                    </a>
            </li>
            <?php if(AuthComponent::user() && (AuthComponent::user('role') === 'admin' || AuthComponent::user('role') === 'visitante')){ ?>
			<li class="treeview">
                <a href="<?php echo $this->webroot;?>encuesta">
                    <i class="fa  fa-pencil-square-o"></i> <span>Encuesta</span>
                </a>
            </li>
			<?php } ?>
			
			
			<?php if(AuthComponent::user()){ ?>
			<li class="treeview">
                <a href='#'>
                    <i class="fa fa-bar-chart"></i> <span>Resultados</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					
                    <li>
						<a href="<?php echo $this->webroot;?>encuesta/datos"><i class="fa fa-angle-double-right"></i>Ver resultados</a>
					</li>
					<?php if(AuthComponent::user('role') === 'admin' || AuthComponent::user('role') === 'visitante' ){ ?>
                    <li>
						<a href="https://docs.google.com/forms/d/1hVQVEE7W3jW0PhpXUsNSII59kE9ZA9JntR-FsCan3e8/viewanalytics" target="_blank"><i class="fa fa-angle-double-right"></i>Resumen</a>
					</li>
					<?php } ?>
					<?php if(AuthComponent::user('role') === 'admin' ){ ?>
					<li>
						<a href="<?php echo $this->webroot;?>encuesta/editar_datos"><i class="fa fa-angle-double-right"></i>Editar Datos</a>
					</li>
					<?php } ?>
					<?php if(AuthComponent::user('role') === 'admin' || AuthComponent::user('role') === 'visitante' ){ ?>
                    <li>
						<a href="https://spreadsheets.google.com/feeds/download/spreadsheets/Export?key=1TMTWGNX-04tBIJ7cogGMuNug_0tXrxAyQBMukb8ga48&exportFormat=xlsx" target="_blank"><i class="fa fa-download"></i>Descargar Resultados</a>
					</li>
					<?php } ?>
					
                </ul>
            </li>
			<?php } ?>
			
			<?php if(AuthComponent::user() && AuthComponent::user('role') === 'admin'){ ?>
			<li>
				<a href="https://docs.google.com/forms/d/1hVQVEE7W3jW0PhpXUsNSII59kE9ZA9JntR-FsCan3e8/edit#" target="_blank">
                    <i class="fa   fa-pencil"></i> <span>Editar Encuesta</span>
                </a>
            </li>
			<?php } ?>
<!--
            <li class="treeview">
                <a href='#'>
                    <i class="fa fa-users"></i> <span>Artesanos</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-angle-double-right"></i>Opción1</a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i>Opción2</a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i>Opción3</a></li>
                </ul>
            </li>
-->
			<?php if(AuthComponent::user() && AuthComponent::user('role') === 'admin'){ ?>
            <li class="treeview">
                <a href='#'>
                    <i class="fa fa-users"></i> <span>Usuarios</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->webroot;?>users"><i class="fa fa-angle-double-right"></i>Lista de usuarios</a></li>
                    <li><a href="<?php echo $this->webroot;?>users/add"><i class="fa fa-angle-double-right"></i>Añadir usuario</a></li>
                </ul>
            </li>
			
			<li class="treeview">
                <a href='#'>
                    <i class="fa fa-question-circle"></i> <span>Ayuda</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="javascript:googleLogin();"></i>Iniciar sesión en Google</a></li>
                </ul>
            </li>
			<?php } ?>
        </ul>
    </section>
    <!-- /.sidebar -->
<script>
function googleLogin() {
    window.open("https://accounts.google.com/", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=500, width=400, height=400");
}
</script>