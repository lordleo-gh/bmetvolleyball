<div id="fixtures" class="container-fluid bgl">
	<div class="page-header">
		<a href="#fixcollapse" data-toggle="collapse"><h2>Fixtures</h2></a>
	</div>
	<div id="fixcollapse" class="collapse in">
		<div class="row">

<?PHP		
		$SQLQuery = "SELECT * FROM teams WhERE IsOwn = TRUE"; 
		if ($TeamResult = $MySQLDB->query($SQLQuery))
		{
			if ($TeamResult->num_rows > 0)
			{
				while($TeamRow = $TeamResult->fetch_assoc())
				{
					// Build Team space
					echo '<div class="col-xs-12">'."\n";
					echo '<div class="panel panel-default">';
					echo '<div class="panel-heading "><strong>'.$TeamRow['TeamName'].'</strong></div>'."\n";
					echo '<div class="panel-body">';
					echo '<div class="row">'."\n";
					echo '<div class="col-xs-2 col-sm-2">DATE</div><div class="col-xs-2 col-sm-2">TIME</div><div class="col-xs-4 col-sm-3">HOME</div><div class="col-xs-4 col-sm-3">AWAY</div><div class="col-sm-2 hidden-xa">NOTES</div>';
					echo '<div class="col-xs-12">&nbsp</div>';
					// Add Players to the team
					//SELECT t.TeamName AS Home, t2.TeamName AS Away FROM fixtures f JOIN teams t ON f.HomeTeamID = t.ID JOIN teams t2 ON f.AwayTeamID = t2.ID  WHERE HomeTeamID=1 OR AwayTeamID=1 
					$SQLQuery = "SELECT DATE_FORMAT(f.Date,'%d.%m.%y') AS Date, DATE_FORMAT(f.Date,'%H:%i') AS Time, th.TeamName AS Home, ta.TeamName as Away, f.Notes FROM fixtures f JOIN teams th ON f.HomeTeamID = th.ID JOIN teams ta ON f.AwayTeamID = ta.ID WHERE f.HomeTeamID=".$TeamRow['ID']. " OR f.AwayTeamID=".$TeamRow['ID']. " AND Date >= NOW()"; 
					//echo $SQLQuery;
					if ($FixtureResult = $MySQLDB->query($SQLQuery))
					{
						if ($FixtureResult->num_rows > 0)
						{
							$blankcols = $FixtureResult->num_rows % 1;
							$Rows = 0; // Needed for alternating Rows
							while($FixtureRow = $FixtureResult->fetch_assoc())
							{
								//echo $SQLQuery;
									echo '<div class="col-xs-2">'.$FixtureRow['Date'].'</div><div class="col-xs-2">'.$FixtureRow['Time'].'</div><div class="col-xs-3">'.$FixtureRow['Home'].'</div><div class="col-xs-3">'.$FixtureRow['Away'].'</div><div class="col-xs-2">'.$FixtureRow['Notes'].'</div>';
									echo '</div><div class="row">';
							}
							//for ($x = 0; $x <= $blankcols; $x++)
							//{
								//echo '<div class="col-xs-4"></div>'."\n";
							//}
						}
					}
					echo '</div>'."\n";
					echo '</div>'."\n";
					echo '</div>'."\n";
					echo '</div>'."\n";
				}
			}
		}	


?>			
		</div>
	</div>
</div>