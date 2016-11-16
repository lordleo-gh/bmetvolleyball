<html>
    
<?php

require 'settings.php'; 
require 'passwordhash.php';
$row = null;
$ID = 0;
$SQLQuery = '';
$MySQLDB = new mysqli($db_server, $db_username, $db_password, $db_name);
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    //print_r($_POST);
    
    if (ISSET($_POST["-Save"]))
    {
         
          // if PW is set and box is ticked update that too after hashing
          // if the box is unticked remove password
          // build array
          if ($_FILES['-File']['size'] != 0)
          {
      $target_dir = "images/teams/";
      $target_file = $target_dir . basename($_FILES['-File']["name"]);
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES['-File']["tmp_name"]);
      if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
      } else {
            echo "File is not an image.";
            $uploadOk = 0;
      }
       // Check file size
if ($_FILES['-File']["size"] > 50000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["-File"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["-File"]["name"]). " has been uploaded.";
         $_POST['ImagePath'] = $target_file;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
          }


          //Update existing player or password
            if ($_POST['-ID'] > 0)
            {         
                  // Build SQL String for UPDATE (except PW)
                  foreach ($_POST as $key => $value)
                  {
                        if ($key[0] != '-')
                        {
                              if (IsSet($KeyValuePairs))
                              {
                                    $KeyValuePairs = $KeyValuePairs . ", " . $key . "='" . $value . "'" ;
                              }
                              else
                              {
                                    $KeyValuePairs = $key . "='" . $value . "'" ;
                              }
                              
                        }
                  }
                  // Add PW if it's set
                  if (strlen ($_POST['-Password']) > 0)
                  {
                        $KeyValuePairs = $KeyValuePairs . ", Password='" . SetPassword($_POST['-Password']) ."'" ;
                  }
                  $SQLQuery = "UPDATE players SET " . $KeyValuePairs . " WHERE ID = " . $_POST['-ID'];
            } 
            // Insert new player
            else {
                  // Build SQL string for INSERT  (except PW)                				
                  foreach ($_POST as $key => $value)
                  {
                        if ($key[0] != '-')
                        {
                              if (IsSet($KEYS))
                              {
                                    $KEYS = $KEYS . "," . $key ;
                              }
                              else
                              {
                                    $KEYS = $key ;
                              }
                              
                              if (IsSet($VALUES))
                              {
                                    $VALUES = $VALUES . ",'" . $value . "'";
                              }
                              else
                              {
                                    $VALUES = "'" . $value . "'";
                              }
                        }
                  }
                  // Add password to SQL in case it's set
                  if (strlen ($_POST['-Password']) > 0)
                  {
                        $KEYS = $KEYS . ",Password";
                        $VALUES = $VALUES . ",'" .  SetPassword($_POST['-Password']) . "'";
                  }
                  $SQLQuery = "INSERT INTO players (" . $KEYS . ") VALUES (" . $VALUES . ")";
            }
    }

    if (ISSET($_POST["Delete"]))
    {
          $SQLQuery = "DELETE FROM players WHERE ID =" . $_POST['Delete'];
    }
    
    if ($SQLQuery != '')
    {
            
            if ($MySQLDB->query($SQLQuery)) {
               echo "   <header>";
           // echo "SQL Query: ".$SQLQuery;
           echo "SUCCESS";
            echo '<meta http-equiv="refresh" content="3; url=http://www.bmetvolleyball.com/player-list.php" />';
            echo " </header>";
} else {
    echo "Error: " . $SQLQuery;
}

            
    }

    // Edit button was pressed on generic admin form - show this form prefilled
    if (ISSET($_POST["Edit"]) || ISSET($_POST["Add"]) || ISSET($_POST["SetOwnPW"]))
    {
         if (ISSET($_POST["Edit"])){
              $ID = $_POST["Edit"];
            $SQLQuery = "SELECT * FROM players WHERE ID=".$ID;
       // echo $SQLQuery;
        $PlayerResult = $MySQLDB->query($SQLQuery);
        //print_r($PlayerResult);
        $row = $PlayerResult->fetch_assoc();
        $ImagePath = $row["ImagePath"];
         }
         if (ISSET($_POST["SetOwnPW"])){
            $ID = $_POST["SetOwnPW"];
         }
         if (ISSET($_POST["Add"])){
               $ID=0;
               $ImagePath = 'images/teams/avatar.jpg';
         }

      
      
        //include header
        // include form body
?>        
        
<header>
      <?php
            // include styling
      ?>
	  <script>
        function ResetImage(){
document.getElementById("imagePath").value="images/teams/avatar.jpg";
}
// 	  $(document).ready(function (e) {
// $("#uploadimage").on('submit',(function(e) {
// e.preventDefault();
// $("#message").empty();
// $('#loading').show();
// $.ajax({
// url: "ajax_php_file.php", // Url to which the request is send
// type: "POST",             // Type of request to be send, called as method
// data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
// contentType: false,       // The content type used when sending data to the server.
// cache: false,             // To unable request pages to be cached
// processData:false,        // To send DOMDocument or non processed data file it is set to false
// success: function(data)   // A function to be called if request succeeds
// {
// $('#loading').hide();
// $("#message").html(data);
// }
// });
// }));
// });
</script>
</header>
              
 <body>

 <?php include "admin-menu.php" ?>
       <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data">
           <table>
            <?php 
            // Just a password change
            if (!ISSET($_POST["SetOwnPW"]))
            { 
            ?>

           <tr>
                  <td>Forename: </td><td><input type="text" name="Forename" value="<?php echo $row["Forename"]; ?>"></td>
           </tr>
           <tr>
                   <td>Surname: </td><td><input type="text" name="Surname" value="<?php echo $row["Surname"]; ?>"></td>
           </tr>
           <tr>
                   <td>Image: </td><td><input type="text" name="ImagePath" value="<?php echo $ImagePath; ?>" id="imagePath" readonly></td>
           </tr>
	      <tr>
                   <td></td><td><input type="file" name="-File" id="file" value="Upload Image" /></td>
           </tr>
           <tr>
                   <td></td><td><input type="button" name="-Reset" id="reset" value="Reset Image" onclick="ResetImage()" /></td>
           </tr>
           <tr>
                  <td>Team: </td>
                  <td><select name="TeamID">
	     <?php
		      $SQLQuery = "SELECT * FROM teams"; 
                  if ($TeamResult = $MySQLDB->query($SQLQuery))
                  {
                        if ($TeamResult->num_rows > 0)
                        {
                              while($TeamRow = $TeamResult->fetch_assoc())
                              {
  				            echo '<option value="'.$TeamRow['ID'].'"';
                                    if ($row['TeamID'] == $TeamRow['ID']) 
                                    { 
                                          echo ' selected="selected"'; 
                                    } 
                                    echo ">". $TeamRow['TeamName']."</option>";
                              }
                        }
                  }
           ?>
			</select></td>
           </tr>
           <tr>
                   <td>Shirt No: </td><td><input type="number" name="ShirtNo" value="<?php echo $row["ShirtNo"]; ?>"></td>
           </tr>
           <tr>
                   <td>Court Position: </td><td><input type="text" name="CourtPos" value="<?php echo $row["CourtPos"]; ?>"></td>
           </tr>
           <tr>
                   <td>Member Since: </td><td><input type="date" name="MemberSince" value="<?php echo $row["MemberSince"]; ?>"></td>
           </tr>
           <tr>
                   <td>E-Mail: </td><td><input type="email" name="EMail" value="<?php echo $row["EMail"]; ?>"></td>
           </tr>
           <tr>
                   <td>Can Login: </td><td><select name="CanLogin"> 
                         <option value="0" <?php if (!$row["CanLogin"]) { echo 'selected="selected"';} ?>>No</option>
                         <option value="1" <?php if ($row["CanLogin"]) { echo 'selected="selected"';} ?>>Yes</option>
                   </td>
           </tr>
           <tr>
                   <td></td>
                   <td><input type="hidden" name="-ID" value="<?php echo $ID; ?>"></td>
           </tr>
           <?php 
           } 
           else 
           { 
           ?>
            <tr>
                  <td></td><td><input type="hidden" name="-ID" value="<?php echo $_SESSION['ID']; ?>"></td>
            </tr>
           <?php 
           } 
           ?>
            <tr>
                   <td>Password: </td><td><input type="password" name="-Password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" onchange="form.-password_rep.pattern = this.value;" ></td>
	      </tr>
            <tr>
                  <td>Password Repeat:</td><td><input type="password" name="-Password_rep"  pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" ></td>
            </tr>
            <tr>
                  <td></td><td><button type="Submit" name="-Save" value="Save">Save</button></td>
            </tr>
                
                 </table>
           </form>
       </body>        
        
<?php    
             
    }
    
 }

?>

  
</html>