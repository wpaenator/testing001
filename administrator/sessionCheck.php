<?php 

 	if(isset($_SESSION['email']) && $_SESSION['password'] != "")
	{
		//$_SESSION['email'];
		//echo $pro->GetLoginID($_SESSION['email'],$_SESSION['password'],'staff') ;

		if($pro->GetLoginID($_SESSION['email'],$_SESSION['password']) != "0" && $pro->GetLoginID($_SESSION['email'],$_SESSION['password']) != "" )
		{
			$returnID = $pro->GetLoginID($_SESSION['email'],$_SESSION['password']);
		}
		else
		{
			header("Location:login.php");
		}
	}
	else
	{
		header("Location:login.php");
	}

?>