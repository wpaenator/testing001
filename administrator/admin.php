<?php include('head.php') ; ?>
<?php 

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
				<div class="panel panel-default">
					<div class="panel-heading">Admin</div>
					<div class="panel-body">
						<div class="col-md-6">
							<form role="form" method="post" action="admin.php" >
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
									<label>Name</label>
									<input type="text" class="form-control" name="name"  value="<?php 

												if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
												{
													echo $pro->getStaffInfo($_REQUEST['id'])->name ;
												}

											?>">
								</div>
																
								<div class="form-group">
									<label>Password</label>
									<input type="password" class="form-control" name="pwd">
								</div>

								<div class="form-group">
									<label>Confirmed Password</label>
									<input type="password" class="form-control" name="compwd">
								</div>

								<div class="form-group">
									<label>Email</label>
									<input  type="text"  class="form-control" name="email" value="<?php 

												if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
												{
													echo $pro->getStaffInfo($_REQUEST['id'])->email ;
												}

											?>">
								</div>

								<div class="form-group">
									<label>Role</label>
									<input   type="text" class="form-control" name="role" value="<?php 

												if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
												{
													echo $pro->getStaffInfo($_REQUEST['id'])->role ;
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
