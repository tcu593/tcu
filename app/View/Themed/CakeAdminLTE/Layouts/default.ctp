<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'TCU 593');
?>
<?php echo $this->Html->docType('html5'); ?>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>

		<title>
			<?php echo $cakeDescription ?>:
			<?php echo $this->fetch('title'); ?>
		</title>
		<?php
			/*echo $this->Html->meta('icon');
			echo $this->Html->meta(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no']);
			echo $this->fetch('meta');

			echo $this->Html->css('bootstrap.min.css');
			echo $this->Html->css('//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css');
			echo $this->Html->css('ionicons.min.css');
			echo $this->Html->css('//fonts.googleapis.com/css?family=Droid+Serif:400,700,700italic,400italic');
			echo $this->Html->css('CakeAdminLTE');
			echo $this->fetch('css');
			//echo $this->Html->script('libs/jquery-1.10.2.min');
			//echo $this->Html->script('libs/bootstrap.min');

			echo $this->fetch('script');*/
			echo $this->Html->meta('icon');
			echo $this->Html->meta(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no']);
			echo $this->fetch('meta');
			echo $this->Html->css('bootstrap.3.3.4.min');
			echo $this->Html->css('AdminLTE.min');
			echo $this->Html->css('skins/_all-skins.min.css');
		?>
		<!-- Font Awesome Icons -->
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Ionicons -->
		<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
		<link href="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.css" rel="stylesheet" type="text/css">
		<!-- Theme style -->
		<!-- AdminLTE Skins. Choose a skin from the css/skins
		     folder instead of downloading all of them to reduce the load. -->

	</head>

	<body class="skin-blue sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
				<?php echo $this->element('menu/top_menu'); ?>
			</header>
	      	<!-- Left side column. contains the logo and sidebar -->
	      	<aside class="main-sidebar">
				<?php echo $this->element("menu/left_sidebar_tcu"); ?>
			</aside>
		    <!-- Content Wrapper. Contains page content -->
		    <div class="content-wrapper">
		    	<!-- Content Header (Page header) -->
		    	<section class="content-header">
				    <h1>

				    </h1>
				</section>

				<section class="content">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
				</section>
			</div><!-- /.right-side -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<!--<b>Version</b> 0.667-->
				</div>
				<strong>TC-593 </strong> Intercambio de Conocimientos con los Artesanos de Alajuela.
			</footer>


		</div><!-- ./wrapper -->




		<?php
			//echo $this->fetch('script');
			echo $this->Html->script('plugins/jQuery/jQuery-2.1.4.min.js');
			echo $this->Html->script('bootstrap.3.3.4.min.js');
			echo $this->Html->script('app.min.js');
			echo $this->Html->script('https://cdn.datatables.net/t/dt/pdfmake-0.1.18,dt-1.10.11,b-1.1.2,b-flash-1.1.2,b-html5-1.1.2,b-print-1.1.2,cr-1.3.1,r-2.0.2,rr-1.1.1,sc-1.4.1,se-1.1.2/datatables.min.js');
		?>		<!-- jQuery 2.1.4 -->

	</body>

</html>
