<?php
	require 'settings.php'; 
	include 'passwordhash.php';

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
	

	// // Login details passed in
	// if (isset($_POST['EMail']) && isset($_POST['Password']))
	// {
			// $SQLQuery = "SELECT Password, CanLogin FROM players WHERE EMail='" . $_POST['EMail'] ."'";
			// if ($MySQLDB->query($SQLQuery)->fetch_object()->CanLogin)
			// {
				// $HashedPW = $MySQLDB->query($SQLQuery)->fetch_object()->Password;
				// if (ComparePassword($_POST['Password'],$HashedPW))
				// {
					// $success = true;	
					// $_SESSION['AdminEmail'] = $_POST['EMail'];
				// }				
				// else
				// {
					// $success = false;
					// $error = 'Login failed, please try to <a href="login.php">login again</a>';
				// }
			// }
	// }

// else
// {

	// if (isset($_SESSION['AdminEmail']))
	// {
		// $success = true;
		// // redirect
	// }
	// else
	// {
		// $success = false;
	// }
// }
	
	
	
?>

<!DOCTYPE html>
<html lang="en">
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
	
	
		
		
	.carousel-inner img {  		
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
		opacity: 0.98; }
	.bgd h2 {color: #fff;}
	.bgd p {font-style: italic;}
	
	.bgl {
		background: #FFFFFF;
		opacity: 0.98; }
	
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
	<title>BMET Volleyball Club</title>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">


<!-- Shop Popup Window -->
<div id="ShopModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<img style="float: left; padding-right:10px;" src="images/bmet-white-small.png">
        <h2 class="modal-title">BMET Shop</h2>
      </div>
      <div class="modal-body">
		<p>External content redirection</P>
        <p>The shop page www.kmd-ltd.co.uk will open in a new window.</p>
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal" onClick="window.open('http://kmd-ltd.co.uk/product-category/club-shop/b-met-vc/', '_blank');">OK</button>	  
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>



<!-- Login Popup Window -->
<div class="modal fade" id="LoginModal">
  <div class="modal-dialog">
    <div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">x</button>
		<h3>Login to BMET Volleyball Club</h3>
	  </div>
	  <div class="modal-body">

		<form method="post" action="admin.php">
		  <p><input type="text" class="span3" name="EMail" placeholder="EMail" required autofocus></p>
		  <p><input type="password" class="span3" name="Password" placeholder="Password" required></p>
		  <p><button type="submit" class="btn btn-default">Sign in</button>
		  </p>
		</form>
		test
	  </div>
	  </div>
  </div>
</div>

<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
<div class="container-fluid">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span> 
		</button>	
		<a href="#myCarousel"><img class="logolink" src="images/bmet-transparent.png"></a>
	</div>
	<div class="collapse navbar-collapse" id="myNavbar">
		<ul class="nav navbar-nav">
			<li><a href="#home">ABOUT US</a></li>
			<li><a href="#fixtures">FIXTURES</a></li>
			<li><a href="#teams">TEAMS</a></li>
			<li><a href="#honours">HONOURS</a></li>
			<li><a href="#gallery">GALLERY</a></li>
			<li><a href="#links">LINKS</a></li>
			<li><a href="#contact">CONTACT</a></li>
			<li><a data-toggle="modal" data-target="#ShopModal" href="#">SHOP</a></li>
		</ul>
		<?php 
		if (isset($_SESSION['AdminEmail']))
		{
			echo '<ul class="nav navbar-nav navbar-right hidden-xs">';
			echo '<li><a href="admin.php" ><span class="glyphicon glyphicon-log-in"></span> Admin</a></li>';
			echo '</ul>		';
		}
		else
		{
			echo '<ul class="nav navbar-nav navbar-right hidden-xs">';
			echo '<li><a data-toggle="modal" href="#LoginModal" ><span class="glyphicon glyphicon-log-in"></span> Admin</a></li>';
			echo '</ul>';
		}
		?>
	</div>
</div>
</nav>




<!-- Carousel -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
		<li data-target="#myCarousel" data-slide-to="3"></li>
		<li data-target="#myCarousel" data-slide-to="4"></li>
	</ol>
	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">
		<div class="item active">
			<img class="greyscale" src="images/volley1.jpg" alt="x">
		</div>
		<div class="item">
			<img class="greyscale" src="images/volley2.jpg" alt="x">
		</div>
		<div class="item">
			<img class="greyscale" src="images/volley3.jpg" alt="x">
		</div>
		<div class="item">
			<img class="greyscale" src="images/volley4.jpg" alt="x">
		</div>
		<div class="item">
			<img class="greyscale" src="images/volley5.jpg" alt="x">
		</div>
	</div>
	<!-- Left and right controls -->
	<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
	<div class="overlaylogo">
	<!--<img src="images/bmet-black.png" alt="BMET Volleyball Club Logo">-->
	</div>
</div>

					
<!-- Home -->
<?php
	include 'home.php';
?>


<!-- Fixtures -->
<?php
	include 'fixtures.php';
?>



<!-- Teams -->
<?php
	include 'teams.php';
?>


<!-- Honours -->
<?php
	include 'honours.php';
?>


<!-- Galery -->
<?php
	include 'gallery.php';
?>


<!-- Links -->
<div id="links" class="container-fluid bgl">
	<div class="row">
		<div class="col-sm-4">
			<div class="page-header">
				<a href="#VolleyballFederations" data-toggle="collapse"><h2>Volleyball Federations</h2></a>
			</div>
			<div id="VolleyballFederations" class="collapse in">
				<p><strong>Volleyball Federations</strong></p>
				
<?PHP
				$SQLQuery = "SELECT * FROM links l WHERE l.Section = 'VolleyballFederations'"; 
				if ($Result = $MySQLDB->query($SQLQuery))
				{
					if ($Result->num_rows > 0)
					{
						while($Row = $Result->fetch_assoc())
						{	
							echo '<p><a href="'.$Row['Link'].'" target="_blank">'.$Row['LinkName']."</a></p>";
						}
					}
				}	
?>				
				
			</div>		
		</div>
		<div class="col-sm-4">
			<div class="page-header">
				<a href="#downloads" data-toggle="collapse"><h2>Downloads</h2></a>
			</div>
			<div id="downloads" class="collapse in">
				<p><strong>Downloads</strong></p>
				
<?PHP
				$SQLQuery = "SELECT * FROM links l WHERE l.Section = 'Downloads'"; 
				if ($Result = $MySQLDB->query($SQLQuery))
				{
					if ($Result->num_rows > 0)
					{
						while($Row = $Result->fetch_assoc())
						{	
							echo '<p><a href="'.$Row['Link'].'" target="_blank"><span class="glyphicon glyphicon-download-alt"></span></a> '.$Row['LinkName']."</p>";
						}
					}
				}	
?>				
								
			</div>		
		</div>
		<div class="col-sm-4">
			<div class="page-header">
				<a href="#SitesofInterest" data-toggle="collapse"><h2>Other Sites of Interest</h2></a>
			</div>
			<div id="SitesofInterest" class="collapse in">
				<p><strong>Interests</strong></p>
				
<?PHP
				$SQLQuery = "SELECT * FROM links l WHERE l.Section = 'OtherSites'"; 
				if ($Result = $MySQLDB->query($SQLQuery))
				{
					if ($Result->num_rows > 0)
					{
						while($Row = $Result->fetch_assoc())
						{	
							echo '<p><a href="'.$Row['Link'].'" target="_blank">'.$Row['LinkName']."</a></p>";
						}
					}
				}	
?>				
								
			</div>		
		</div>
	</div>
</div>



<!-- Contact -->
<div id="contact" class="container-fluid bgd">
	<div class="page-header">
		<a href="#contact" data-toggle="collapse"><h2>Contact</h2></a>
	</div>
	<div id="contact" class="collapse in">
		<div class="row">
			<div class="col-md-4">
				<p>Training Times:</p>
<?PHP
				$times = FetchArray('trainingtimes', $MySQLDB);
				foreach ($times as $time)
				{
					echo '<p>'.$time.'</p>';
				}
?>	

			</div>
			<div class="col-md-8">
				<p>Training Location:</p>
				<div class="row">
					<div class="col-sm-6 form-group">
						<div class="row">
							<div class="col-xs-7">
								Sports Hall<br>Birmingham Metropolitan College<br>Sutton Coldfield Campus<br>34 Lichfield Road<br>Sutton Coldfield<br>B74 2NW
							</div>
							<div class="col-xs-5">
								<img class="img-responsive greyscale" src="images/location.jpg" alt="Location Image">
							</div>
						</div>
					</div>
					<div class="col-sm-6 form-group">
						
					</div>
				</div>
			</div>
		</div>


	</div>
</div>



<!-- Add Google Maps -->	
	<div id="googleMap"></div>
	<script src="http://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCRrj0bmNKjxjl8vToS-27geEkygaMBdqo"></script>
	<script>
		var myCenter = new google.maps.LatLng(
		52.567580, -1.823078);
		function initialize() {
		var mapProp = {
		center:myCenter,
		zoom:15,
		scrollwheel:false,
		draggable:true,
		mapTypeId:google.maps.MapTypeId.ROADMAP
		};

		var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

		var marker = new google.maps.Marker({
		position:myCenter,
		});

		marker.setMap(map);
		}

		google.maps.event.addDomListener(window, 'load', initialize);
	</script>



<!-- Footer -->
<footer class="text-center bgl">
  <a class="up-arrow" href="#myCarousel" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>The entirety of this site is protected by copyright © 2016 BMET Volleyball. All rights reserved. Xperience By <a href="http://www.visual-buzz.com" data-toggle="tooltip" title="Visit visual-buzz">www.visual-buzz.com</a></p> 
  <p></p>
</footer>



<!-- Scripts for Page -->
<script>

$(document).ready(function(){

        // $(".navbar-nav li.trigger-collapse a").click(function(event) {
          // $(".navbar-collapse").collapse('hide');
        // });
		
		$('.nav a').on('click', function(){
    $('.btn-navbar').click(); //bootstrap 2.x
    $('.navbar-toggle').click() //bootstrap 3.x by Richard
});

$('.thumbnail').click(function(){
	event.preventDefault();
	var theImage = new Image;
	//var docWidth = $(document).width;

  	//var title = $(this).attr("title");
	theImage.src = $(this).attr('href');
	var desiredDialogWidth = theImage.width + 34;
	
//	if((desiredDialogwidth > 34) && (desiredDialogWidth.isNumeric() < docWidth))
//	{
//	$(theImage.src).text();
	//var modalcontent = '<img src="' + theImage + '" >';
  //	$('.modal-title').html(title);
  	$('#GaleryModalBody').empty();
  $(theImage).appendTo('#GaleryModalBody');
	$(".sizeable-modal").width(desiredDialogWidth);
//	}
  	$('#myModal').modal({show:true});
	
});

// Get on screen image
//var screenImage = $("#image");

// Create new offscreen image to test
//var theImage = new Image();
//theImage.src = screenImage.attr("src");

// Get accurate measurements from that.
//var imageWidth = theImage.width;
//var imageHeight = theImage.height;

//$(".sizeable-modal").resizable();

// // Get on screen image
// var screenImage = $("#image");

// // Create new offscreen image to test
// var theImage = new Image();
// theImage.src = screenImage.attr("src");

// // Get accurate measurements from that.
// var imageWidth = theImage.width;
// var imageHeight = theImage.height;

// $(".sizeable-modal).text($(this).find("img").width());



  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip(); 
  
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myCarousel']").on('click', function(event) {

    // Prevent default anchor click behavior
    event.preventDefault();

    // Store hash
    var hash = this.hash;

    // Using jQuery's animate() method to add smooth page scroll
    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 900, function(){
   
      // Add hash (#) to URL when done scrolling (default click behavior)
      window.location.hash = hash;
    });
  });
  
})

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

</body>
</html>
