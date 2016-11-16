<div id="home" class="container-fluid bgd">
	<div class="row">
		<div class="col-sm-3 col-md-4 col-lg-4">
			<div class="page-header">
				<a href="#about" data-toggle="collapse"><h2>About Us</h2></a>
		 	</div>
			<div id="about" class="collapse in">		
				<?PHP 

					echo FetchSingleValue('introduction', $MySQLDB);
				?>
					<!-- Your like button code -->

			</div>
			
		</div>
		<div class="col-sm-4 col-md-4 col-lg-5">
			<div class="page-header">
				<a href="#news" data-toggle="collapse"><h2>News & Press Releases</h2></a>
			</div>
			<div id="news" class="collapse in news">
				<div class="fb-post" data-href="https://www.facebook.com/BirminghamMetVolleyballClub/posts/654970631343770"></div> 
			</div>
		</div>
		<div class="col-sm-5 col-md-4 col-lg-3">
			<div class="page-header">
				<a href="#calendar" data-toggle="collapse"><h2>What's On</h2></a>
			</div>
			<div id="calendar" class="collapse in" style="text-align: center;">
				<iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showNav=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;mode=AGENDA&amp;height=250&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;src=BirminghamMetVolleyballClub%40gmail.com&amp;color=%23FFFFFF&amp;ctz=Europe%2FLondon" style="border:solid 1px #FFF" width="300" height="250"></iframe>
			</div>
		</div>
	</div>
</div>