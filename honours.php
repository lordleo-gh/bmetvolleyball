<div id="honours" class="container-fluid bgl">
	<div class="page-header">
		<a href="#honourscollapse" data-toggle="collapse"><h2>Honours</h2></a>
	</div>
		<div id="honourscollapse" class="collapse in">



	<?php			
		$savedhonour = NULL;
		$column = 0;
		$prevTeamName = NULL;
		$SQLQuery = "SELECT DISTINCT h.HonourName, h.ID FROM honours h LEFT JOIN playershonours ph ON h.ID = ph.HonourID WHERE NOT h.IsRole AND ph.TeamID IS NULL"; 
		if ($HonourResult = $MySQLDB->query($SQLQuery))
		{
			if ($HonourResult->num_rows > 0)
			{
				while($HonourRow = $HonourResult->fetch_assoc())
				{
						// Club wide awards
						echo '<div class="panel panel-default">';
							echo '<div  class="panel-heading col-xs-12">';
							echo '<strong>'.$HonourRow['HonourName'].'</strong>';
							echo '</div>';
							echo '<div class="panel-body">';
		$SQLQuery = "SELECT p.Forename, p.Surname, ph.Year FROM playershonours ph LEFT JOIN players p ON ph.PlayerID = p.ID WHERE ph.HonourID=".$HonourRow['ID']." ORDER BY ph.Year"; 
		if ($PlayerResult = $MySQLDB->query($SQLQuery))
		{
			if ($PlayerResult->num_rows > 0)
			{
				while($PlayerRow = $PlayerResult->fetch_assoc())
				{
							echo '<div class="col-xs-4 col-sm-3  col-md-2">';
							echo $PlayerRow['Year'].": ".$PlayerRow['Forename']." ".$PlayerRow['Surname'];
							echo '</div>';
							$column++;
				}
				while (($column % 6) != 0)
				{
					echo '<div class="col-xs-4 col-sm-3 col-md-2"></div>';
					$column++;
				}
			}
		}
							echo '</div>';
							echo '</div>';
	//	echo '<div  class="col-xs-12"><p> </p></div>';
				}
			}
		}


		$SQLQuery = "SELECT * FROM teams WHERE IsOwn = TRUE";
		if ($TeamResult = $MySQLDB->query($SQLQuery))
		{
			if ($TeamResult->num_rows > 0)
			{
				while($TeamRow = $TeamResult->fetch_assoc())
				{
							echo '<div class="col-sm-12 col-md-3">';
							echo '<div class="panel panel-default">';
							echo '<div class="panel-heading col-xs-12"><strong>'.$TeamRow['TeamName'].'</strong></div>';
							echo '<div class="panel-body">';

		$SQLQuery = "SELECT DISTINCT h.HonourName, h.ID FROM honours h LEFT JOIN playershonours ph ON h.ID = ph.HonourID WHERE NOT h.IsRole AND ph.TeamID IS NOT NULL" ; 
		if ($HonourResult = $MySQLDB->query($SQLQuery))
		{
			if ($HonourResult->num_rows > 0)
			{
				while($HonourRow = $HonourResult->fetch_assoc())
				{
						// Club wide awards
							echo '<div  class="col-xs-12"><strong>'.$HonourRow['HonourName'].'</strong></div>';

		$SQLQuery = "SELECT p.Forename, p.Surname, ph.Year FROM playershonours ph LEFT JOIN players p ON ph.PlayerID = p.ID WHERE ph.HonourID=".$HonourRow['ID']." AND ph.TeamID=".$TeamRow['ID']." ORDER BY ph.Year"; 
		if ($PlayerResult = $MySQLDB->query($SQLQuery))
		{
			if ($PlayerResult->num_rows > 0)
			{
				while($PlayerRow = $PlayerResult->fetch_assoc())
				{
							echo '<div class="col-xs-6 col-sm-4 col-md-12 col-lg-6">';
							echo $PlayerRow['Year'].": ".$PlayerRow['Forename']." ".$PlayerRow['Surname'];
							echo '</div>';
							$column++;
				}
				while (($column % 2) != 0)
				{
					echo '<div class="col-xs-6 col-sm-4 col-md-12 col-lg-6">&nbsp</div>';
					$column++;
				}
			}
		}
							echo '<div class="col-xs-12">&nbsp</div>';
				}
			}
		}
		echo '</div>';
		echo '</div>';
		echo '</div>';
				}
			}
		}




					?>
		</div>
</div>