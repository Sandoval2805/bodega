<?php
require 'config.php';
require 'inc/session.php';
require 'inc/home_core.php';
if($_session->isLogged() == false)
	header('Location: index.php');

$_page = 1;

$role = $_session->get_user_role();
if($role != 1 && $role != 2)
	header('Location: items.php');

if(isset($_POST['act']) && $_POST['act'] == 'reqinfo') {
	$interval = $_POST['int'];
	
	$res = array(
		$_home->get_new_items($interval),
		$_home->get_checked_in($interval),
		$_home->get_checked_out($interval),
	);
	
	$_check_in_price = $_home->get_checked_in_price($interval);
	$_check_out_price = $_home->get_checked_out_price($interval);
	
	$res[] = '$'.$_check_in_price;
	$res[] = '$'.$_check_out_price;
	
	$res = implode('|', $res);
	
	echo $res;
	die();
}
?>
<!DOCTYPE HTML>
<html>
<?php require 'inc/head.php'; ?>
<body>
	<div id="main-wrapper">
	  <?php require 'inc/header.php'; ?>
	  <div class="wrapper-pad">
			<h2>Home</h2>
			<ul id="selectors">
				<li class="selected" value="today">HOY</li>
				<li value="this_week">ESTA SEMANA</li>
				<li value="this_month">ESTE MES</li>
				<li value="this_year">ESTE AÑO</li>
				<li value="all_time">TODO EL TIEMPO</li>
			</ul>
			
			<div id="fdetails">
				<div class="element">
					<span><?php echo $_home->get_new_items('today'); ?></span><br />
					NUEVO<br />
					ITEMS
				</div>
				<div class="element">
					<span><?php echo $_home->get_checked_in('today'); ?></span><br />
					INGRESADOS<br />
					(QTY TOTAL)
				</div>
				<div class="element">
					<span><?php echo $_home->get_checked_out('today'); ?></span><br />
					SACADOS<br />
					(QTY TOTAL)
				</div>
				<div class="element">
					<span>$<?php echo $_check_in_price = $_home->get_checked_in_price('today'); ?></span><br />
					REGISTRAR
				</div>
				<div class="element">
					<span>$<?php echo $_check_out_price = $_home->get_checked_out_price('today'); ?></span><br />
					CONTROLAR
				</div>
			</div>
	  </div>
		
		<div class="clear" style="margin-bottom:40px;height:1px;"></div>
		<div class="border" style="margin-bottom:30px;"></div>
		
		<div class="wrapper-pad">
			<h3>GENERAL </h3>
			<div id="f2details">
				<div class="element">
					<span><?php echo $_home->general_registered_items(); ?></span><br />
					REGISTRADOS<br />
					ITEMS
				</div>
				<div class="element">
					<span><?php echo $_home->general_warehouse_items(); ?></span><br />
					ALMACENADOS<br />
					ITEMS (QTY)
				</div>
				<div class="element">
					<span>$<?php echo $_home->general_warehouse_value(); ?></span><br />
					VALOR EN EL ALMACEN </div>
				<div class="element">
					<span>$<?php echo $_home->general_warehouse_checked_out(); ?></span><br />
					VALOR COMPROBADO </div>
			</div>
		</div>
		
		<div class="clear" style="height:50px;"></div>
</div>
</body>
</html>