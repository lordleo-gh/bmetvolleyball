<?php
	require 'settings.php'; 
	include 'passwordhash.php';
	$success = false;
	$error = '';
	$MySQLDB = new mysqli($db_server, $db_username, $db_password, $db_name);
	
	
	function FetchSingleValue($Section, $MySQLDB)
	{
		$SQLQuery = "SELECT Value FROM textmanagement WHERE Section = '".$Section."'";
		return $MySQLDB->query($SQLQuery)->fetch_object()->Value;
	}
	
	function FetchArray($Section, $MySQLDB)
	{
		$array = array();
		$SQLQuery = "SELECT Value FROM textmanagement WHERE Section = '".$Section."'";
		if ($Result = $MySQLDB->query($SQLQuery))
		{
			if ($Result->num_rows > 0)
			{
				while($obj = $Result->fetch_object())
				{	
					$array[] = $obj->Value;
				}
			}
		}
		return $array;
	}
	

	// Login details passed in
	if (isset($_POST['EMail']) && isset($_POST['Password']))
	{
			$SQLQuery = "SELECT ID, Password, Forename FROM players WHERE EMail='" . $_POST['EMail'] ."' and CanLogin=true";
			//echo $SQLQuery;
			if ($result = $MySQLDB->query($SQLQuery))
			{
				if ($result->num_rows == 0)
				{ 
					$success = false;
				}
				else 
				{	
						$row = $result->fetch_assoc();
						
						
						if (ComparePassword($_POST['Password'],$row["Password"]))
						{
							$success = true;	
							$_SESSION['AdminEmail'] = $_POST['EMail'];
							$_SESSION['Forename'] = $row["Forename"];
							$_SESSION['ID'] = $row["ID"];
						}				
						else
						{
							$success = false;
						}
				}	
				$result->close();
			}
			else 
			{
				$success = false;
			}
	}

else
{

	if (isset($_SESSION['AdminEmail']))
	{
		$success = true;
	}
	else
	{
		$success = false;
	}
}
// $MySQLDB->close();
	
	
	
?>

<!DOCTYPE html>
<html lang="en">
<?php
	if ($success)
	{
?>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>  
	<style>
	body {position: relative;
	background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed;} 
	
	/* unvisited link */
a:link {
    text-decoration: none;
	color: #ff0000;
}

/* visited link */
a:visited {
    text-decoration: none;
	color: #dd0000;
}

/* mouse over link */
a:hover {
    text-decoration: underline;
	color: #dd0000;
}

/* selected link */
a:active {
    text-decoration: none;
}
	
	h2 {color: #111;}
	
	div.teamclass { margin-bottom:20px;}
	
	.greyscale {-webkit-filter: grayscale(80%);
		filter: grayscale(80%); /* make all photos black and white */ }
		
		
	.content {  		
		width: 100%; /* Set width to 100% */
		margin: auto;
		padding-top:50px;}
		
    #googleMap {
		width: 100%;
		height: 400px;}  

		 #calendar {
		-webkit-filter: grayscale(80%);
		filter: grayscale(80%);
		font-size: large;
		} 
		
	.overlaylogo { 
		position:absolute;
		z-index:12;
		bottom:0px;
		text-align:right;
		width: 100%;
		right: 0px;}
		
	.bgd {
		background: #2d2d30;
		color: #bdbdbd;
		opacity: 0.98;}
	.bgd h2 {color: #fff;}
	.bgd p {font-style: italic;}
	
	.bgl {
		background: #FFFFFF;
		opacity: 0.98;}
	
	.rdstrp {
		background: #ff0000;
		height:1px;}
	
/* The logo on the left to change on hover	*/
	.logolink { height:50px; content:url('http://www.visual-buzz.com/bmet-staging/images/bmet-black.png');}
	.logolink:hover { content:url(http://www.visual-buzz.com/bmet-staging/images/bmet-red.png);}
	
/* Navbar settings */
	.navbar-default .navbar-toggle
	{
		border-color: transparent;
	}
  
    .navbar {
      margin-bottom: 0;
      background-color: #000000;
      border: 0;
      letter-spacing: 1px;
      opacity: 0.9;
  }
  .navbar li a, .navbar .navbar-brand { 
      color: #d5d5d5 !important;
  }
  .navbar-nav li a:hover {
      color: #fff !important;
	  background-color: #dd0000 !important;
  }
  .navbar-nav li.active a {
      color: #fff !important;
      background-color: #ff0000 !important;
  }

/* Change padding on mobiles  */
@media (min-width: 992px) and (max-width: 1199px){
    .bgd, .bgl {
		padding: 50px 70px;
    }
	body {background-image: url("images/bmet-white-medium.png");} 
	}

@media (min-width: 1200px) {
    .bgd, .bgl {
		padding: 50px 100px;
    }
	body {background-image: url("images/bmet-white-large.png");} 
	}

/* Limit the height of the news box */
	.news{ overflow: auto;max-height: 400px;}

/* Size the player modals */
	.autoModal.modal .modal-body{
    max-height: 100%;
	width: auto;
	height: auto;
	overflow: hidden;
}
	
	
	
	
	
	
	
	
	
	
	


	
	
	
	
	
	
	
	
	
	
	
	</style>
	<title>BMET Volleyball Club Admin Site</title>
</head>
<body>
	
	


		<?php include 'admin-menu.php'; ?>
		
	<div class="content">
	<p>Hello <?php echo $_SESSION['Forename']; ?></P>
	<p>Please select one from the above administration options.</p>
	</div>		
		
		
		

</body>
<?php
}
else // no log in allowed - redirect to original page
{
?>
	<head>
	<meta http-equiv="refresh" content="5;URL='index.php'">
	</head>
	<body>
		Wrong long details, please try again!
		You will be redirected to the home page shortly.
	</body>
<?php
}
?>
</html>
