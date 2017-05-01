<?php 
$return = "";
$returnID  = "";

include("db_connect_two.php");
$pro = new projectTwo();
$pro->db_connect();


$name = "";
$desp = "";
$price = "";
$discount = "";
$catID = "";
$img = "";

if(isset($_POST['hideAct']))
{

	switch ($_POST['hideAct']){

		case 'Register':

						
			$name = $_POST['name'];
			$desp = $_POST['desp'];
			$price = $_POST['price'];
			$discount = $_POST['discount'];
			$catID =$_POST['catID'];
			$img =  $_POST['img'];


			$return = $pro->registerProduct($name,$desp,$price,$discount,$catID,$img)  ;

			break;

		case 'Edit':

						
			$name = $_POST['name'];
			$desp = $_POST['desp'];
			$price = $_POST['price'];
			$discount = $_POST['discount'];
			$catID =$_POST['catID'];
			$img =  $_POST['img'];
			$hideID = $_POST['hideID'];

			$return = $pro->updateProduct($name,$desp,$price,$discount,$catID,$hideID,$img);   

			break;			
		
		default:
			# code...
			break;
	}
}
?>
<?php include('head.php') ; ?>

<body>
	
	<?php include('menu-top.php') ; ?>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		
		<?php  include('menu.php') ; ?>

	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Products</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Products</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Products</div>
					<div class="panel-body">
						<div class="col-md-6">
							<form role="form" method="post" action="product.php" >
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
									<select class="form-control" name='catID'>


										<?php if(isset($_REQUEST['id']) && $_REQUEST['id'] != "") 
										{
											echo $pro->getCategoryList($pro->getProductInfo($_REQUEST['id'])->catID) ;
											}
											else
												{
													echo $pro->getCategoryList("0") ; } ?>
									</select>
								</div>

								<div class="form-group">
									<label>Name</label>
									<input type="text" class="form-control" name="name"  value="<?php 

												if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
												{
													echo $pro->getProductInfo($_REQUEST['id'])->pName ;
												}

											?>" />
								</div>
												
								<div class="form-group">
									<label>Description</label>
									<input type="text" class="form-control" name="desp" value="<?php 

												if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
												{
													echo $pro->getProductInfo($_REQUEST['id'])->desp ;
												}

											?>" />
								</div>

								<div class="form-group">
									<label>Price</label>
									<input type="text" class="form-control" name="price" value="<?php 

												if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
												{
													echo $pro->getProductInfo($_REQUEST['id'])->price ;
												}

											?>" />
								</div>

								<div class="form-group">
									<label>Discount</label>
									<input  type="text"  class="form-control" name="discount" value="<?php 

												if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
												{
													echo $pro->getProductInfo($_REQUEST['id'])->discount ;
												}

											?>" />
								</div>

								<div class="form-group">
									<label>Image File Name</label>
									<input   type="text" class="form-control" name="img" value="<?php 

												if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
												{
													echo $pro->getProductInfo($_REQUEST['id'])->img ;
												}

											?>" />
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
