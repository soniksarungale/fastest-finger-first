<?php
    session_start();
    if(isset($_SESSION["id"]) && isset($_SESSION["uname"]) && isset($_SESSION["level"])){
        if($_SESSION["level"]=="admin"){
            
        
    ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width">
            <title>Admin</title>
            <link rel="stylesheet" href="datatables.min.css">
            <link href="style.css" rel="stylesheet" type="text/css">
        </head>
        <body>
            
            <header class="cf">
			<h1><img src="logo.png" class="logo" alt="TechnoBeat"></h1>
			<a href="#" id="navicon" class="closed">&#9776;</a>

	</header>
	<?php
        if($_SESSION["level"]=="admin"){    
        ?>
	<nav id="main-nav">
			<a href="index.php" class="current"><div>Results</div></a>
			<a href="users.php"><div>Users</div></a>
			<a href="players.php"><div>Players</div></a>
			<a href="logout.php"><div>Logout</div></a>
	</nav>
	    <?php 
        }            
    ?>
	<div id="main-content">
	    	<?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "kbm";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                $error="connection to database fail";
            }
$sql = "SELECT * FROM fffans ORDER BY time";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table id='database' class='display'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>id</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Correct</th>";
                                        echo "<th>time</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        if($row['correct']=="0"){echo "<td>Worng</td>";}else{echo "<td>correct</td>";}
                                        echo "<td>" . $row['time'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                    }
        
        ?>      
	</div>
	
	<div class="fade"></div>
            
     <script src="../../jquery.js"></script>  
      <script src="datatables.min.js"></script>
       <script>
           
            $(document).ready(function() {
      $('.fade').hide();
	  $('#navicon').click(function() {
	  
	  if($('#navicon').hasClass('closed')) {
	  	  $('body').animate({left: "-250px"}, 600).css({"overflow":"hidden"});
		  $('#main-nav').animate({right: "0"}, 600);
		  $(this).removeClass('closed').addClass('open').html('&#x2715;');
		  $('.fade').fadeIn();
	  }
	  else if($('#navicon').hasClass('open')) {
		   $('body').animate({left: "0"}, 600).css({"overflow":"scroll"});
		  $('#main-nav').animate({right: "-250px"}, 600);
		  $(this).removeClass('open').addClass('closed').html('&#9776;');
		  $('.fade').fadeOut();
	  }
	  });
  });
           $(document).ready(function(){
    $('#database').DataTable();
});
            </script>
       
        </body>
        </html>
            
    <?php  
            }
    }
    else{
        header("Location: ../index.php");
    }
?>