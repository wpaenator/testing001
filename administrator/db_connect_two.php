<?php 

class projectTwo{
	
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


	  	public function registerProduct($name,$desp,$price,$discount,$catID,$img)
		{
			$state = " INSERT INTO `tbl_watch_product` (`pName`,`desp`,`price`,`discount`,`catID`,`img`) VALUES ('".$name."','".$desp."','".$price ."','".$discount."','".$catID."','".$img."') ";

			$return = "";

			$link = $this->db_connect();

			if($result = mysqli_query($link,$state))
			{
			 	$lastRecord = "SELECT * FROM `tbl_watch_product` ORDER BY id DESC LIMIT 1 ";

			 	$lastRecordResult = mysqli_query($link,$lastRecord);

			 	while($obj = $lastRecordResult->fetch_object())
			 	{
			 		$return = $obj->pName ." is registered.";
			 	}
			}
			else
			{
				echo "Connection Error !", mysqli_error() ;
				exit();
			}

			return $return;
		}


		public function updateProduct($name,$desp,$price,$discount,$catID,$hideID,$img)
		{
			$state = "UPDATE `tbl_watch_product` SET `pName`='".$name."',`desp`='".$desp."',`price`='".$price."',`discount`='".$discount."', `catID`= '".$catID."',`img` = '".$img."' WHERE `id` = '".$hideID."' ";

			$return = "";

			$link = $this->db_connect();

			if($result = mysqli_query($link,$state))
			{
				$lastRecord = "SELECT * FROM `tbl_watch_product` WHERE `id` = '".$hideID."' ";

			 	$lastRecordResult = mysqli_query($link,$lastRecord);

			 	while($obj = $lastRecordResult->fetch_object())
			 	{
			 		$return = $obj->pName ." is successfully updated";
			 	}
			}
			else
			{
				$return = "Sql Connection Error".mysqli_error();
			}

			return $return ;
		}

		public function getProductInfo($id)
		{
			$state = "SELECT * FROM `tbl_watch_product` WHERE `id` = '".$id."' ";

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

		public function getCategoryList($id)
		{
			$state = " SELECT * FROM `tbl_category` ORDER BY `id` DESC  ";

			$return = "";

			$link = $this->db_connect();

			if($result = mysqli_query($link,$state))
			{

				$return  .= "<option value=''> SELECT </option>";

				while($obj = $result->fetch_object())
				{
					if($id != "0")
					{
						if($id == $obj->id )
						{
							$return  .= "<option value='".$obj->id."' selected > ".$obj->name." </option>";	
						}
						else
						{
							$return  .= "<option value='".$obj->id."'> ".$obj->name." </option>";
						}
						
					}
					else
					{
						$return  .= "<option value='".$obj->id."'> ".$obj->name." </option>";
					}
					
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

			$return = "";

			$link = $this->db_connect();

			if($result = mysqli_query($link,$state))
			{
				while($obj = $result->fetch_object())
				{
					$return  .= "<tr>";
					$return  .= "<td><a href='product.php?id=".$obj->id."'>".$obj->pName."</a></td>";
					$return  .= "<td>".$obj->desp."</td>";
					$return  .= "<td>".$obj->price."</td>";
					$return  .= "<td>".$obj->discount."</td>";
					$return  .= "<td>".$obj->name."</td>";
					$return  .= "<td>".$obj->img."</td>";					
					$return  .= "</tr>";
				}
			}
			else
				{	
					$return = " Could not select Doctor  ".mysqli_error();
				}

			return $return;	
		}



		public function listOrders()
		{
			$state = "";
			$state .= "SELECT ";
			$state .= "tbl_order.id, tbl_order.orderID, ";
			$state .= "tbl_order.`date`,  tbl_order.contactInfo, ";
			$state .= "tbl_order.status,  tbl_watch_product.pName, ";
			$state .= " tbl_watch_product.discount, tbl_watch_product.img, ";
			$state .= " tbl_watch_product.price  FROM  tbl_order ";
			$state .= "Inner Join tbl_order_detail ON tbl_order_detail.orderID = tbl_order.orderID ";
			$state .= "Inner Join tbl_watch_product ON tbl_watch_product.id = tbl_order_detail.productID ORDER BY  tbl_order.id DESC ";



			$link = $this->db_connect();

			if($result = mysqli_query($link,$state))
			{
				/*<thead>
								<tr>
									
									<th>Order No</th>
									<th>Date</th>
									<th>Contact Info</th>
									<th>Status</th>
									<td>Product</td>					
								</tr>
							</thead>*/
				while($obj = $result->fetch_object())
				{

				?>
					<tr>
						<td><?php echo $obj->orderID ; ?></td>
						<td><?php echo $obj->date ; ?></td>
						<td><?php echo $obj->contactInfo ; ?></td>
						<td><?php echo $obj->status ; ?></td>
						<td>
							<ul>
								<li>Name : <?php echo $obj->pName ;?></li>
								<li>Price : <?php echo $obj->price ;?></li>
								<li>Discount : <?php echo $obj->discount ;?> </li>
							</ul>
							<p><img src="" /></p>
						</td>
					</tr>
				<?php
				}
			}
		}
}

?>