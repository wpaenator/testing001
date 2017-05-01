<?php 

class project{
	
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

		public function RegisterStaff($name,$pwd,$email,$role)
		{
			$state = " INSERT INTO `tbl_admin` (`name`,`email`,`password`,`role`) VALUES ('".$name."','".$email."','".$pwd ."','".$role."') ";

			$return = "";

			$link = $this->db_connect();

			if($result = mysqli_query($link,$state))
			{
			 	$lastRecord = "SELECT `name`,`email` FROM `tbl_admin` ORDER BY id DESC LIMIT 1 ";

			 	$lastRecordResult = mysqli_query($link,$lastRecord);

			 	while($obj = $lastRecordResult->fetch_object())
			 	{
			 		$return = $obj->name ." is registered and email is ".$obj->email;
			 	}
			}
			else
			{
				echo "Connection Error !", mysqli_error() ;
				exit();
			}

			return $return;
		}

		public function UpdateStaff($name,$pwd,$email,$role,$hideID)
		{
			$state = "UPDATE `tbl_admin` SET `name`='".$name."',`email`='".$email."',`password`='".$pwd."',`role`='".$role."' WHERE `id` = '".$hideID."' ";

			$return = "";

			$link = $this->db_connect();

			if($result = mysqli_query($link,$state))
			{
				$lastRecord = "SELECT `name`,`email` FROM `tbl_admin` WHERE `id` = '".$hideID."' ";

			 	$lastRecordResult = mysqli_query($link,$lastRecord);

			 	while($obj = $lastRecordResult->fetch_object())
			 	{
			 		$return = $obj->name ." is successfully updated and email is ".$obj->email;
			 	}
			}
			else
			{
				$return = "Sql Connection Error".mysqli_error();
			}

			return $return ;
		}


		public function StaffList()
		{
			$state = " SELECT * FROM `tbl_admin` ORDER BY `id` DESC  ";

			$return = "";

			$link = $this->db_connect();

			if($result = mysqli_query($link,$state))
			{

				while($obj = $result->fetch_object())
				{
					$return  .= "<tr>";
					$return  .= "<td>";
					$return  .= "<a href='admin.php?id=".$obj->id."'>".$obj->name."</a>";
					$return  .= "</td>";
					$return  .= "<td>".$obj->email."</td>";
					$return  .= "<td>".$obj->role."</td>";
					$return  .= "</tr>";
				}
			}
			else
				{	
					$return = " Could not select Doctor  ".mysqli_error();
				}

			return $return;	

		}


		public function getStaffInfo($id)
		{
			$state = "SELECT * FROM `tbl_admin` WHERE `id` = '".$id."' ";

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


		public function categoryRegister($name,$desp)
		{
			$state = " INSERT INTO `tbl_category` (`name`,`desp`) VALUES ('".$name."','".$desp."') ";

			$return = "";

			$link = $this->db_connect();

			if($result = mysqli_query($link,$state))
			{
			 	$lastRecord = "SELECT * FROM `tbl_category` ORDER BY id DESC LIMIT 1 ";

			 	$lastRecordResult = mysqli_query($link,$lastRecord);

			 	while($obj = $lastRecordResult->fetch_object())
			 	{
			 		$return = $obj->name ." is registered ";
			 	}
			}
			else
			{
				echo "Connection Error !", mysqli_error() ;
				exit();
			}

			return $return;
		}


		public function updateCategory($name,$desp,$hideID)
		{
			$state = "UPDATE `tbl_category` SET `name`='".$name."',`desp`='".$desp."' WHERE `id` = '".$hideID."' ";

			$return = "";

			$link = $this->db_connect();

			if($result = mysqli_query($link,$state))
			{
				$lastRecord = "SELECT * FROM `tbl_category` WHERE `id` = '".$hideID."' ";

			 	$lastRecordResult = mysqli_query($link,$lastRecord);

			 	while($obj = $lastRecordResult->fetch_object())
			 	{
			 		$return = $obj->name ." is successfully updated ";
			 	}
			}
			else
			{
				$return = "Sql Connection Error".mysqli_error();
			}

			return $return ;
		}

		public function getCategoryInfo($id)
		{
			$state = "SELECT * FROM `tbl_category` WHERE `id` = '".$id."' ";

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


		public function catgoryList()
		{
			$state = " SELECT * FROM `tbl_category` ORDER BY `id` DESC  ";

			$return = "";

			$link = $this->db_connect();

			if($result = mysqli_query($link,$state))
			{

				while($obj = $result->fetch_object())
				{
					$return  .= "<tr>";
					$return  .= "<td>";
					$return  .= "<a href='category.php?id=".$obj->id."'>".$obj->name."</a>";
					$return  .= "</td>";
					$return  .= "<td>".$obj->desp."</td>";
					
					$return  .= "</tr>";
				}
			}
			else
				{	
					$return = " Could not select Doctor  ".mysqli_error();
				}

			return $return;	

		}





		/// user login & logout

	public function loginValidate($email,$pwd)
	{

		$validate  = "" ;
		$return    = "" ;

		$validate = "SELECT `email`,`password` FROM `tbl_admin` WHERE `email`= '".$email."' AND `password`= '".$pwd."' ";


		$link = $this->db_connect();
		
		if($result = mysqli_query($link,$validate))
		{
		 	  $row_cnt = $result->num_rows;

		 	  if($row_cnt > 0)
		 	  {
		 	  	$return = "success" ;
		 	  }
		 	  else
		 	  {
				$return = "Please Try Again! Invalid Email and Password !";
		 	  }
		}
		else
		{
			$return = "Please Try Again! Invalid Email and Password !";
		}
		
		return $return;
	}
	

	public function GetLoginID($email,$pwd)
	{
	
		$returnID = '' ;
	

		$validate = "SELECT * FROM `tbl_admin` WHERE `email`= '".$email."' AND `password`= '".$pwd."' ";

	
		$link = $this->db_connect();

		if($result = mysqli_query($link,$validate)) 
		{

		 	  $row_cnt = $result->num_rows;

		 	  if($row_cnt > 0)
		 	  {
		 	  		$obj = $result->fetch_object();
					$returnID = $obj->id;
		 	  }
		}
		else
		{
			$returnID = '0';

		}	

		return $returnID ;
	}

}
?>