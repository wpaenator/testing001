<?php 
session_start();
ob_start();

$return = "";
$returnID  = "";

include("db_connect.php");
$pro = new project();
$pro->db_connect();


$name = "";
$desp = "";


if(isset($_POST['hideAct']))
{

	switch ($_POST['hideAct']){

		case 'Register':

						
			$name = $_POST['name'];		
			$desp = $_POST['desp'];

			$return = $pro->categoryRegister($name,$desp);   

			break;

		case 'Edit':

						
			$name = $_POST['name'];		
			$desp = $_POST['desp'];
			$hideID = $_POST['hideID'];
			$return = $pro->updateCategory($name,$desp,$hideID);   

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
				<li class="active">Category</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Admin</div>
					<div class="panel-body">
						<div class="col-md-6">
							<form role="form" method="post" action="category.php" >
							    <?php 

							    	if($return != "")
							    	{
							    ?>
							    	<div class="form-group has-success">
										<input class="form-control" placeholder="<?php echo $return ;  ?>">
									</div>
							    <?php 
							    	}

							    ?>
								

								<div class="form-group">
									<label>Category</label>
									<input type="text" class="form-control" name="name"  value="<?php 

												if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
												{
													echo $pro->getCategoryInfo($_REQUEST['id'])->name ;
												}

											?>">
								</div>


								<div class="form-group">
									<label>Description</label>
									<input  type="text"  class="form-control" name="desp" value="<?php 

												if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
												{
													echo $pro->getCategoryInfo($_REQUEST['id'])->desp ;
												}

											?>">
								</div>

								

								<input type="hidden"  name="hideAct" value="<?php 

												if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
												{
													echo "Edit" ;
												}
												else
												{
													echo "Register";
												}

											?>" />
								<input type="hidden"  name="hideID" value="<?php 

												if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
												{
													echo $_REQUEST['id'];
												}

											?>" />

								<button type="submit" class="btn btn-primary">Submit Button</button>
								<button type="reset" class="btn btn-default">Reset Button</button>
								
								
							</div>
							
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
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
