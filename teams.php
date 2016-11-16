<div id="teams" class="container-fluid bgd">
	<div class="page-header">
		<a href="#teamcollapse" data-toggle="collapse"><h2>Teams</h2></a>
	</div>
	<div id="teamcollapse" class="collapse in">
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
					echo '<div class="col-sm-3">'."\n";
					echo '<div class="panel panel-default">';
					echo '<div class="panel-heading "><strong>'.$TeamRow['TeamName'].'</strong></div>'."\n";
					echo '<div class="panel-body">';
					echo '<img class="img-responsive greyscale" src="'.$TeamRow['ImagePath'].'" alt="'.$TeamRow['TeamName'].'">'."\n";
					echo '<div class="row">'."\n";
					
					// Add Players to the team
					$SQLQuery = "SELECT * FROM players WHERE TeamID=".$TeamRow['ID']; 
					if ($PlayerResult = $MySQLDB->query($SQLQuery))
					{
						if ($PlayerResult->num_rows > 0)
						{
							$blankcols = $PlayerResult->num_rows % 1;
							$Rows = 0; // Needed for alternating Rows
							while($PlayerRow = $PlayerResult->fetch_assoc())
							{
								$Rows++;
								$identifier = $PlayerRow['Forename'].$PlayerRow['Surname'];
								echo '<div class="col-xs-6 teamclass">'."\n";
								//echo '<a type="button" class="btn" style="width:100%;" href="#test_modal" data-toggle="modal">Add Image</a>';
								// echo '<a href="#'.$identifier.'" data-toggle="collapse"><small>'.$PlayerRow['Forename'].' '.$PlayerRow['Surname'].'</small><br><img src="'.$PlayerRow['ImagePath'].'" class="img-responsive greyscale" alt="'.$PlayerRow['Forename'].' '.$PlayerRow['Surname'].'"></a>';
								echo '<a href="#'.$identifier.'Modal"  data-toggle="collapse">'.$PlayerRow['Forename'].' '.$PlayerRow['Surname'].'</a>'."\n";
								//echo '<a href="#ShopModal" data-toggle="modal"><br><img src="'.$PlayerRow['ImagePath'].'" class="img-responsive greyscale" alt="'.$PlayerRow['Forename'].' '.$PlayerRow['Surname'].'"><small>'.$PlayerRow['Forename'].' '.$PlayerRow['Surname'].'</small></a>'."\n";

								echo '</div>'."\n";
								
								
								
								
												$identifier = $PlayerRow['Forename'].$PlayerRow['Surname'];
				
				
				
				echo '<div id="'.$identifier.'Modal" class="panel-collapse collapse col-xs-12">';

				
				//echo '<div id="'.$identifier.'" class="collapse" style="float: left; width:50%;"    style="float: right; width:50%;">
				echo '<div class="col-xs-5" class><img src="'.$PlayerRow['ImagePath'].'" class="img-responsive greyscale" alt="'.$PlayerRow['Forename'].' '.$PlayerRow['Surname'].'"></div>';
				echo '<div  class="col-xs-1"></div>';
				echo '<div class="col-xs-6"><small><p><b>Shirt No: </b>'. $PlayerRow['ShirtNo'] .'</p><p><b>Position: </b><br>'. $PlayerRow['CourtPos'] .'</p><p><b>Member Since: </b><br>'. $PlayerRow['MemberSince'] .'</p>';
				
				$SQLQuery = "SELECT h.HonourName, ph.Year FROM honours h RIGHT JOIN playershonours ph ON h.ID = ph.HonourID WHERE ph.PlayerID = ".$PlayerRow['ID']." ORDER by ph.Year"; 
				if ($HonourResult = $MySQLDB->query($SQLQuery))
				{
					if ($HonourResult->num_rows > 0)
					{
						echo '<p><b>Honours:</b>';
						while($HonourRow = $HonourResult->fetch_assoc())
						{	
							echo '<br>'.$HonourRow['Year'].': '.$HonourRow['HonourName'];
						}
						echo '</p>';
					}
				}	

				$SQLQuery = "SELECT pc.ClubName FROM prevoiusclubs pc RIGHT JOIN playersprevclubs ppc ON pc.ID = ppc.ClubID WHERE ppc.PlayerID = ".$PlayerRow['ID']." ORDER BY pc.ClubName"; 
				if ($ClubResult = $MySQLDB->query($SQLQuery))
				{
					if ($ClubResult->num_rows > 0)
					{
						echo '<p><b>Prev. Clubs:</b>';
						while($ClubRow = $ClubResult->fetch_assoc())
						{	
							echo '<br>'.$ClubRow['ClubName'];
						}
						echo '</p>';
					}
				}									
				
				echo '</small></div>'."\n";
				echo "</div>\n\n";
								
								
								
								
								
								// if ($Rows % 1 == 0)
								// {
									// echo '</div>'."\n";
									// echo '<div class="row">'."\n";
								// }
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