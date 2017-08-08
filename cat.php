<?php
require 'config.php';
require 'inc/session.php';
require 'inc/categories_core.php';
if($_session->isLogged() == false)
	header('Location: index.php');

$_page = 15;

if(!isset($_GET['id']))
	header('Location: categories.php');
$cat = $_cats->get_cat($_GET['id']);
if(!$cat->id)
	header('Location: categories.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<?php require 'inc/head.php'; ?>
</head>
<body>
	<div id="main-wrapper">
		<?php require 'inc/header.php'; ?>
		
		<div class="wrapper-pad">
			<h2>Detalle Categoria </h2>
			<div class="center">
				<div class="new-cat form">
					Categoria ID:<br />
					<div class="ni-cont light">
						<?php echo $cat->id; ?><br /><br />
					</div>
					Categoria Nombre:<br />
					<div class="ni-cont light">
						<?php echo $cat->name; ?><br /><br />
					</div>
					Categoria Lugar:<br />
					<div class="ni-cont light">
						<?php echo $cat->place; ?><br /><br />
					</div>
					<span class="ncat-desc-left"> Descripcion:</span>
					<div class="ni-cont light">
						<?php echo $cat->descrp; ?><br /><br />
					</div>
				</div>
			</div>
		</div>
		
		<div class="clear" style="margin-bottom:40px;"></div>
		<div class="border" style="margin-bottom:30px;"></div>
	</div>
</body>
</html>