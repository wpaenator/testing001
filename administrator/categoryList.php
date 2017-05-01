<?php 
session_start();
ob_start();

$return = "";
$returnID  = "";

include("db_connect.php");
$pro = new project();
$pro->db_connect();


$name = "";
$password = "";
$email = "";
$role = "";
$hideID = "";


if(isset($_POST['hideAct']))
{

	switch ($_POST['hideAct']){

		case 'Register':

						
			$name = $_POST['name'];
			$password = $_POST['pwd'];
			$email = $_POST['email'];
			$role = $_POST['role'];

			$return = $pro->RegisterStaff($name,$password,$email,$role);   

			break;

		case 'Edit':

						
			$name = $_POST['name'];
			$password = $_POST['pwd'];
			$email = $_POST['email'];
			$role = $_POST['role'];
			$hideID = $_POST['hideID'];

			$return = $pro->UpdateStaff($name,$password,$email,$role,$hideID);   

			break;			
		
		default:
			# code...
			break;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lumino - Forms</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	
	<?php include('menu-top.php') ; ?>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		
		<?php  include('menu.php') ; ?>

	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Admin</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Registration</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h3><a href='category.php'>Register Category</a></h3>
			</div>
		</div>		
		
	<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->
				<div class="row">
					<div class="col-xs-12">
						<table id="simple-table" class="table  table-bordered table-hover">
							<thead>
								<tr>
									
									<th>Name</th>
									<th>Description</th>
								</tr>
							</thead>

							<tbody>
								
								<?php 

								echo $pro->catgoryList();
								?>

							</tbody>

						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
		
	</div><!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
