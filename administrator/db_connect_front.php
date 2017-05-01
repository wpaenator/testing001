<?php 

class projectFront{
	
	var $host = "localhost";
	var $user = "root";
	var $pwd  = "";
	var $db   = "db_watch";
	
		function db_connect(){
			
			$link = mysqli_connect($this->host,$this->user,$this->pwd,$this->db);
			
			if (mysqli_connect_errno()) 
			{
				echo "Connect failed: %s\n", mysqli_connect_error() ;
				exit();
			}

			return $link;
		}


		public function catgoryList()
		{
			$state = " SELECT * FROM `tbl_category` ORDER BY `id` DESC  ";

			$return = "";

			$link = $this->db_connect();

			if($result = mysqli_query($link,$state))
			{

				while($obj = $result->fetch_object())
				{

					$return  .= "<li><a href='#'><span class='icon-chevron-right'></span>".$obj->name."</a></li>";					
				}
			}
			else
				{	
					$return = " Could not rental ! ".mysqli_error();
				}

			return $return;	

		}


		public function catgoryListDetail()
		{
			$state = " SELECT * FROM `tbl_category` ORDER BY `id` DESC  ";

			$return = "";

			$link = $this->db_connect();

			if($result = mysqli_query($link,$state))
			{

				while($obj = $result->fetch_object())
				{
					?>

					

					  <h3><?php echo $obj->name ; ?></h3>	
				      <p><?php echo $obj->desp ; ?></p>

				    	<!--close button_small-->

				    <!--close content_container-->
						
					<?php				
				}
			}
			else
				{	
					$return = " Could not select Doctor  ".mysqli_error();
				}

			return $return;	

		}


		public function productList()
		{

			$return = "";

			$state = " SELECT ";
			$state .= "tbl_watch_product.id, ";
			$state .= "tbl_watch_product.desp, ";
			$state .= "tbl_watch_product.pName, ";
			$state .= "tbl_watch_product.price, ";
			$state .= "tbl_watch_product.discount, ";
			$state .= "tbl_watch_product.catID, ";
			$state .= "tbl_watch_product.img, ";
			$state .= "tbl_category.name ";
			$state .= "FROM ";
			$state .= "tbl_watch_product ";
			$state .= "Inner Join tbl_category ON tbl_category.id = tbl_watch_product.catID ";

			$state .= " ORDER BY tbl_watch_product.id  ";

			$link = $this->db_connect();
			$count = 0 ;

			if($result = mysqli_query($link,$state))
			{
				
				while($obj = $result->fetch_object())
				{
			?>
			  	<li class="last simpleCart_shelfItem">
						<a class="cbp-vm-image"  href="single.php?id=<?php echo $obj->id ; ?>">
							<div class="view view-first">
				   		  <div class="inner_content clearfix">
							<div class="product_image">
								<div class="mask1"><img src="images/m3.jpg" alt="image" class="img-responsive zoom-img"></div>
								<div class="mask">
		                       		<div class="info">Make Order</div>
				                  </div>
								<div class="product_container">
								   <h4><?php echo $obj->pName ;?></h4>
								   <p><?php echo $obj->pName ; ?></p>
								    <div class="price mount item_price">$<?php echo $obj->price ; ?></div>
								    
								 </div>		
							  </div>
		                     </div>
	                      </div>
						</a>
					</li>
			<?php
				}
					
			}
			else
				{	
					$return .= " Could not select Doctor  ".mysqli_error();
				}

			return $return ;	
		}


		public function getProductInfo($id)
		{

			$state = " SELECT ";
			$state .= "tbl_watch_product.id, ";
			$state .= "tbl_watch_product.desp, ";
			$state .= "tbl_watch_product.pName, ";
			$state .= "tbl_watch_product.price, ";
			$state .= "tbl_watch_product.discount, ";
			$state .= "tbl_watch_product.catID, ";
			$state .= "tbl_watch_product.img, ";
			$state .= "tbl_category.name ";
			$state .= "FROM ";
			$state .= "tbl_watch_product ";
			$state .= "Inner Join tbl_category ON tbl_category.id = tbl_watch_product.catID ";

			$state .= " WHERE tbl_watch_product.id = '".$id."' ";

			$return = "";

			$link = $this->db_connect();

			if($result = mysqli_query($link,$state))
			{
				$return = $result->fetch_object();
			}
			else
			{
				$return = "Sql Connection Error".mysqli_error();
			}

			return $return ;

		}


		// Order Info 

		public function getOrderNo()
		{
			$state = "SELECT * FROM `tbl_order` ";

			$return = "";
			$counter = 1;
			$link = $this->db_connect();

			if($result = mysqli_query($link,$state))
			{
				$row_cnt = $result->num_rows;

				if($row_cnt == 0)
				{
					$return = "orderCode_".$counter;
				}
				else
				{
					$row_cnt = $row_cnt + 1;
					$return = "orderCode_".$row_cnt;
				}
			}
			else
			{
				$return = "Sql Connection Error".mysqli_error();
			}

			return $return ;

		}


		public function addnewOrder($orderID,$date,$contactInfo,$status,$productID)
		{
			$state = " INSERT INTO `tbl_order` (`orderID`,`date`,`contactInfo`,`status`) VALUES ('".$orderID."','".$date."','".$contactInfo ."','".$status."') ";

			$return = "";

			$link = $this->db_connect();

			if($result = mysqli_query($link,$state))
			{

				$orderDetailState = " INSERT INTO `tbl_order_detail` (`orderID`,`productID`) VALUES ('".$orderID."','".$productID."') ";

				if($detailResult = mysqli_query($link,$orderDetailState))
				{
					$lastRecord = "SELECT * FROM `tbl_order` WHERE `orderID` = '".$orderID."' ";

				 	if($lastRecordResult = mysqli_query($link,$lastRecord))
				 	{
				 		$obj = $lastRecordResult->fetch_object();
					 	
					 		$return .= "Order No : ".$obj->orderID ;
					 		$return .= "<br/>";
					 		$return .= "Date : ".$obj->date ;
					 		$return .= "<br/>";
					 		$return .= "Your order information is sent to our admin, we will contact you .";
				 	}
				 	else
				 	{
				 		$return .= "Connection Error !"."SELECT * FROM `tbl_order` WHERE `orderID` = '".$orderID."' ". mysqli_error() ;
				 	}
				}
				else
				{
					$return .= "Connection Error !". mysqli_error() ;
				}
									 	
			}
			else
			{
				$return .= "Connection Error !". mysqli_error() ;
			
			}




			 	
			return $return;
		}

}

?>