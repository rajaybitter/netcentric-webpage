<!DOCTYPE html>
<html>
	<head>
		<title>MP creation form</title>
    	<link rel="stylesheet" type="text/css" href="styles/p1a.css">
	  	<script src="scripts/p2.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<?php
			  $fname = $_POST['fname'];
			  $lname = $_POST['lname'];
			  $constituency = $_POST['const'];
			  $email = $_POST['mail'];
			  $years = $_POST['year'];
			  $pass = $_POST['pass'];
			  $confirm = $_POST['pass2'];
			  $hash = $_POST['hash'];
			  
			  //tests for validity
			  $exp = "/^[a-z ,.'-]+$/i";
			  
			  if(  !(preg_match($exp,$fname)) ){
			      echo "Invalid Entry";
			  }
			  if(  !(preg_match($exp,$lname))  ){
			      echo "Invalid Entry";
			  }
			  if(  !(preg_match($exp,$constituency))  ){
			      echo "Invalid Entry";
			  }
			  if( $pass != $confirm ){
			      echo "invalid Entry";
			  }

			  $salt = mt_rand();
			  $salted = "$pass" . "$salt";
			  $digest = md5($salted);

			  $user = 'comp2190SA';
			  $pass = '2015Sem1';

			  try {
			    //create PDO connection
			    $db = new PDO( 'mysql:host=localhost;dbname=MPMgmtDB', $user, $pass);
			    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			  } catch(PDOException $e) {
			    //show error
			      echo '<p class="bg-danger">'.$e->getMessage().'</p>';
			      exit;
			  } 
			  //insert entry to table
			  $x = $db->prepare("INSERT INTO Representatives (first_name, last_name,constituency,email,yrs_service,password_digest,salt) VALUES (:fname, :lname, :constituency, :email, :years, :digest, :salt)");
			  $x->execute(array(
			    ":fname" => $fname,
			    ":lname" => $lname,
			    ":constituency" => $constituency,
			    ":email" => $email,
			    ":years" => $years,
			    ":digest" => $digest,
			    ":salt" => $salt

			  ));  
		?>
		<table>
			<tr>
			    <th>First Name</th>
			    <th>Last Name</th>		
			    <th>Constituency</th>
			    <th >Email</th>
			    <th>Hash</th>
			    <th>Years of Service</th>
  			</tr>
			<?php
				//create table to print representatives
				$sql = "SELECT * FROM Representatives WHERE 1";
				$query = $db->prepare( $sql );
				$query->execute();
				$results = $query->fetchAll( PDO::FETCH_ASSOC );
				foreach( $results as $row ){
					echo "<tr>";
					echo "<td>".$row['first_name']."</td>";
					echo "<td>".$row['last_name']."</td>";
					echo "<td>".$row['constituency']."</td>";
					echo "<td>".$row['email']."</td>";
					echo "<td>".$row['password_digest']."</td>";
					echo "<td>".$row['yrs_service']."</td>";
					echo "</tr>";
				}		  
			?>
		</table>
	</body>
</html>